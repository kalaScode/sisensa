<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [];
        for ($i = 1; $i <= 20; $i++) {
            $id_Perusahaan = rand(1, 4); // Assumes 4 perusahaan
            $id_Jabatan = $this->getDefaultJabatan($id_Perusahaan);

            $users[] = [
                'user_id' => $i, // Incremental ID
                'id_Perusahaan' => $id_Perusahaan,
                'id_Otoritas' => rand(1, 5), // Assumes 5 otoritas
                'id_Jabatan' => $id_Jabatan, // Default based on perusahaan
                'name' => 'User ' . $i,
                'no_Telp' => '081234567' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Alamat' => 'Alamat ke-' . $i,
                'status_Kerja' => rand(0, 1) ? 'Tetap' : 'Kontrak',
                'status_Akun' => rand(0, 1),
                'Avatar' => null, // Placeholder avatar
                'email' => 'user' . $i . '@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data ke tabel users
        DB::table('users')->insert($users);
    }

    private function getDefaultJabatan($id_Perusahaan)
    {
        // Logika default Jabatan berdasarkan id_Perusahaan
        $defaultMapping = [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
        ];

        // Pastikan nilai default ada di tabel jabatan
        $defaultJabatan = $defaultMapping[$id_Perusahaan] ?? 4;

        // Cek apakah id_Jabatan ada di database
        $exists = DB::table('jabatan')->where('id_Jabatan', $defaultJabatan)->exists();

        // Jika tidak ada, gunakan fallback atau null
        return $exists ? $defaultJabatan : null;
    }
}
