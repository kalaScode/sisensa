<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;

class PerusahaanController extends Controller
{
    /**
     * Menampilkan daftar perusahaan untuk dropdown pada form pendaftaran.
     */
    public function getPerusahaan()
    {
        // Ambil semua data perusahaan
        $perusahaan = Perusahaan::all();

        // Kirim data perusahaan ke view register.blade.php
        return view('auth.register', compact('perusahaan'));
    }
}
