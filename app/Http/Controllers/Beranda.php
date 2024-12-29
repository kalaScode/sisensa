<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Beranda extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::User()->id_Otoritas;
        // Kirimkan nilai pencarian dan data perusahaan ke view
        return view('page.pberanda', [
            'role' => $role,
        ]);
    }
}
