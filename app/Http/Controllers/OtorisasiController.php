<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Otoritas;
use App\Models\User;

class OtorisasiController extends Controller
{
    /**
     * Menampilkan daftar otorisasi.
     */
    public function index()
    {
        $otorisasi = Auth::user()->id_Otoritas; // Mengambil otorisasi dari user yang login

        if ($otorisasi == 1) {
            // Menampilkan semua user jika otorisasi adalah 1
            $users = User::paginate(10);
        } elseif ($otorisasi == 2) {
            // Menampilkan user berdasarkan id_Perusahaan yang sama dan tidak termasuk id_Otoritas = 1
            $id_Perusahaan = Auth::user()->id_Perusahaan; // Ambil id_Perusahaan dari user yang login
            $users = User::where('id_Perusahaan', $id_Perusahaan)
                ->where('id_Otoritas', '!=', 1) // Membatasi id_Otoritas agar tidak menampilkan Master Admin
                ->paginate(10);
        } else {
            // Untuk otorisasi lainnya, mengembalikan koleksi kosong
            $users = User::where('id', 0)->paginate(10); // Menggunakan paginate dengan hasil kosong
        }

        // Ambil semua otoritas untuk dropdown di view
        $allOtorisasi = Otoritas::all();

        return view('page.potorisasi', compact('otorisasi', 'users', 'allOtorisasi'));
    }

    public function OtorisasiKaryawan(Request $request)
    {
        $otorisasi = Auth::user()->id_Otoritas; // Mengambil otorisasi dari user yang login

        // Handle the search input
        $search = $request->input('search');

        if ($otorisasi == 1) {
            // Menampilkan semua user jika otorisasi adalah 1 dan mencari berdasarkan input search
            $users = User::where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%') // mencari berdasarkan nama
                        ->orWhere('user_id', 'like', '%' . $search . '%'); // atau berdasarkan user_id
                }
            })->paginate(10);
        } elseif ($otorisasi == 2) {
            // Menampilkan user berdasarkan id_Perusahaan yang sama dan tidak termasuk id_Otoritas = 1 dan mencari berdasarkan input search
            $id_Perusahaan = Auth::user()->id_Perusahaan; // Ambil id_Perusahaan dari user yang login
            $users = User::where('id_Perusahaan', $id_Perusahaan)
                ->where('id_Otoritas', '!=', 1) // Membatasi id_Otoritas agar tidak menampilkan Master Admin
                ->where(function ($query) use ($search) {
                    if ($search) {
                        $query->where('name', 'like', '%' . $search . '%') // mencari berdasarkan nama
                            ->orWhere('user_id', 'like', '%' . $search . '%'); // atau berdasarkan user_id
                    }
                })
                ->paginate(10);
        } else {
            // Untuk otorisasi lainnya, mengembalikan koleksi kosong
            $users = User::where('id', 0)->paginate(10); // Menggunakan paginate dengan hasil kosong
        }

        // Ambil semua otoritas untuk dropdown di view
        $allOtorisasi = Otoritas::all();

        return view('page.potorisasi-karyawan', compact('otorisasi', 'users', 'allOtorisasi', 'search'));
    }



    /**
     * Menampilkan form untuk membuat otorisasi baru.
     */
    public function create()
    {
        return view('otorisasi.create');
    }

    /**
     * Menyimpan data otorisasi baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_Otoritas' => 'required|string|max:255',
            'add_menus' => 'required|array',
            'add_menus.*' => 'in:Presensi,Cuti,Daftar Karyawan,Edit Daftar Karyawan,Persetujuan,Persetujuan Akun,Riwayat Presensi Pribadi,Riwayat Presensi Karyawan,Riwayat Cuti Pribadi,Riwayat Cuti Karyawan,Buat Pengumuman',
        ]);

        // Cek apakah otorisasi sudah ada
        $existingOtorisasi = Otoritas::where('nama_Otoritas', $request->nama_Otoritas)->first();
        if ($existingOtorisasi) {
            return redirect()
                ->route('otorisasi.index', $existingOtorisasi->id_Otoritas)
                ->with('warning', "Otorisasi dengan nama '{$request->nama_Otoritas}' sudah ada. Silakan edit data tersebut.");
        }

        // Mapping checkbox menjadi Ya/Tidak
        $add_menus = [
            'Presensi' => in_array('Presensi', $request->add_menus) ? 'Ya' : 'Tidak',
            'Cuti' => in_array('Cuti', $request->add_menus) ? 'Ya' : 'Tidak',
            'daftar_Karyawan' => in_array('Daftar Karyawan', $request->add_menus) ? 'Ya' : 'Tidak',
            'edit_daftarKaryawan' => in_array('Edit Daftar Karyawan', $request->add_menus) ? 'Ya' : 'Tidak',
            'Persetujuan' => in_array('Persetujuan', $request->add_menus) ? 'Ya' : 'Tidak',
            'persetujuan_Akun' => in_array('Persetujuan Akun', $request->add_menus) ? 'Ya' : 'Tidak',
            'riwayat_presensiPribadi' => in_array('Riwayat Presensi Pribadi', $request->add_menus) ? 'Ya' : 'Tidak',
            'riwayat_presensiKaryawan' => in_array('Riwayat Presensi Karyawan', $request->add_menus) ? 'Ya' : 'Tidak',
            'riwayat_cutiPribadi' => in_array('Riwayat Cuti Pribadi', $request->add_menus) ? 'Ya' : 'Tidak',
            'riwayat_cutiKaryawan' => in_array('Riwayat Cuti Karyawan', $request->add_menus) ? 'Ya' : 'Tidak',
            'buat_Pengumuman' => in_array('Buat Pengumuman', $request->add_menus) ? 'Ya' : 'Tidak',
        ];

        // Simpan data ke database
        Otoritas::create(array_merge($add_menus, [
            'nama_Otoritas' => $request->nama_Otoritas,
            'created_By' => Auth::user()->user_id,
        ]));

        return redirect()->route('otorisasi.index')->with('success', 'Otorisasi berhasil ditambahkan!');
    }





    /**
     * Menampilkan detail otorisasi.
     */
    public function show($id)
    {
        $otorisasi = Otoritas::findOrFail($id);
        return view('otorisasi.show', compact('otorisasi'));
    }

    /**
     * Menampilkan form untuk mengedit otorisasi.
     */
    public function edit($id)
    {
        $otorisasi = Otoritas::findOrFail($id);
        return view('otorisasi.edit', compact('otorisasi'));
    }

    /**
     * Memperbarui data otorisasi di database.
     */
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_Otoritas' => 'required|exists:otorisasi,id_Otoritas',
            'nama_Otoritas' => 'required|string|max:255|unique:otorisasi,nama_Otoritas,' . $request->id_Otoritas . ',id_Otoritas',
            'edit_menus' => 'required|array',
            'edit_menus.*' => 'in:Presensi,Cuti,Daftar Karyawan,Edit Daftar Karyawan,Persetujuan,Persetujuan Akun,Riwayat Presensi Pribadi,Riwayat Presensi Karyawan,Riwayat Cuti Pribadi,Riwayat Cuti Karyawan,Buat Pengumuman',
        ]);

        // Mapping checkbox menjadi Ya/Tidak
        $menus = [
            'Presensi' => in_array('Presensi', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
            'Cuti' => in_array('Cuti', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
            'daftar_Karyawan' => in_array('Daftar Karyawan', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
            'edit_daftarKaryawan' => in_array('Edit Daftar Karyawan', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
            'Persetujuan' => in_array('Persetujuan', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
            'persetujuan_Akun' => in_array('Persetujuan Akun', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
            'riwayat_presensiPribadi' => in_array('Riwayat Presensi Pribadi', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
            'riwayat_presensiKaryawan' => in_array('Riwayat Presensi Karyawan', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
            'riwayat_cutiPribadi' => in_array('Riwayat Cuti Pribadi', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
            'riwayat_cutiKaryawan' => in_array('Riwayat Cuti Karyawan', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
            'buat_Pengumuman' => in_array('Buat Pengumuman', $request->edit_menus ?? []) ? 'Ya' : 'Tidak',
        ];

        // Update data
        $otorisasi = Otoritas::findOrFail($request->id_Otoritas);
        $otorisasi->update(array_merge($menus, [
            'nama_Otoritas' => $request->nama_Otoritas,
        ]));

        return redirect()->route('otorisasi.index')->with('success', 'Data berhasil diperbarui!');
    }


    /**
     * Menghapus otorisasi dari database.
     */
    public function destroy($id)
    {
        $otorisasi = Otoritas::findOrFail($id);
        $otorisasi->delete();

        return redirect()->route('otorisasi.index')->with('delete', 'Otorisasi berhasil dihapus!');
    }

    public function createUserRole()
    {
        // Ambil semua data user dan role
        $users = User::all();
        $roles = Otoritas::all();

        // Kirim data ke view
        return view('user_roles.create', compact('users', 'roles'));
    }

    public function storeUserRole(Request $request, $id)
    {
        $request->validate([
            'id_Otoritas' => 'required|exists:otorisasi,id_Otoritas',
        ]);

        $user = User::findOrFail($id);
        $user->id_Otoritas = $request->id_Otoritas; // Update role user
        $user->save();

        return redirect()->back()->with('success', 'Role pengguna berhasil diperbarui!');
    }
}
