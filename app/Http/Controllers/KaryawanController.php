<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\Perusahaan;
use App\Models\Jabatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KaryawanController extends Controller
{
    // Tampilkan daftar karyawan
    public function index(Request $request)
    {
        $query = Karyawan::query();

        // Filter berdasarkan status akun = 1
        $query->where('status_Akun', 1);

        // Pencarian
        if ($request->filled('search')) { // Gunakan filled untuk mengecek apakah parameter 'search' ada dan tidak kosong
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('no_Telp', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('status_Kerja', 'like', '%' . $search . '%');

                // Cek jika relasi 'jabatan' tersedia
                if (method_exists(Karyawan::class, 'jabatan')) {
                    $q->orWhereHas('jabatan', function ($subQuery) use ($search) {
                        $subQuery->where('nama_Jabatan', 'like', '%' . $search . '%');
                    });
                }
            });
        }

        // Pagination
        $karyawan = $query->paginate(10);
        // Ambil data perusahaan
        $perusahaan = Perusahaan::all();

        // Kirimkan nilai pencarian dan data perusahaan ke view
        return view('page.pdaftar_karyawan', [
            'karyawan' => $karyawan,
            'search' => $request->search,
            'perusahaan' => $perusahaan, // Kirim data perusahaan
        ]);
    }

    public function persetujuan(Request $request)
    {
        $query = Karyawan::query();

        // Filter berdasarkan status akun = 1
        $query->where('status_Akun', 0);

        // Pencarian
        if ($request->filled('search')) { // Gunakan filled untuk mengecek apakah parameter 'search' ada dan tidak kosong
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('no_Telp', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('status_Kerja', 'like', '%' . $search . '%');

                // Cek jika relasi 'jabatan' tersedia
                if (method_exists(Karyawan::class, 'jabatan')) {
                    $q->orWhereHas('jabatan', function ($subQuery) use ($search) {
                        $subQuery->where('nama_Jabatan', 'like', '%' . $search . '%');
                    });
                }
            });
        }

        // Pagination
        $karyawan = $query->paginate(10);
        // Ambil data perusahaan
        $perusahaan = Perusahaan::all();

        // Kirimkan nilai pencarian dan data perusahaan ke view
        return view('page.ppersetujuan-akun', [
            'karyawan' => $karyawan,
            'search' => $request->search,
            'perusahaan' => $perusahaan, // Kirim data perusahaan
        ]);
    }

    public function getProfil()
    {
        $pemberiPersetujuan = Karyawan::where('id_jabatan', 2)->first()->name;

        return view('page.pprofil', compact('pemberiPersetujuan'));
    }

    public function getEditProfil()
    {
        $pemberiPersetujuan = Karyawan::where('id_jabatan', 2)->first()->name;

        return view('page.pedit-profil', compact('pemberiPersetujuan'));
    }

    public function uploadFoto(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'Avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil file yang diupload
        $file = $request->file('Avatar');

        // Tentukan path penyimpanan dan gunakan disk 'public'
        $path = $file->store('avatar', 'public');

        // Debug: periksa path file yang dihasilkan
        dd($path); // Pastikan path valid

        // Update path di database untuk pengguna
        $user = Auth::user();
        $user->Avatar = $path; // $path adalah lokasi file yang disimpan di storage
        $user->save();


        // Kembalikan respon jika berhasil
        return redirect()->back()->with('success', 'Foto berhasil diupload');
    }


    public function showForm($user_id)
    {
        $perusahaan = Perusahaan::all(); // Ambil semua perusahaan
        $karyawan = Karyawan::findOrFail($user_id); // Ambil data karyawan yang spesifik

        return view('page.pdaftar_karyawan', [
            'karyawan' => $karyawan,
            'perusahaan' => $perusahaan,
        ]);
    }


    // Form edit karyawan
    public function edit($user_id)
    {
        // Ambil data karyawan
        $karyawan = Karyawan::findOrFail($user_id);

        // Ambil data perusahaan
        $perusahaan = Perusahaan::all();

        return view('page.pdaftar_karyawan', compact('karyawan', 'perusahaan'));
    }


    // Update data karyawan
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'perusahaan' => 'required|exists:perusahaan,id_Perusahaan',
            'statuskerja' => 'required|string',
            'statusakun' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required|string',
            'alamat' => 'nullable|string',
            'saldo' => 'nullable|numeric|min:0',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($validatedData);
        return response()->json(['success' => true]);
    }

    // Hapus karyawan
    public function destroy($user_id)
    {
        try {
            $karyawan = Karyawan::findOrFail($user_id);
            $karyawan->delete();
            return redirect()->route('page.pdaftar_karyawan')->with('success', 'Karyawan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus karyawan.');
        }
    }

    //ubah status akun menjadi aktif
    public function ubahStatusAkun($id)
    {
        // Cari karyawan berdasarkan ID
        $karyawan = Karyawan::findOrFail($id);

        // Ubah status akun menjadi 1
        $karyawan->status_Akun = 1;
        $karyawan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status akun berhasil diperbarui.');
    }

    //Batalkan pengajuan akun
    public function batalkanAkun($user_id)
    {
        $karyawan = Karyawan::findOrFail($user_id);
        $karyawan->status_Akun = 2; // Contoh status untuk "Dibatalkan"
        $karyawan->save();

        return redirect()->back()->with('success', 'Pengajuan akun berhasil dibatalkan.');
    }
}
