<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaldoCuti;
use App\Models\Cuti;
use App\Notifications\NotifikasiPersetujuanCuti;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class PersetujuanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', ''); // Ambil nilai pencarian, default kosong
        $status = $request->input('status', '');

        // Ambil ID perusahaan dari user yang sedang login
        $idPerusahaan = Auth::user()->id_Perusahaan;

        // Query data cuti berdasarkan filter, pencarian, dan id_perusahaan
        $cuti = Cuti::query()
            ->whereHas('user', function ($query) use ($idPerusahaan) {
                $query->where('id_perusahaan', $idPerusahaan);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status_Cuti', $status);
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10);

        // Kirim data ke view
        return view('page.ppersetujuan', compact('cuti', 'search', 'status'));
    }



    //Persetjuan Cuti(Untuk halaman Persetujuan dapat menyeseuaikan controllernya dengan inii)
    public function terimaCuti($id)
    {
        // Cari pengajuan cuti berdasarkan ID
        $cuti = Cuti::findOrFail($id);

        if ($cuti->status_Cuti === 'Menunggu') {
            // Hitung durasi cuti
            $durasi = $cuti->tanggal_Mulai->diffInDays($cuti->tanggal_Selesai) + 1;

            // Cari saldo cuti user
            $saldoCuti = SaldoCuti::where('user_id', $cuti->user_id)->first();

            if ($saldoCuti) {
                // Periksa apakah saldo mencukupi
                if ($saldoCuti->saldo_Sisa < $durasi) {
                    return redirect()->route('persetujuan-cuti.index')->with('error', 'Saldo cuti karyawan tidak mencukupi.');
                }

                // Ubah status cuti menjadi 'Disetujui'
                $cuti->status_Cuti = 'Disetujui';
                $cuti->updated_By = Auth::id();
                $cuti->updated_At = Carbon::now('GMT+7')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                $cuti->save();

                // Update saldo cuti user
                $saldoCuti->saldo_Terpakai += $durasi;
                $saldoCuti->saldo_Sisa -= $durasi; // Kurangi saldo sisa
                $saldoCuti->save();

                // Kirim notifikasi
                $sender = Auth::user();
                $cuti->user->notify(new NotifikasiPersetujuanCuti($cuti, $sender));

                return redirect()->route('persetujuan-cuti.index')->with('success', 'Cuti berhasil disetujui.');
            }

            return redirect()->route('persetujuan-cuti.index')->with('error', 'Saldo cuti karyawan tidak ditemukan.');
        }

        return redirect()->route('persetujuan-cuti.index')->with('error', 'Cuti sudah diproses sebelumnya.');
    }


    public function tolakCuti(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);
        if (!$cuti) {
            return redirect()->route('persetujuan-cuti.index')->with('error', 'Pengajuan cuti tidak ditemukan.');
        }
        $cuti->updated_By = Auth::id();
        $cuti->updated_At = Carbon::now('GMT+7')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
        $cuti->update([
            'status_Cuti' => 'Ditolak',
            'Feedback' => $request->input('Feedback')
        ]);

        // Kirim notifikasi
        $sender = Auth::user();
        $cuti->user->notify(new NotifikasiPersetujuanCuti($cuti, $sender));

        return redirect()->back()->with('success', 'Cuti ditolak dengan feedback.');
    }

    public function indexPresensi(Request $request)
    {
        $search = $request->input('search', ''); // Ambil nilai pencarian, default kosong
        $status = $request->input('status', '');

        // Ambil ID perusahaan dari user yang sedang login
        $idPerusahaan = Auth::user()->id_Perusahaan;

        // Query data cuti berdasarkan filter, pencarian, dan id_perusahaan
        $cuti = Cuti::query()
            ->whereHas('user', function ($query) use ($idPerusahaan) {
                $query->where('id_perusahaan', $idPerusahaan);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status_Cuti', $status);
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10);

        // Kirim data ke view
        return view('page.ppersetujuan-presensi', compact('cuti', 'search', 'status'));
    }
}
