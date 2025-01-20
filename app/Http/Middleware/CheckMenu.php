<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Otoritas;

class CheckMenu
{
    public function handle(Request $request, Closure $next, $menu)
    {
        $user = Auth::user();
        $otoritas = Otoritas::find($user->id_Otoritas); // Ambil data otorisasi berdasarkan id pengguna

        // Memeriksa apakah kolom yang dimaksud memiliki nilai 'Ya'
        if ($otoritas && isset($otoritas->$menu) && $otoritas->$menu === 'Ya') {
            return $next($request); // Lanjutkan jika akses diizinkan
        }

        // Jika tidak, redirect ke halaman tidak diizinkan atau lainnya
        return redirect('/unauthorized'); // Sesuaikan dengan URL yang sesuai
    }
}
