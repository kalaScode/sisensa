<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\PersetujuanPresensi;
use Illuminate\Support\Facades\DB;


class PresensiController extends Controller
{
    public function indexPresensi(Request $request)
    {
        $search = $request->input('search', ''); // Ambil nilai pencarian, default kosong
        $status = $request->input('status', '');

        // Ambil ID perusahaan dari user yang sedang login
        $idPerusahaan = Auth::user()->id_Perusahaan;

        // Query data cuti berdasarkan filter, pencarian, dan id_perusahaan
        $presensi = Presensi::query()
            ->whereHas('user', function ($query) use ($idPerusahaan) {
                $query->where('id_Perusahaan', $idPerusahaan);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status_Presensi', $status);
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10);

        // Kirim data ke view
        return view('page.ppersetujuan-presensi', compact('presensi', 'search', 'status'));
    }

    public function tolakPresensi(Request $request, $id)
    {
        // Menemukan data presensi berdasarkan ID
        $presensi = Presensi::findOrFail($id);

        // Menyimpan data pengirim notifikasi (misalnya HRD atau admin)
        $sender = Auth::user();

        // Ubah status menjadi "Dibatalkan"
        $presensi->status_Presensi = "Dibatalkan";
        $presensi->updated_by = Auth::id();
        $presensi->updated_at = Carbon::now('GMT+7')
            ->setTimezone('Asia/Jakarta')  // Mengonversi dari UTC ke WIB
            ->format('Y-m-d H:i:s');
        $presensi->save();

        // Mengirimkan notifikasi pembatalan presensi
        $presensi->user->notify(new PersetujuanPresensi($presensi, $sender));

        // Redirect dengan pesan sukses
        return redirect()->back()->with("success", "Presensi dibatalkan!");
    }




    public function store(Request $request)
    {

        try {
            // Pastikan user sudah login
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

            // Ambil user ID dari session
            $user_id = Auth::id(); // atau Auth::user()->id

            $today = now('GMT+7')->setTimezone('Asia/Jakarta')->toDateString();

            // Cek apakah sudah ada presensi akhir hari ini
            $alreadyFinalized = Presensi::where('user_id', $user_id)
                ->where('Tanggal', $today)
                ->where('Bagian', 'Keluar')
                ->where('status_Presensi', 'Disetujui')
                ->exists();

            if ($alreadyFinalized) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah melakukan presensi akhir hari ini'
                ]);
            }

            // Cek apakah sudah ada presensi hari ini
            $existingPresensi = Presensi::where('user_id', $user_id)
                ->where('Tanggal', $today)
                ->where('status_Presensi', 'Disetujui')
                ->exists();

            $bagian = $existingPresensi ? 'Keluar' : 'Masuk';
            $waktu = Carbon::createFromFormat('Y-m-d\TH:i:s.v\Z', $request->Waktu, 'UTC')
                ->setTimezone('Asia/Jakarta')  // Mengonversi dari UTC ke WIB
                ->format('Y-m-d H:i:s');


            // Simpan foto ke folder public/images
            $photoPath = null;
            if ($request->has('Foto')) {
                $photoData = $request->Foto; // Ambil foto yang dikirimkan dalam format base64
                $photoData = str_replace('data:image/png;base64,', '', $photoData);  // Menghapus prefix base64
                $photoData = base64_decode($photoData);  // Decode foto base64

                $fileName = 'presensi_' . time() . '.png';
                $filePath = public_path('images/' . $fileName);  // Tentukan path file gambar
                file_put_contents($filePath, $photoData);  // Simpan foto ke file

                $photoPath = 'images/' . $fileName;  // Simpan path foto untuk disimpan ke database
            }

            $presensi = new Presensi();
            $presensi->user_id = $user_id; // Gunakan user_id dari session
            $presensi->jenis_Presensi = $request->jenis_Presensi;
            $presensi->Tanggal = $request->Tanggal;
            $presensi->Waktu = $waktu;
            $presensi->Latitude = $request->Latitude;
            $presensi->Longitude = $request->Longitude;
            $presensi->Alamat = $request->Alamat;
            $presensi->Bagian = $bagian;
            $presensi->Keterangan = $request->Keterangan;
            $presensi->Foto = $photoPath;  // Simpan path foto
            $presensi->created_by = $user_id;
            $presensi->updated_by = $user_id;

            $now = Carbon::now('GMT+7')
                ->setTimezone('Asia/Jakarta')  // Mengonversi dari UTC ke WIB
                ->format('Y-m-d H:i:s');
            $presensi->created_at = $now;  // Timestamp saat ini untuk created_at
            $presensi->updated_at = $now;

            $presensi->save();

            return response()->json([
                'success' => true,
                'message' => 'Presensi berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan presensi: ' . $e->getMessage()
            ], 500);
        }
    }
    public function check()
    {
        try {
            // Pastikan user sudah login
            if (!Auth::check()) {
                return response()->json(['alreadyFinalized' => false], 401);
            }

            $user_id = Auth::id();
            $today = now('GMT+7')->setTimezone('Asia/Jakarta')->toDateString();

            // Cek jika ada presensi dengan bagian "Keluar" hari ini
            $alreadyFinalized = Presensi::where('user_id', $user_id)
                ->where('Tanggal', $today)
                ->where('Bagian', 'Keluar')
                ->where('status_Presensi', 'Disetujui')
                ->exists();

            return response()->json(['alreadyFinalized' => $alreadyFinalized]);
        } catch (\Exception $e) {
            return response()->json(['alreadyFinalized' => false], 500);
        }
    }
}
