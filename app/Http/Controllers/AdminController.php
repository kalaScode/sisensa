<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Otoritas;
use App\Models\Sessions;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $idPerusahaan = $user->id_Perusahaan;

        // Kondisi untuk id_Otoritas = 1 atau id_Otoritas = 2
        if ($user->id_Otoritas == 1) {
            // Semua pengguna jika id_Otoritas = 1
            $users = User::all();

            // Distribusi role untuk semua pengguna
            $distribusi_role = User::selectRaw('id_otoritas, COUNT(*) as jumlah')
                ->groupBy('id_otoritas')
                ->get()
                ->map(function ($role) {
                    $role->nama_Otoritas = Otoritas::where('id_Otoritas', $role->id_otoritas)->value('nama_Otoritas');
                    return $role;
                });

        } elseif ($user->id_Otoritas == 2) {
            // Pengguna sesuai id_Perusahaan jika id_Otoritas = 2
            $users = User::where('id_Perusahaan', $idPerusahaan)->get();

            // Distribusi role untuk pengguna dalam perusahaan
            $distribusi_role = User::selectRaw('id_otoritas, COUNT(*) as jumlah')
                ->where('id_Perusahaan', $idPerusahaan)
                ->groupBy('id_otoritas')
                ->get()
                ->map(function ($role) {
                    $role->nama_Otoritas = Otoritas::where('id_Otoritas', $role->id_otoritas)->value('nama_Otoritas');
                    return $role;
                });
        }

        // Total pengguna
        $total_pengguna = $users->count();

        // Pengguna aktif
        $pengguna_aktif = $users->where('status_Akun', 1)->count();

        // Total role
        $total_role = Otoritas::count();

         // Mendapatkan waktu hari ini dalam format Unix timestamp (hari ini pada pukul 00:00:00)
         $startOfDay = Carbon::today()->startOfDay()->timestamp;
         $endOfDay = Carbon::today()->endOfDay()->timestamp;
 
         // Mengambil data sesi yang terjadi hari ini berdasarkan last_activity (dalam format Unix timestamp)
         $activity_today = Sessions::where('last_activity', '>=', $startOfDay)
                                  ->where('last_activity', '<=', $endOfDay)
                                  ->count(); // Menghitung jumlah sesi yang aktif hari ini

        return view('page.pdashboard', [
            'total_pengguna' => $total_pengguna,
            'pengguna_aktif' => $pengguna_aktif,
            'total_role' => $total_role,
            'distribusi_role' => $distribusi_role,
            'activity_today' => $activity_today
        ]);
    }
}