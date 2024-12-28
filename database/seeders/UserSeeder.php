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
            $users[] = [
                'user_id' => $i, // Incremental ID
                'id_Perusahaan' => rand(1, 4), // Assumes 5 perusahaan
                'id_Otoritas' => rand(1, 4), // Assumes 3 otoritas
                'id_Jabatan' => rand(1, 8), // Assumes 4 jabatan
                'name' => 'User ' . $i,
                'no_Telp' => '081234567' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Alamat' => 'Alamat ke-' . $i,
                'status_Kerja' => rand(0, 1) ? 'Tetap' : 'Kontrak',
                'status_Akun' => rand(0, 1),
                'Avatar' => 'avatar' . $i . '.png', // Placeholder avatar
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
}
