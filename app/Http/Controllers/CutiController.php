<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaldoCuti;
use App\Models\Cuti;
use App\Models\User;
use App\Notifications\PengajuanCuti;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CutiController extends Controller
{
    public function index()
    {
        return view('page.pcuti');
    }

    public function getSaldoSisa()
    {
        $user = Auth::user();
        $saldoSisa = $user->saldo_cuti->saldo_Sisa ?? 0;

        return response()->json(['saldo_sisa' => $saldoSisa]);
    }


    public function ajukanCuti(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggalCuti' => 'required|string', // Pastikan format sesuai, misal "2025-01-15" atau "2025-01-15 to 2025-01-20"
            'jenis_Cuti' => 'required|string',
            'Keterangan' => 'nullable|string',
            'Attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240', // Max 10MB
        ]);

        // Pisahkan tanggal mulai dan selesai dari input date range
        if (strpos($validated['tanggalCuti'], ' to ') !== false) {
            [$tanggalMulai, $tanggalSelesai] = explode(' to ', $validated['tanggalCuti']);
        } else {
            // Jika hanya satu hari yang dipilih
            $tanggalMulai = $tanggalSelesai = $validated['tanggalCuti'];
        }

        // Simpan data cuti ke database
        try {
            $cuti = new Cuti();
            $cuti->user_id = Auth::user()->user_id;
            $cuti->tanggal_Mulai = $tanggalMulai;
            $cuti->tanggal_Selesai = $tanggalSelesai;
            $cuti->jenis_Cuti = $validated['jenis_Cuti'];
            $cuti->keterangan = $validated['Keterangan'];
            $cuti->created_By = Auth::id();
            $cuti->updated_By = Auth::id();
            $cuti->created_At = Carbon::now('GMT+7')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
            $cuti->updated_At = Carbon::now('GMT+7')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');

            // Upload file jika ada
            if ($request->hasFile('Attachment')) {
                $file = $request->file('Attachment');

                // Pastikan file valid dan aman
                if ($file->isValid()) {
                    // Generate unique file name to avoid conflicts
                    $fileName = uniqid('cuti_', true) . '.' . $file->getClientOriginalExtension();

                    // Store file securely in the public disk
                    $path = $file->storeAs('attachments', $fileName, 'public');
                    $cuti->attachment = $path;
                }
            }

            $cuti->save();

            // Kirim notifikasi ke HRD dalam perusahaan yang sama
            $sender = Auth::user();
            $direktur = User::where('id_Perusahaan', $sender->id_Perusahaan)
                ->where('id_Otoritas', 3) // Sesuaikan id_Otoritas dengan direktur
                ->first();

            if ($direktur) {
                // Mengirimkan notifikasi ke Direktur
                $direktur->notify(new PengajuanCuti($cuti, $sender));
            } else {
                // Jika direktur tidak ditemukan
                return redirect()->back()->with('error', 'Direktur tidak ditemukan.');
            }

            return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti berhasil dikirim.');
        } catch (\Exception $e) {
            // Menangani kesalahan dan memberikan respons yang lebih informatif
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengajukan cuti. Silakan coba lagi.');
        }
    }
}
