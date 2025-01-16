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
    
        // Default jam masuk
        $jamMasuk = $jamMasukDefault;
        
        // Cek presensi masuk hari ini
        $presensiMasuk = Presensi::where('user_id', Auth::id())
            ->whereDate('Tanggal', Carbon::today())
            ->where('Bagian', 'Masuk')
            ->first();
    
        if ($presensiMasuk) {
            $presentMasuk = Carbon::parse($presensiMasuk->Waktu);
        }
    
        // Cek presensi keluar hari ini
        $presensiKeluar = Presensi::where('user_id', Auth::id())
            ->whereDate('Tanggal', Carbon::today())
            ->where('Bagian', 'Keluar')
            ->first();
    
        if ($presensiKeluar) {
            $jamKeluar = Carbon::parse($presensiKeluar->Waktu);
        } else {
            $jamKeluar = null; // Jika belum ada presensi keluar
        }
    
        // Hitung lama kerja
        $waktuSekarang = Carbon::now();
        
        // Jika presensi masuk dilakukan sebelum jam masuk perusahaan, hitung dari jam masuk
        if ($jamMasuk->gt($presensiMasuk ? Carbon::parse($presensiMasuk->Waktu) : Carbon::now())) {
            $lamaKerja = $waktuSekarang->diffInMinutes($jamMasuk); // Hitung selisih antara waktu sekarang dan jam masuk
        } else {
            $lamaKerja = $waktuSekarang->diffInMinutes($presentMasuk); // Hitung selisih antara waktu sekarang dan waktu presensi masuk
        }
        
        // Mengubah lama kerja dalam menit menjadi format jam dan menit
        $hours = floor($lamaKerja / 60+1);
        $minutes = $lamaKerja % 60;
        $lamaKerjaFormatted = sprintf('%02d:%02d', abs($hours), abs($minutes));
    
        return view('page.pberanda', [
            'role' => $role,
            'latestNotification' => $latestNotification,
            'title' => 'Dashboard Beranda',
            'jamMasuk' => $presentMasuk->format('H:i'), // Format jam:menit
            'jamKeluar' => $jamKeluar ? $jamKeluar->format('H:i') : '--:--', // Format jam:menit jika ada presensi keluar, jika tidak '--:--'
            'lamaKerja' => $lamaKerjaFormatted, // Lama kerja dalam format jam:menit
        ]);
    }
}
