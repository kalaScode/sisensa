<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Beranda extends Controller
{
    function index()
    {
        return view('page.pberanda', [
            'role' => "atasan"
        ]);
        
    }
}
