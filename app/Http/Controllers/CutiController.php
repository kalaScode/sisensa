<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaldoCuti;

class CutiController extends Controller
{
    public function updateCuti(Request $request, $user_id)
    {
        // Validasi input untuk saldo cuti
        $validated = $request->validate([
            'saldo_Awal' => 'nullable|integer|min:0', // Validasi saldo awal
            'saldo_Terpakai' => 'nullable|integer|min:0', // Validasi saldo terpakai
        ]);

        // Cari saldo cuti berdasarkan user_id dan tahun
        $saldoCuti = SaldoCuti::where('user_id', $user_id)
            ->where('Tahun', now()->year)
            ->first();

        // Jika saldo cuti tidak ditemukan, buat entri baru
        if (!$saldoCuti) {
            $saldoCuti = SaldoCuti::create([
                'user_id' => $user_id,
                'saldo_Awal' => 12,  // Default saldo awal 12
                'saldo_Terpakai' => 0,  // Default saldo terpakai 0
                'Tahun' => now()->year,
            ]);
        }

        // Update saldo_Awal dan saldo_Terpakai jika ada input dari user
        if ($request->filled('saldo_Awal')) {
            $saldoCuti->saldo_Awal = $request->saldo_Awal;
        }

        if ($request->filled('saldo_Terpakai')) {
            $saldoCuti->saldo_Terpakai = $request->saldo_Terpakai;
        }

        // Hitung saldo_Sisa
        $saldoCuti->saldo_Sisa = $saldoCuti->saldo_Awal - $saldoCuti->saldo_Terpakai;

        // Simpan perubahan
        $saldoCuti->save();

        // Kembalikan ke halaman cuti dengan pesan sukses
        return redirect()->route('cuti')->with('success', 'Saldo cuti berhasil diperbarui.');
    }
}
