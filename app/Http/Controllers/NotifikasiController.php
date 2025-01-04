<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\PengumumanGeneral;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\User;

class NotifikasiController extends Controller
{
    public function showNotifications(Request $request)
    {
        $notifications = Auth::user()->notifications; // Mengambil semua notifikasi yang terkait dengan user
        $role = Auth::User()->id_Otoritas;
        return view('page.pnotifikasi', compact('notifications', 'role')); // Kirim ke view notifikasi.blade.php
    }

    public function getLatestNotifications()
    {
        $notifications = Notification::latest()->take(5)->get();

        return response()->json([
            'status' => 'success',
            'notifications' => $notifications
        ]);
    }

    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead(); // Tandai semua notifikasi sebagai sudah dibaca
        return redirect()->back()->with('success', 'Semua notifikasi telah dibaca.');
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications->find($id);
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

    public function create()
    {
        return view('page.pbuat-pengumuman');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
        ]);

        // Mengirim notifikasi kepada semua pengguna
        $users = User::all(); // Anda bisa menyesuaikan dengan kondisi pengguna tertentu
        Notification::send($users, new PengumumanGeneral($request->judul, $request->isi_pengumuman));

        // Redirect ke halaman form pembuatan pengumuman
        return redirect()->route('pengumuman.create')->with('success', 'Pengumuman berhasil dibuat!');
    }
}
