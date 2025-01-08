<?php

namespace App\Http\Controllers;

use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\User;

class Beranda extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::user()->id_Otoritas;

        // Ambil notifikasi terbaru
        $latestNotification = Auth::user()->notifications()->latest()->first();

        // Kirimkan notifikasi terbaru ke view
        return view('page.pberanda', [
            'role' => $role,
            'latestNotification' => $latestNotification,
            'title' => 'Dashboard Beranda',
        ]);
    }
}
