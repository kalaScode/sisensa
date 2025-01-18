<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'user_id' => 1,
                'id_Perusahaan' => 1,
                'id_Otoritas' => 1,
                'id_Jabatan' => 5,
                'name' => 'Master Administrator',
                'no_Telp' => '0812345678',
                'Alamat' => 'Puri Imperium',
                'status_Kerja' => 'Tetap',
                'status_Akun' => 1,
                'Avatar' => null,
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('samakreasigroup123'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'id_Perusahaan' => 1,
                'id_Otoritas' => 2,
                'id_Jabatan' => 6,
                'name' => 'Admin 1',
                'no_Telp' => '082134556788',
                'Alamat' => 'Puri Imperium',
                'status_Kerja' => 'Tetap',
                'status_Akun' => 1,
                'Avatar' => null,
                'email' => 'admin.berkreasi@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('berkreasi123'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'id_Perusahaan' => 1,
                'id_Otoritas' => 3,
                'id_Jabatan' => 10,
                'name' => 'Direktur A',
                'no_Telp' => '081290040388',
                'Alamat' => 'Bekasi Barat',
                'status_Kerja' => 'Tetap',
                'status_Akun' => 1,
                'Avatar' => null,
                'email' => 'direktur.testing@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('direkturtest123'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'id_Perusahaan' => 1,
                'id_Otoritas' => 4,
                'id_Jabatan' => 14,
                'name' => 'HRD A',
                'no_Telp' => '081315426745',
                'Alamat' => 'Jakarta Timur',
                'status_Kerja' => 'Tetap',
                'status_Akun' => 1,
                'Avatar' => null,
                'email' => 'hrd.testing@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('hrdtest123'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'id_Perusahaan' => 1,
                'id_Otoritas' => 5,
                'id_Jabatan' => 18,
                'name' => 'Karyawan A',
                'no_Telp' => '087834568764',
                'Alamat' => 'Jakarta Timur',
                'status_Kerja' => 'Tetap',
                'status_Akun' => 1,
                'Avatar' => null,
                'email' => 'karyawan.testing@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('karyawantest123'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'id_Perusahaan' => 1,
                'id_Otoritas' => 5,
                'id_Jabatan' => 18,
                'name' => 'Wahyu Satrio Widodo',
                'no_Telp' => '087834568764',
                'Alamat' => 'Jakarta Timur',
                'status_Kerja' => 'Tetap',
                'status_Akun' => 1,
                'Avatar' => null,
                'email' => 'wahyusw813@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('wahyusw813'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'id_Perusahaan' => 1,
                'id_Otoritas' => 5,
                'id_Jabatan' => 19,
                'name' => 'Wafi Aulia Tsabitah',
                'no_Telp' => '082199864587',
                'Alamat' => 'Bengkulu',
                'status_Kerja' => 'Tetap',
                'status_Akun' => 1,
                'Avatar' => null,
                'email' => 'wafiaulia@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('waficantik00'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'id_Perusahaan' => 1,
                'id_Otoritas' => 5,
                'id_Jabatan' => 22,
                'name' => 'Amanda Amelia Salsabila Sinaga',
                'no_Telp' => '0821921567299',
                'Alamat' => 'Bekasi Timur',
                'status_Kerja' => 'Kontrak',
                'status_Akun' => 0,
                'Avatar' => null,
                'email' => 'amandasinaga@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('manda123'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'id_Perusahaan' => 2,
                'id_Otoritas' => 2,
                'id_Jabatan' => 7,
                'name' => 'Admin 2',
                'no_Telp' => '081344568213',
                'Alamat' => 'Puri Imperium',
                'status_Kerja' => 'Tetap',
                'status_Akun' => 1,
                'Avatar' => null,
                'email' => 'admin.sft@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('ptsft123'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'id_Perusahaan' => 2,
                'id_Otoritas' => 3,
                'id_Jabatan' => 11,
                'name' => 'Teguh Raharjo',
                'no_Telp' => '081312211043',
                'Alamat' => 'Cipinang',
                'status_Kerja' => 'Tetap',
                'status_Akun' => 1,
                'Avatar' => null,
                'email' => 'teguhraharjo@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('teguh123'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 11,
                'id_Perusahaan' => 2,
                'id_Otoritas' => 4,
                'id_Jabatan' => 15,
                'name' => 'Adam Nurzaman',
                'no_Telp' => '085271002223',
                'Alamat' => 'Bogor',
                'status_Kerja' => 'Tetap',
                'status_Akun' => 1,
                'Avatar' => null,
                'email' => 'adamnurzaman@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('adamnurzaman123'),
                'updated_By' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data ke tabel users
        DB::table('users')->insert($users);
    }

    #Alternatif Seeder otomatis
    /* public function run(){
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
    }*/

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
