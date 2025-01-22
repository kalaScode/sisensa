<?php

namespace App\Http\Controllers;

use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\User;
use App\Models\Presensi;
use App\Models\Otoritas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Beranda extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::user()->id_Otoritas;
        $latestNotification = Auth::user()->notifications()->latest()->first();
        $dataOtorisasi = Otoritas::where('id_Otoritas', Auth::user()->id_Otoritas)->first();

        if (in_array($role, [1, 2])) {
            return redirect('/dashboard');
        }

        // Ambil data perusahaan user
        $id_Perusahaan = Auth::user()->id_Perusahaan;
        $perusahaan = DB::table('perusahaan')
            ->select('jam_Masuk', 'jam_Keluar')
            ->where('id_Perusahaan', $id_Perusahaan)
            ->first();

        if (!$perusahaan) {
            return redirect()->back()->withErrors(['error' => 'Data perusahaan tidak ditemukan.']);
        }

        // Cek presensi masuk hari ini
        $presensiMasuk = Presensi::where('user_id', Auth::id())
            ->whereDate('Tanggal', Carbon::today('GMT+7')->setTimezone('Asia/Jakarta'))
            ->where('Bagian', 'Masuk')
            ->where('status_Presensi', 'Disetujui')
            ->first();

        if ($presensiMasuk) {
            $presentMasuk = Carbon::parse($presensiMasuk->Waktu, 'GMT+7')->setTimezone('Asia/Jakarta');
        } else {
            $presentMasuk = null; // Jika belum ada presensi masuk
        }

        // Cek presensi keluar hari ini
        $presensiKeluar = Presensi::where('user_id', Auth::id())
            ->whereDate('Tanggal', Carbon::today('GMT+7')->setTimezone('Asia/Jakarta'))
            ->where('Bagian', 'Keluar')
            ->where('status_Presensi', 'Disetujui')
            ->first();

        if ($presensiKeluar) {
            $jamKeluar = Carbon::parse($presensiKeluar->Waktu, 'GMT+7')->setTimezone('Asia/Jakarta');
        } else {
            $jamKeluar = null; // Jika belum ada presensi keluar
        }

        // Hitung lama kerja
        $waktuSekarang = Carbon::now('GMT+7')->setTimezone('Asia/Jakarta');
        $lamaKerjaFormatted = '--:--';

        // Jika presensi masuk dilakukan sebelum jam masuk perusahaan, hitung dari jam masuk
        if ($presentMasuk) {
            // Jika sudah ada presensi keluar, hitung lama kerja dari presensi masuk hingga presensi keluar
            if ($presensiKeluar) {
                $lamaKerja = $presentMasuk->diffInMinutes($jamKeluar);
                // Mengubah lama kerja dalam menit menjadi format jam dan menit
                $hours = floor($lamaKerja / 60);
                $minutes = $lamaKerja % 60;
                $lamaKerjaFormatted = sprintf('%02d:%02d', abs($hours), abs($minutes));
            } else {
                $lamaKerja = $waktuSekarang->diffInMinutes($presentMasuk);
                // Mengubah lama kerja dalam menit menjadi format jam dan menit
                $hours = floor($lamaKerja / 60 + 1);
                $minutes = $lamaKerja % 60;
                $lamaKerjaFormatted = sprintf('%02d:%02d', abs($hours), abs($minutes));;
            }
        }
        $lamaKerjaColor = 'text-yellow-500'; // Default warna

        if ($presensiKeluar) {
            $lamaKerjaColor = 'text-red-500'; // Ubah warna jika presensi keluar sudah dilakukan
        }
        return view('page.pberanda', [
            'role' => $role,
            'dataOtorisasi' => $dataOtorisasi,
            'latestNotification' => $latestNotification,
            'title' => 'Dashboard Beranda',
            'jamMasuk' => $presentMasuk ? $presentMasuk->format('H:i') : '--:--', // Format jam:menit
            'jamKeluar' => $jamKeluar ? $jamKeluar->format('H:i') : '--:--', // Format jam:menit jika ada presensi keluar, jika tidak '--:--'
            'lamaKerja' => $lamaKerjaFormatted, // Lama kerja dalam format jam:menit
            'lamaKerjaColor' => $lamaKerjaColor,
        ]);
    }
}
