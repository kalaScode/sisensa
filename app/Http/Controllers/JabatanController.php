<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Auth;

class JabatanController extends Controller
{
    /**
     * Menampilkan daftar jabatan.
     */
    public function index(request $request)
    {
        $query = Jabatan::query();
        $user = Auth::user();

        if ($user->id_Otoritas == 2) {
            // Jika id_Otoritas == 2, hanya jabatan dari perusahaan user yang login
            $query->where('id_Perusahaan', $user->id_Perusahaan);
        }

        // Filtering by Perusahaan
        if ($request->filled('filter_perusahaan')) {
            $query->where('id_Perusahaan', $request->filter_perusahaan);
        }

        // Search by nama_Jabatan
        if ($request->filled('search')) {
            $query->where('nama_Jabatan', 'LIKE', '%' . $request->search . '%');
        }

        $jabatans = $query->with('perusahaan')->paginate(10);
        $perusahaans = $user->id_Otoritas == 1
            ? Perusahaan::all()
            : Perusahaan::where('id_Perusahaan', $user->id_Perusahaan)->get();
        $id_Otoritas = $user->id_Otoritas;
        $id_Perusahaan_User = $user->id_Perusahaan;

        return view('page.pjabatan', compact('jabatans', 'perusahaans', 'id_Otoritas', 'id_Perusahaan_User'));
    }

    /**
     * Menampilkan form untuk membuat jabatan baru.
     */
    public function create()
    {
        $perusahaans = Perusahaan::all();
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('page.pjabatan', [
            'perusahaans' => $perusahaans,
            'id_Otoritas' => $user->id_Otoritas,
            'id_Perusahaan_User' => $user->id_Perusahaan, // Perusahaan user jika id_Otoritas == 2
        ]);
    }


    /**
     * Menyimpan data jabatan baru.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->id_Otoritas == 2) {
            $request->merge(['id_Perusahaan' => $user->id_Perusahaan]);
        }

        $request->validate([
            'id_Perusahaan' => 'required|exists:perusahaan,id_Perusahaan',
            'nama_Jabatan' => 'required|string|max:255',
        ]);

        Jabatan::create([
            'id_Perusahaan' => $request->id_Perusahaan,
            'nama_Jabatan' => $request->nama_Jabatan,
            'created_By' => $user->id,
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    /**
     * Mengupdate data jabatan yang sudah ada.
     */
    public function update(Request $request, $id_Jabatan)
    {
        $request->validate([
            'id_Perusahaan' => 'required|integer',
            'nama_Jabatan' => 'required|string|max:255',
        ]);

        $jabatan = Jabatan::findOrFail($id_Jabatan);

        $jabatan->update([
            'id_Perusahaan' => $request->id_Perusahaan,
            'nama_Jabatan' => $request->nama_Jabatan,
            'updated_At' => now(),
            'updated_By' => Auth::user()->user_id, // Asumsikan user login
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    /**
     * Menghapus data jabatan.
     */
    public function destroy($id_Jabatan)
    {
        $jabatan = Jabatan::findOrFail($id_Jabatan);
        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('delete', 'Jabatan berhasil dihapus.');
    }
}
