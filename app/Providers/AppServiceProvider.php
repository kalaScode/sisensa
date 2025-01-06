<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
            if (Auth::check()) {
                // Mengambil 5 notifikasi terbaru untuk user yang sedang login
                $notifications = Auth::user()->notifications()
                    ->with(['notifiable' => function ($query) {
                        $query->select('user_id', 'name', 'id_Jabatan', 'avatar')->with('jabatan:id_Jabatan,nama_Jabatan');
                    }])
                    ->latest()
                    ->take(5)
                    ->get();
                $unreadNotifications = Auth::user()->unreadNotifications->count();
                $view->with('notifications', $notifications)
                    ->with('unreadNotifications', $unreadNotifications);
            }
        });
    }
}
