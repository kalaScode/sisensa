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
    public function index(Request $request)
    {
        $user = Auth::user();
        $role = Auth::User()->id_Otoritas;

        // Filter berdasarkan status
        $filter = $request->query('filter', 'all');

        switch ($filter) {
            case 'read':
                $notifications = $user->notifications->whereNotNull('read_at'); // Menampilkan hanya notifikasi yang sudah dibaca
                break;
            case 'unread':
                $notifications = $user->notifications->whereNull('read_at'); // Menampilkan hanya notifikasi yang belum dibaca
                break;
            case 'all':
            default:
                $notifications = $user->notifications; // Menampilkan semua notifikasi
                break;
        }

        return view('page.pnotifikasi', compact('notifications', 'role'));
    }


    public function showNotifications(Request $request)
    {
        $notifications = Auth::user()->notifications; // Mengambil semua notifikasi yang terkait dengan user
        $role = Auth::User()->id_Otoritas;
        return view('page.pnotifikasi', compact('notifications', 'role')); // Kirim ke view notifikasi.blade.php
    }

    public function getLatestNotifications()
    {
        $notifications = Notification::latest()->take(5)->get();
        $unreadNotification = Auth::user()->unreadNotifications->count();
        return response()->json([
            'status' => 'success',
            'notifications' => $notifications,
            'unreadNotification' => $unreadNotification,
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
            return redirect()->back()->with('success', 'Notifikasi berhasil ditandai sebagai sudah dibaca');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat menandai notifikasi');
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

        // Mengambil semua pengguna dari perusahaan yang sama
        $sender = Auth::user(); // Pengirim adalah pengguna yang sedang login
        $users = User::where('id_Perusahaan', $sender->id_Perusahaan)->get(); // Menyaring pengguna berdasarkan perusahaan yang sama

        // Mengirim notifikasi kepada semua pengguna yang berada dalam perusahaan yang sama
        Notification::send($users, new PengumumanGeneral($request->judul, $request->isi_pengumuman, $sender));

        // Redirect ke halaman form pembuatan pengumuman dengan pesan sukses
        return redirect()->route('pengumuman.create')->with('success', 'Pengumuman berhasil dibuat!');
    }
}
