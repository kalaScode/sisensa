<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Jabatan;
use App\Models\SaldoCuti;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KaryawanController extends Controller
{
    // Tampilkan daftar karyawan
    public function index(Request $request)
    {
        $query = Karyawan::query();

        // Filter berdasarkan status akun = 1
        $query->where('status_Akun', 1)
            ->where(function ($query) {
                $query->where('id_Otoritas', '!=', 1)
                    ->where('id_Perusahaan', Auth::user()->id_Perusahaan);
            });

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
        $role = Auth::User()->id_Otoritas;
        // Kirimkan nilai pencarian dan data perusahaan ke view
        return view('page.pdaftar_karyawan', [
            'karyawan' => $karyawan,
            'search' => $request->search,
            'perusahaan' => $perusahaan, // Kirim data perusahaan
            'role' => $role,
        ]);
    }

    public function persetujuan(Request $request)
    {
        $query = Karyawan::query();

        // Filter berdasarkan status akun = 0
        $query->where('status_Akun', 0)
            ->where(function ($query) {
                $query->where('id_Otoritas', '!=', 1)
                    ->where('id_Perusahaan', Auth::user()->id_Perusahaan);
            });

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
        $pemberiPersetujuan = Karyawan::where('id_Otoritas', 3)->first()->name;

        return view('page.pprofil', compact('pemberiPersetujuan'));
    }

    public function getEditProfil()
    {
        $pemberiPersetujuan = Karyawan::where('id_Otoritas', 3)->first()->name;

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

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status_Kerja' => 'required|string|in:Tetap,Kontrak',
            'status_Akun' => 'required|boolean',
            'no_Telp' => [
                'required',
                'regex:/^08\d{8,14}$/', // Validasi nomor telepon
            ],
            'alamat' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255', // Validasi untuk jabatan
            'saldo' => 'nullable|integer|min:0', // Validasi saldo cuti
        ], [
            'no_Telp.regex' => 'Nomor telepon harus dimulai dengan 08 dan terdiri dari 10 hingga 15 angka.',
        ]);

        // Cari karyawan berdasarkan ID
        $karyawan = Karyawan::find($request->user_id);  // Anda bisa menyesuaikan pencarian dengan kebutuhan

        // Cek apakah karyawan ditemukan
        if ($karyawan) {
            // Jika ada input jabatan, cari atau buat jabatan baru
            if ($request->filled('jabatan')) {
                // Cari jabatan berdasarkan nama Jabatan
                $jabatan = Jabatan::firstOrCreate(['nama_Jabatan' => $request->jabatan]);

                // Update kolom id_Jabatan di tabel user (relasi dengan jabatan)
                $karyawan->id_Jabatan = $jabatan->id_Jabatan;
            }

            // Update data karyawan lainnya
            $karyawan->update([
                'name' => $request->name,
                'email' => $request->email,
                'status_Kerja' => $request->status_Kerja,
                'status_Akun' => $request->status_Akun,
                'no_Telp' => $request->no_Telp,
                'Alamat' => $request->alamat,
            ]);

            // Redirect atau memberikan respon setelah update
            return redirect()->route('daftar-karyawan')->with('success', 'Data karyawan berhasil diperbarui.');
        }

        // Jika karyawan tidak ditemukan
        return redirect()->route('daftar-karyawan')->with('error', 'Karyawan tidak ditemukan.');
    }


    // Menangani update data karyawan
    public function update2(Request $request)
    {
        Log::info('User ID:', ['user_id' => $request->user_id]);

        $karyawan = User::find($request->user_id);

        if (!$karyawan) {
            Log::warning('User not found:', ['user_id' => $request->user_id]);
            return redirect()->route('daftar-karyawan')->with('error', 'Data karyawan tidak ditemukan.');
        }

        // Update data
        $karyawan->update([
            'name' => $request->nama,
            'perusahaan' => $request->perusahaan,
            'jabatan' => $request->jabatan,
            'status_Kerja' => $request->statuskerja,
            'status_Akun' => $request->statusakun,
            'email' => $request->email,
            'no_Telp' => $request->telepon,
            'alamat' => $request->alamat,
            'saldo_Cuti' => $request->saldo,
        ]);

        return redirect()->route('daftar-karyawan')->with('success', 'Data karyawan berhasil diperbarui.');
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