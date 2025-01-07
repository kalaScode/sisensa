<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\Perusahaan;
use App\Models\Jabatan;
use App\Models\User;
use App\Models\SaldoCuti;
use App\Notifications\PerubahanStatusAkun;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KaryawanController extends Controller
{
    // Tampilkan daftar karyawan
    public function getDaftarKaryawan(Request $request)
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

    public function getPersetujuanAkun(Request $request)
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
        $pemberiPersetujuan = Karyawan::where('id_Otoritas', 3)
            ->where('id_Perusahaan', Auth::user()->id_Perusahaan) // Filter berdasarkan perusahaan saat ini
            ->value('name'); // Hanya ambil kolom 'name'

        return view('page.pprofil', compact('pemberiPersetujuan'));
    }

    public function getEditProfil()
    {
        $pemberiPersetujuan = Karyawan::where('id_Otoritas', 3)
            ->where('id_Perusahaan', Auth::user()->id_Perusahaan) // Filter berdasarkan perusahaan saat ini
            ->value('name'); // Hanya ambil kolom 'name'

        return view('page.pedit-profil', compact('pemberiPersetujuan'));
    }

    public function updateDataKaryawan(Request $request, $id)
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

            // Redirect dengan status sukses
            return redirect()->route('daftar-karyawan')->with('success', 'Data karyawan berhasil diperbarui.');
        }

        // Jika karyawan tidak ditemukan
        return redirect()->route('daftar-karyawan')->with('error', 'Karyawan tidak ditemukan.');
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
    public function ubahStatusAkun($user_id)
    {
        // Cari karyawan berdasarkan ID
        $karyawan = User::findOrFail($user_id);

        // Ubah status akun menjadi 1
        $karyawan->status_Akun = 1;
        $karyawan->save();

        // Kirim notifikasi ke karyawan
        $sender = Auth::user();
        $user = User::find($karyawan->user_id); // Sesuaikan jika ada relasi dengan tabel user
        if ($user) {
            $user->notify(new PerubahanStatusAkun('aktif', $sender));; // Status "aktif" dikirim dalam notifikasi
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status akun berhasil diperbarui dan notifikasi dikirim.');
    }

    //Batalkan pengajuan akun
    public function batalkanAkun($user_id)
    {
        // Cari karyawan berdasarkan user_id
        $karyawan = Karyawan::findOrFail($user_id);

        // Ubah status akun menjadi dibatalkan
        $karyawan->status_Akun = 2; // Misalnya 2 berarti akun dibatalkan
        $karyawan->save();
        $sender = Auth::user();
        // Kirim notifikasi ke karyawan jika ada relasi dengan User
        $user = User::find($karyawan->user_id); // Sesuaikan dengan relasi yang benar
        if ($user) {
            $user->notify(new PerubahanStatusAkun('dibatalkan', $sender)); // Status "dibatalkan" dikirim dalam notifikasi
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pengajuan akun berhasil dibatalkan dan notifikasi dikirim.');
    }


    // Update kolom Avatar di tabel user
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,jpg,png|max:5120', // Max 5MB
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {

            if (!$user || !($user instanceof User)) {
                return redirect()->back()->with('error', 'User tidak valid.');
            }
            // Hapus avatar lama jika ada
            if ($user->Avatar && Storage::exists('public/' . $user->Avatar)) {
                Storage::delete('public/' . $user->Avatar);
            }
            // Simpan file baru
            $filePath = $request->file('avatar')->store('public/avatars');
            $fileName = str_replace('public/', '', $filePath);

            // Update path avatar di database
            $user->Avatar = $fileName;
            $user->save();

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui foto profil.');
    }

    // Update nomor telepon
    public function updateTelepon(Request $request)
    {
        // Validasi nomor telepon menggunakan regex
        $request->validate([
            'telepon' => ['required', 'regex:/^08\d{8,13}$/', 'max:15'],
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Validasi jika user tidak ditemukan
        if (!$user || !($user instanceof User)) {
            return redirect()->back()->with('error', 'User tidak valid.');
        }

        // Update nomor telepon
        $user->no_Telp = $request->telepon;
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Nomor telepon berhasil diperbarui!');
    }

    // Update alamat
    public function updateAlamat(Request $request)
    {
        $request->validate([
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        if (!$user || !($user instanceof User)) {
            return redirect()->back()->with('error', 'User tidak valid.');
        }

        $user->Alamat = htmlspecialchars($request->alamat, ENT_QUOTES, 'UTF-8'); // Mencegah serangan XSS
        $user->save();

        return redirect()->back()->with('success', 'Alamat berhasil diperbarui!');
    }
}
