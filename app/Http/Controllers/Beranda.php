<?php

namespace App\Http\Controllers;

use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\User;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Beranda extends Controller
{
    public function index(Request $request)
{
    $role = Auth::user()->id_Otoritas;
    $latestNotification = Auth::user()->notifications()->latest()->first();

    // Ambil data perusahaan user
    $id_Perusahaan = Auth::user()->id_Perusahaan;
    $perusahaan = DB::table('perusahaan')
        ->select('jam_Masuk', 'jam_Keluar')
        ->where('id_Perusahaan', $id_Perusahaan)
        ->first();

    if (!$perusahaan) {
        return redirect()->back()->withErrors(['error' => 'Data perusahaan tidak ditemukan.']);
    }

    $jamMasukDefault = Carbon::parse($perusahaan->jam_Masuk);
    $jamKeluarDefault = Carbon::parse($perusahaan->jam_Keluar);

    // Default jam masuk dan jam keluar
    $jamMasuk = $jamMasukDefault;
    $jamKeluar = null; // Akan digunakan untuk menghitung countdown

    // Cek presensi masuk hari ini
    $presensiMasuk = Presensi::where('user_id', Auth::id())
        ->whereDate('Tanggal', Carbon::today())
        ->where('Bagian', 'Masuk')
        ->first();

    if ($presensiMasuk) {
        $jamMasuk = Carbon::parse($presensiMasuk->Waktu);
    }

    // Cek presensi keluar hari ini
    $presensiKeluar = Presensi::where('user_id', Auth::id())
        ->whereDate('Tanggal', Carbon::today())
        ->where('Bagian', 'Keluar')
        ->first();

    if ($presensiKeluar) {
        $jamKeluar = Carbon::parse($presensiKeluar->Waktu);
    } else {
        $jamKeluar = $jamKeluarDefault; // Gunakan jam keluar default jika belum ada presensi keluar
    }

    // Hitung countdown
    $countdown = '--:--';
    $waktuSekarang = Carbon::now();

    if ($jamKeluar && $waktuSekarang < $jamKeluar) {
        $selisih = $jamKeluar->diffInMinutes($waktuSekarang); // Selisih dalam menit
        $hours = floor($selisih / 60+1);
        $minutes = $selisih % 60;
        $hours = abs($hours);
        $minutes = abs($minutes);

        $countdown = sprintf('%02d:%02d', $hours, $minutes);
    }

    return view('page.pberanda', [
        'role' => $role,
        'latestNotification' => $latestNotification,
        'title' => 'Dashboard Beranda',
        'jamMasuk' => $jamMasuk->format('H:i'), // Format jam:menit
        'jamKeluar' => $jamKeluar ? $jamKeluar->format('H:i') : '--:--', // Format jam:menit jika ada, jika tidak '--:--'
        'countdown' => $countdown, // Sisa waktu
    ]);
}

    

}
