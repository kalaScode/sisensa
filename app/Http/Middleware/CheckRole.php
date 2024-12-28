<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Periksa apakah pengguna memiliki salah satu dari ID otoritas yang diizinkan
        if ($user && in_array($user->id_Otoritas, $roles)) {
            return $next($request);
        }

        return redirect('/unauthorized')->with('error', 'Anda tidak memiliki akses.');
    }
}


