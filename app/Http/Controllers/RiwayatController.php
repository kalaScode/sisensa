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

        // Filter berdasarkan tahun
        $range = $request->input('year', 'Tahunan');
        if ($range != 'Tahunan') {
            $query->whereYear('presensi.Tanggal', $range);
        }

        // Pencarian berdasarkan name, Waktu
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                ->orWhere('presensi.Waktu', 'like', '%' . $search . '%');
            });
        }

        // Pagination
        $presensi = $query->orderBy('presensi.created_At', 'desc')->paginate(10);

        // Range untuk chart
        $presensiData = [];

        if ($range == 'Tahunan') {
            // Filter dan Group by Tahun
            $presensiData = Presensi::select(DB::raw("COUNT(*) as count"), DB::raw("YEAR(presensi.Tanggal) as year"))
                ->join('users', 'presensi.user_id', '=', 'users.user_id')
                ->where('users.id_Perusahaan', $id_Perusahaan)
                ->where('presensi.Bagian', 'Masuk')
                ->where('presensi.status_Presensi', 'Disetujui')
                ->where('presensi.user_id', '!=', Auth::user()->user_id)
                ->groupBy(DB::raw("YEAR(presensi.Tanggal)"))
                ->orderBy(DB::raw("YEAR(presensi.Tanggal)"), 'asc')
                ->get();
            // Untuk yearly, ambil tahun dan jumlah presensi
            $labels = $presensiData->pluck('year');
            $data = $presensiData->pluck('count');
        } else {
            // Daftar semua nama bulan
            $allMonths = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            // Filter dan Group by Bulan
            $presensiData = Presensi::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(presensi.Tanggal) as month_number"))
                ->join('users', 'presensi.user_id', '=', 'users.user_id')
                ->where('users.id_Perusahaan', $id_Perusahaan)
                ->where('presensi.Bagian', 'Masuk')
                ->where('presensi.status_Presensi', 'Disetujui')
                ->whereYear('presensi.Tanggal', $range)
                ->where('presensi.user_id', '!=', Auth::user()->user_id)
                ->groupBy(DB::raw("MONTH(presensi.Tanggal)"))
                ->orderBy(DB::raw("MONTH(presensi.Tanggal)"), 'asc')
                ->get();
            
            // Buat array bulan dan data dengan nilai default 0
            $monthlyData = collect($allMonths)->map(function ($month, $index) use ($presensiData) {
                $monthNumber = $index + 1; // Index dimulai dari 0, sehingga perlu +1 untuk bulan
                $dataForMonth = $presensiData->firstWhere('month_number', $monthNumber);
                return [
                    'month_name' => $month,
                    'count' => $dataForMonth ? $dataForMonth->count : 0
                ];
            });

            $labels = $monthlyData->pluck('month_name');
            $data = $monthlyData->pluck('count');
        }

        return view('page.priwayat-presensi-karyawan', [
            'presensi' => $presensi,
            'direktur' => $direktur,
            'search' => $request->search,
            'status' => $request->status,
            'jenis' => $request->jenis,
            'range' => $range,
            'presensiData' => $presensiData,
            'labels' => $labels,
            'data' => $data,
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

        // Filter berdasarkan tahun
        $year = $request->input('year', now('GMT+7')->setTimezone('Asia/Jakarta')->year);
        $query->whereYear('cuti.tanggal_Mulai', $year);

        // Pencarian berdasarkan name, Waktu
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                ->orWhere('cuti.tanggal_Mulai', 'like', '%' . $search . '%')
                ->orWhere('cuti.tanggal_Selesai', 'like', '%' . $search . '%');
            });
        }

        // Pagination
        $cuti = $query->orderBy('cuti.created_At', 'desc')->paginate(10);
                
        // Menghitung jumlah cuti dan sakit di tiap bulan
        $cutiData = Cuti::select(
                DB::raw('MONTH(tanggal_Mulai) as bulan'),
                DB::raw('SUM(CASE WHEN jenis_Cuti = "Cuti" THEN DATEDIFF(tanggal_Selesai, tanggal_Mulai) + 1 ELSE 0 END) as total_cuti'),
                DB::raw('SUM(CASE WHEN jenis_Cuti = "Sakit" THEN DATEDIFF(tanggal_Selesai, tanggal_Mulai) + 1 ELSE 0 END) as total_sakit')
            )
            ->join('users', 'cuti.user_id', '=', 'users.user_id')
            ->whereYear('tanggal_Mulai', $year)
            ->where('status_Cuti', 'Disetujui')
            ->where('cuti.user_id', '!=', Auth::user()->user_id)
            ->where('id_Perusahaan', $id_Perusahaan);

        // Filter data berdasarkan nama jika $search diisi
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $cutiData->where('users.name', 'like', '%' . $search . '%');
        }

        // Grouping data berdasarkan bulan
        $cutiData = $cutiData->groupBy(DB::raw('MONTH(tanggal_Mulai)'))->get();
        
        // Inisialisasi array untuk data bulan Januari - Desember
        $months = collect(range(1, 12))->mapWithKeys(function ($month) {
            return [$month => ['total_cuti' => 0, 'total_sakit' => 0]];
        });

        // Menyusun data berdasarkan bulan
        $cutiData->each(function ($data) use ($months) {
            $months[$data->bulan] = [
                'total_cuti' => $data->total_cuti,
                'total_sakit' => $data->total_sakit
            ];
        });

        return view('page.priwayat-cuti-karyawan', [
            'cuti' => $cuti,
            'direktur' => $direktur,
            'search' => $request->search,
            'status' => $request->status,
            'jenis' => $request->jenis,
            'cutiData' => $months,
            'year' => $year,
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

        // Filter berdasarkan tahun
        $range = $request->input('year', 'Tahunan');
        if ($range != 'Tahunan') {
            $query->whereYear('presensi.Tanggal', $range);
        }

        // Pencarian berdasarkan Waktu
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('presensi.Waktu', 'like', '%' . $search . '%');
            });
        }

        // Pagination
        $presensi = $query->orderBy('presensi.created_At', 'desc')->paginate(10);
        
        // Range untuk chart
        $presensiData = [];

        if ($range == 'Tahunan') {
            // Filter dan Group by Tahun
            $presensiData = Presensi::select(DB::raw("COUNT(*) as count"), DB::raw("YEAR(presensi.Tanggal) as year"))
                ->join('users', 'presensi.user_id', '=', 'users.user_id')
                ->where('users.id_Perusahaan', $id_Perusahaan)
                ->where('presensi.Bagian', 'Masuk')
                ->where('presensi.status_Presensi', 'Disetujui')
                ->where('presensi.user_id', '=', Auth::user()->user_id)
                ->groupBy(DB::raw("YEAR(presensi.Tanggal)"))
                ->orderBy(DB::raw("YEAR(presensi.Tanggal)"), 'asc')
                ->get();
            // Untuk yearly, ambil tahun dan jumlah presensi
            $labels = $presensiData->pluck('year');
            $data = $presensiData->pluck('count');
        } else {
            // Daftar semua nama bulan
            $allMonths = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            // Filter dan Group by Bulan
            $presensiData = Presensi::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(presensi.Tanggal) as month_number"))
                ->join('users', 'presensi.user_id', '=', 'users.user_id')
                ->where('users.id_Perusahaan', $id_Perusahaan)
                ->where('presensi.Bagian', 'Masuk')
                ->where('presensi.status_Presensi', 'Disetujui')
                ->whereYear('presensi.Tanggal', $range)
                ->where('presensi.user_id', '=', Auth::user()->user_id)
                ->groupBy(DB::raw("MONTH(presensi.Tanggal)"))
                ->orderBy(DB::raw("MONTH(presensi.Tanggal)"), 'asc')
                ->get();
            
            // Buat array bulan dan data dengan nilai default 0
            $monthlyData = collect($allMonths)->map(function ($month, $index) use ($presensiData) {
                $monthNumber = $index + 1; // Index dimulai dari 0, sehingga perlu +1 untuk bulan
                $dataForMonth = $presensiData->firstWhere('month_number', $monthNumber);
                return [
                    'month_name' => $month,
                    'count' => $dataForMonth ? $dataForMonth->count : 0
                ];
            });

            $labels = $monthlyData->pluck('month_name');
            $data = $monthlyData->pluck('count');
        }

        return view('page.priwayat-presensi-pribadi', [
            'presensi' => $presensi,
            'direktur' => $direktur,
            'search' => $request->search,
            'status' => $request->status,
            'jenis' => $request->jenis,
            'range' => $range,
            'presensiData' => $presensiData,
            'labels' => $labels,
            'data' => $data,
        ]);
    }


    public function getCutiPribadi(Request $request)
    {
        $query = Cuti::query();
        $id_Perusahaan = Auth::user()->id_Perusahaan;
        $direktur = User::where('id_Perusahaan', $id_Perusahaan)
                        ->where('id_Otoritas', 3)
                        ->pluck('name')
                        ->first();

        $query->where('cuti.user_id', Auth::User()->user_id);

        $query->join('users', 'cuti.user_id', '=', 'users.user_id')
            ->where('users.id_Perusahaan', $id_Perusahaan);

        if ($request->has('status') && $request->status != '') {
            $query->where('cuti.status_Cuti', $request->status);
        }

        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('cuti.jenis_Cuti', $request->jenis);
        }

        $year = $request->input('year', now('GMT+7')->setTimezone('Asia/Jakarta')->year);
        $query->whereYear('cuti.tanggal_Mulai', $year);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->Where('cuti.tanggal_Mulai', 'like', '%' . $search . '%')
                ->orWhere('cuti.tanggal_Selesai', 'like', '%' . $search . '%');
            });
        }

        $cuti = $query->orderBy('cuti.created_At', 'desc')->paginate(10);

        // Mendapatkan data untuk pie chart berdasarkan tahun yang dipilih
        $cutiData = Cuti::select(
            DB::raw('SUM(CASE WHEN jenis_Cuti = "Cuti" THEN DATEDIFF(tanggal_Selesai, tanggal_Mulai) + 1 ELSE 0 END) as total_cuti'),
            DB::raw('SUM(CASE WHEN jenis_Cuti = "Sakit" THEN DATEDIFF(tanggal_Selesai, tanggal_Mulai) + 1 ELSE 0 END) as total_sakit')
        )
        ->join('users', 'cuti.user_id', '=', 'users.user_id')
        ->whereYear('tanggal_Mulai', $year)
        ->where('status_Cuti', 'Disetujui')
        ->where('cuti.user_id', '=', Auth::user()->user_id)
        ->where('id_Perusahaan', $id_Perusahaan)
        ->first();  // Use first() to get the single result
        
        // Pass the data to the view
        return view('page.priwayat-cuti-pribadi', [
            'cuti' => $cuti,
            'direktur' => $direktur,
            'search' => $request->search,
            'status' => $request->status,
            'jenis' => $request->jenis,
            'cutiData' => $cutiData,
            'year' => $year
        ]);
    }
}