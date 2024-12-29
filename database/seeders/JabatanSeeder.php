<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatan')->insert([
            [
                'id_Jabatan' => 1,
                'id_Perusahaan' => 1,
                'nama_Jabatan' => 'none',
                'created_At' => now(),
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 2,
                'id_Perusahaan' => 2,
                'nama_Jabatan' => 'none',
                'created_At' => now(),
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 3,
                'id_Perusahaan' => 3,
                'nama_Jabatan' => 'none',
                'created_At' => now(),
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 4,
                'id_Perusahaan' => 4,
                'nama_Jabatan' => 'none',
                'created_At' => now(),
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 5,
                'id_Perusahaan' => 1,
                'nama_Jabatan' => 'Master Administrator',
                'created_At' => now(),
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 6,
                'id_Perusahaan' => 1,
                'nama_Jabatan' => 'Administrator Berkreasi',
                'created_At' => '2024-12-25 22:11:18',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 7,
                'id_Perusahaan' => 2,
                'nama_Jabatan' => 'Administrator SFT',
                'created_At' => now(),
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 8,
                'id_Perusahaan' => 3,
                'nama_Jabatan' => 'Administrator Limbers',
                'created_At' => now(),
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 9,
                'id_Perusahaan' => 4,
                'nama_Jabatan' => 'Administrator Toko Expert',
                'created_At' => now(),
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 10,
                'id_Perusahaan' => 1,
                'nama_Jabatan' => 'Direktur Berkreasi',
                'created_At' => '2024-12-25 22:11:18',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 11,
                'id_Perusahaan' => 2,
                'nama_Jabatan' => 'Direktur SFT',
                'created_At' => '2024-12-25 22:11:18',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 12,
                'id_Perusahaan' => 3,
                'nama_Jabatan' => 'Direktur Limbers',
                'created_At' => '2024-12-25 22:11:18',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 13,
                'id_Perusahaan' => 4,
                'nama_Jabatan' => 'Direktur Toko Expert',
                'created_At' => '2024-12-25 22:11:18',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 14,
                'id_Perusahaan' => 1,
                'nama_Jabatan' => 'HRD Berkreasi',
                'created_At' => '2024-12-25 22:12:03',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 15,
                'id_Perusahaan' => 2,
                'nama_Jabatan' => 'HRD SFT',
                'created_At' => '2024-12-25 22:12:03',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 16,
                'id_Perusahaan' => 3,
                'nama_Jabatan' => 'HRD Limbers',
                'created_At' => '2024-12-25 22:12:03',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 17,
                'id_Perusahaan' => 4,
                'nama_Jabatan' => 'HRD Toko Expert',
                'created_At' => '2024-12-25 22:12:03',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 18,
                'id_Perusahaan' => 1,
                'nama_Jabatan' => 'Software Developer',
                'created_At' => '2024-12-25 22:12:03',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 19,
                'id_Perusahaan' => 1,
                'nama_Jabatan' => 'Quality Assurance',
                'created_At' => '2024-12-25 22:12:03',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 20,
                'id_Perusahaan' => 1,
                'nama_Jabatan' => 'IT Consultant',
                'created_At' => '2024-12-25 22:12:53',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 21,
                'id_Perusahaan' => 2,
                'nama_Jabatan' => 'Senior Developer',
                'created_At' => '2024-12-25 22:14:03',
                'created_By' => 1,
                'updated_At' => '2024-12-25 22:14:26',
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 22,
                'id_Perusahaan' => 2,
                'nama_Jabatan' => 'Junior Developer',
                'created_At' => '2024-12-25 22:13:46',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 23,
                'id_Perusahaan' => 2,
                'nama_Jabatan' => 'Fullstack Developer',
                'created_At' => '2024-12-25 22:13:46',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 24,
                'id_Perusahaan' => 3,
                'nama_Jabatan' => 'Logistic Staff',
                'created_At' => '2024-12-25 22:13:46',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 25,
                'id_Perusahaan' => 3,
                'nama_Jabatan' => 'Development Staff',
                'created_At' => '2024-12-25 22:13:46',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 26,
                'id_Perusahaan' => 3,
                'nama_Jabatan' => 'Driver',
                'created_At' => '2024-12-25 22:13:46',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 27,
                'id_Perusahaan' => 4,
                'nama_Jabatan' => 'Staff Toko',
                'created_At' => '2024-12-25 22:13:46',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ]
        ]);
    }
}
