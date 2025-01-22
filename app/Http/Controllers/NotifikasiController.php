<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\PengumumanGeneral;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\User;
use App\Models\Otoritas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::user()->id_Otoritas;
        if (in_array($role, [1, 2])) {
            return redirect('/dashboard');
        }
        $user = Auth::user();
        $role = Auth::User()->id_Otoritas;
        $dataOtorisasi = Otoritas::where('id_Otoritas', Auth::user()->id_Otoritas)->first();

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

        return view('page.pnotifikasi', compact('notifications', 'role', 'dataOtorisasi'));
    }


    public function showNotifications(Request $request)
    {
        $role = Auth::user()->id_Otoritas;
        if (in_array($role, [1, 2])) {
            return redirect('/dashboard');
        }
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
            $notification->read_at = Carbon::now('GMT+7')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
            return redirect()->back()->with('success', 'Notifikasi berhasil ditandai sebagai sudah dibaca');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat menandai notifikasi');
    }

    public function create()
    {
        $role = Auth::user()->id_Otoritas;
        if (in_array($role, [1, 2])) {
            return redirect('/dashboard');
        }
        return view('page.pbuat-pengumuman');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string', // Tidak perlu memfilter HTML
        ]);

        // Mengambil data pengirim
        $sender = Auth::user();
        // Mendapatkan semua pengguna dalam perusahaan yang sama
        $users = User::where('id_Perusahaan', $sender->id_Perusahaan)->get();
        // DB::table('notifications')->insert([
        //     'created_By' => Auth::id(),
        //     'updated_By' => Auth::id(),
        //     'created_At' => Carbon::now('GMT+7')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        //     'updated_At' => Carbon::now('GMT+7')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        // ]);

        // Mengirim notifikasi pengumuman kepada pengguna lain dalam perusahaan
        Notification::send($users, new PengumumanGeneral($request->judul, $request->isi_pengumuman, $sender));

        // // Membuat data notifikasi
        // $data = [
        //     'message' => $request->judul,
        //     'description' => $request->isi_pengumuman, // Isi pengumuman dari CKEditor (HTML)
        //     'link' => '/notifikasi',
        //     'sender_name' => $sender->name,
        //     'sender_avatar' => $sender->Avatar,
        //     'sender_jabatan' => $sender->jabatan->nama_Jabatan,
        //     'sender_perusahaan_id' => $sender->id_Perusahaan,
        // ];

        // // Menyimpan notifikasi dalam format JSON ke tabel 'notifications'
        // DB::table('notifications')->insert([
        //     'type' => 'App\\Notifications\\PengumumanGeneral',
        //     'notifiable_type' => 'App\\Models\\User',
        //     'notifiable_id' => $sender->user_id,
        //     'data' => json_encode($data),  // Menyimpan data dalam format JSON
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pengumuman.create')->with('success', 'Pengumuman berhasil dibuat!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $image = $request->file('upload');
        $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('public/images', $imageName);

        return response()->json([
            'url' => Storage::url($imagePath) // Mengembalikan URL gambar
        ]);
    }
}
