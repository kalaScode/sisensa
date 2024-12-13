<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarKaryawan extends Controller
{
    function index()
    {
        return view('page.pdaftar_karyawan', [
            'role' => "admin"
        ]);
    }
}
