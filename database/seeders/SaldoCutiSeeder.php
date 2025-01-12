<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaldoCutiSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua user_id dari tabel users
        $users = DB::table('users')->select('user_id')->get();

        // Siapkan data saldo cuti untuk setiap user
        $saldoCutiData = [];
        foreach ($users as $user) {
            $saldoCutiData[] = [
                'user_id' => $user->user_id,
                'Tahun' => now()->year,
                'saldo_Awal' => 12, // Default saldo awal
                'saldo_Terpakai' => 0, // Default saldo terpakai
                'created_At' => now(),
                'created_By' => null,
                'updated_At' => now(),
                'updated_By' => null,
            ];
        }

        // Masukkan data ke tabel saldo_cuti
        DB::table('saldo_cuti')->insert($saldoCutiData);
    }
}