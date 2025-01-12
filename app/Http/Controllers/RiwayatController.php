<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Presensi;
use App\Models\Cuti;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    // Tampilkan presensi karyawan
    public function getPresensiKaryawan(Request $request)
    {
        $query = Presensi::query();
        $id_Perusahaan = Auth::user()->id_Perusahaan;
        $direktur = User::where('id_Perusahaan', $id_Perusahaan)
                        ->where('id_Otoritas', 3)
                        ->pluck('name')
                        ->first();

        // Filter berdasarkan user_id yang sesuai dengan id_Perusahaan dan bukan user_id pengguna sendiri
        $query->whereHas('user', function ($query) use ($id_Perusahaan) {
            $query->where('id_Perusahaan', $id_Perusahaan);
        })
        ->where('presensi.user_id', '!=', Auth::user()->user_id); // Kecualikan presensi dari user yang sedang login

        // Join dengan tabel users untuk filter berdasarkan name, Waktu, status_Presensi, Bagian
        $query->join('users', 'presensi.user_id', '=', 'users.user_id')
            ->where('users.id_Perusahaan', $id_Perusahaan);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('presensi.status_Presensi', $request->status);
        }

        // Filter berdasarkan jenis
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('presensi.Bagian', $request->jenis);
        }

        // Pencarian berdasarkan name, Waktu, status_Presensi, Bagian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                ->orWhere('presensi.Waktu', 'like', '%' . $search . '%')
                ->orWhere('presensi.status_Presensi', 'like', '%' . $search . '%')
                ->orWhere('presensi.Bagian', 'like', '%' . $search . '%');
            });
        }

        // Pagination
        $presensi = $query->paginate(10);

        return view('page.priwayat-presensi-karyawan', [
            'presensi' => $presensi,
            'direktur' => $direktur,
            'search' => $request->search,
            'status' => $request->status,
            'jenis' => $request->jenis,
        ]);
    }

    // Tampilkan cuti karyawan
    public function getCutiKaryawan(Request $request)
    {
        $query = Cuti::query();
        $id_Perusahaan = Auth::user()->id_Perusahaan;
        $direktur = User::where('id_Perusahaan', $id_Perusahaan)
                        ->where('id_Otoritas', 3)
                        ->pluck('name')
                        ->first();

        // Filter berdasarkan user_id yang sesuai dengan id_Perusahaan dan bukan user_id pengguna sendiri
        $query->whereHas('user', function ($query) use ($id_Perusahaan) {
            $query->where('id_Perusahaan', $id_Perusahaan);
        })
        ->where('cuti.user_id', '!=', Auth::user()->user_id); // Kecualikan cuti dari user yang sedang login

        // Join dengan tabel users untuk filter berdasarkan name, Waktu, status_Cuti, jenis_Cuti
        $query->join('users', 'cuti.user_id', '=', 'users.user_id')
            ->where('users.id_Perusahaan', $id_Perusahaan);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('cuti.status_Cuti', $request->status);
        }

        // Filter berdasarkan jenis
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('cuti.jenis_Cuti', $request->jenis);
        }

        // Pencarian berdasarkan name, Waktu, status_cuti, Bagian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                ->orWhere('cuti.tanggal_Mulai', 'like', '%' . $search . '%')
                ->orWhere('cuti.tanggal_Selesai', 'like', '%' . $search . '%')
                ->orWhere('cuti.status_Cuti', 'like', '%' . $search . '%')
                ->orWhere('cuti.jenis_Cuti', 'like', '%' . $search . '%');
            });
        }

        // Pagination
        $cuti = $query->paginate(10);

        return view('page.priwayat-cuti-karyawan', [
            'cuti' => $cuti,
            'direktur' => $direktur,
            'search' => $request->search,
            'status' => $request->status,
            'jenis' => $request->jenis,
        ]);
    }

    // Tampilkan Presensi Pribadi
    public function getPresensiPribadi(Request $request)
    {
        $query = Presensi::query();
        $id_Perusahaan = Auth::user()->id_Perusahaan;
        $direktur = User::where('id_Perusahaan', $id_Perusahaan)
                        ->where('id_Otoritas', 3)
                        ->pluck('name')
                        ->first();

        // Filter berdasarkan user_id
        $query->where('presensi.user_id', Auth::User()->user_id);

        // Join dengan tabel users untuk filter berdasarkan name, Waktu, status_Presensi, Bagian
        $query->join('users', 'presensi.user_id', '=', 'users.user_id')
            ->where('users.id_Perusahaan', $id_Perusahaan);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('presensi.status_Presensi', $request->status);
        }

        // Filter berdasarkan jenis
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('presensi.Bagian', $request->jenis);
        }

        // Pencarian berdasarkan name, Waktu, status_Presensi, Bagian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                ->orWhere('presensi.Waktu', 'like', '%' . $search . '%')
                ->orWhere('presensi.status_Presensi', 'like', '%' . $search . '%')
                ->orWhere('presensi.Bagian', 'like', '%' . $search . '%');
            });
        }

        // Pagination
        $presensi = $query->paginate(10);
        
        // Filter berdasarkan rentang waktu (mingguan, bulanan, tahunan)
        if ($request->has('range')) {
            $range = $request->range;
            $today = \Carbon\Carbon::now();

            if ($range == 'mingguan') {
                $query->whereBetween('presensi.Waktu', [
                    $today->startOfWeek(), $today->endOfWeek()
                ]);
            } elseif ($range == 'bulanan') {
                $query->whereBetween('presensi.Waktu', [
                    $today->startOfMonth(), $today->endOfMonth()
                ]);
            } elseif ($range == 'tahunan') {
                $query->whereBetween('presensi.Waktu', [
                    $today->startOfYear(), $today->endOfYear()
                ]);
            }
        }

        // Get the attendance data for the chart
        $attendanceData = $this->getAttendanceData($request);

        return view('page.priwayat-presensi-pribadi', [
            'presensi' => $presensi,
            'direktur' => $direktur,
            'search' => $request->search,
            'status' => $request->status,
            'jenis' => $request->jenis,
            'attendanceData' => $attendanceData, // Pass data for the chart
        ]);
    }

    private function getAttendanceData(Request $request)
    {
        $range = $request->has('range') ? $request->range : 'mingguan';
        $today = \Carbon\Carbon::now();

        $query = Presensi::query();
        $query->where('presensi.user_id', Auth::User()->user_id);

        // Handle date range filtering for the chart
        if ($range == 'mingguan') {
            $query->whereBetween('presensi.Waktu', [
                $today->startOfWeek(), $today->endOfWeek()
            ]);
        } elseif ($range == 'bulanan') {
            $query->whereBetween('presensi.Waktu', [
                $today->startOfMonth(), $today->endOfMonth()
            ]);
        } elseif ($range == 'tahunan') {
            $query->whereBetween('presensi.Waktu', [
                $today->startOfYear(), $today->endOfYear()
            ]);
        }

        // Count attendance (approved status)
        $attendanceCounts = $query->where('presensi.status_Presensi', 'Disetujui')
                                ->selectRaw('count(*) as count, DATE_FORMAT(presensi.Waktu, "%Y-%m-%d") as date')
                                ->groupBy('date')
                                ->orderBy('date', 'asc')
                                ->get();

        return $attendanceCounts;
    }

    // Tampilkan cuti pribadi
    public function getCutiPribadi(Request $request)
    {
        $query = Cuti::query();
        $id_Perusahaan = Auth::user()->id_Perusahaan;
        $direktur = User::where('id_Perusahaan', $id_Perusahaan)
                        ->where('id_Otoritas', 3)
                        ->pluck('name')
                        ->first();

        // Filter berdasarkan user_id
        $query->where('cuti.user_id', Auth::User()->user_id);

        // Join dengan tabel users untuk filter berdasarkan name, Waktu, status_Cuti, jenis_Cuti
        $query->join('users', 'cuti.user_id', '=', 'users.user_id')
            ->where('users.id_Perusahaan', $id_Perusahaan);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('cuti.status_Cuti', $request->status);
        }

        // Filter berdasarkan jenis
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('cuti.jenis_Cuti', $request->jenis);
        }

        // Pencarian berdasarkan name, Waktu, status_cuti, Bagian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                ->orWhere('cuti.tanggal_Mulai', 'like', '%' . $search . '%')
                ->orWhere('cuti.tanggal_Selesai', 'like', '%' . $search . '%')
                ->orWhere('cuti.status_Cuti', 'like', '%' . $search . '%')
                ->orWhere('cuti.jenis_Cuti', 'like', '%' . $search . '%');
            });
        }

        // Pagination
        $cuti = $query->paginate(10);

        return view('page.priwayat-cuti-pribadi', [
            'cuti' => $cuti,
            'direktur' => $direktur,
            'search' => $request->search,
            'status' => $request->status,
            'jenis' => $request->jenis,
        ]);
    }
}
