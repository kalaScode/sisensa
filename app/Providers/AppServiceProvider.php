<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use app\Models\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = Auth::user();

            // Memeriksa apakah user valid
            if (!$user || !($user instanceof User)) {
                return redirect()->back()->with('error', 'User tidak valid.');
            }

            // Menampilkan 5 notifikasi terbaru untuk navbar
            $notificationsNavbar = $user->notifications()
                ->with(['notifiable' => function ($query) {
                    $query->select('user_id', 'name', 'id_Jabatan', 'Avatar')->with('jabatan:id_Jabatan,nama_Jabatan');
                }])
                ->latest()
                ->take(5) // Membatasi hanya 5 notifikasi
                ->get();

            // Menampilkan semua notifikasi untuk halaman notifikasi
            $notificationsPage = $user->notifications()
                ->with(['notifiable' => function ($query) {
                    $query->select('user_id', 'name', 'id_Jabatan', 'Avatar')->with('jabatan:id_Jabatan,nama_Jabatan');
                }])
                ->latest()
                ->get();

            // Menghitung jumlah notifikasi yang belum dibaca
            $unreadNotifications = $user->unreadNotifications->count();

            // Membagikan data ke tampilan
            $view->with('notificationsNavbar', $notificationsNavbar)
                ->with('notificationsPage', $notificationsPage)
                ->with('unreadNotifications', $unreadNotifications);
        });
    }
}
