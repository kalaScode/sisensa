<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class PresensiController extends Controller
{
    public function index()
    {
        return view('presensi');
    }

    public function store(Request $request)
{
    Log::info('Request data:', $request->all());

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

        Log::info('User ID from session:', ['user_id' => $user_id]); // Debugging

        $today = now()->toDateString();
        
        // Cek apakah sudah ada presensi hari ini
        $existingPresensi = Presensi::where('user_id', $user_id)
            ->where('Tanggal', $today)
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
        $presensi->Foto = $photoPath;  // Simpan path foto
        $presensi->created_by = $user_id;
        $presensi->updated_by = $user_id;

        $now = Carbon::now();
        $presensi->created_at = $now;  // Timestamp saat ini untuk created_at
        $presensi->updated_at = $now;
        
        $presensi->save();

        Log::info('Presensi berhasil disimpan:', $presensi->toArray()); // Debugging

        return response()->json([
            'success' => true,
            'message' => 'Presensi berhasil disimpan'
        ]);

    } catch (\Exception $e) {
        Log::error('Error saat menyimpan presensi: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Gagal menyimpan presensi: ' . $e->getMessage()
        ], 500);
    }
}
}