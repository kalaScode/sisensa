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
                'nama_Jabatan' => 'Administrator',
                'created_At' => '2024-12-25 22:11:18',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 2,
                'nama_Jabatan' => 'Direktur',
                'created_At' => '2024-12-25 22:11:18',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 3,
                'nama_Jabatan' => 'HRD',
                'created_At' => '2024-12-25 22:12:03',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 4,
                'nama_Jabatan' => 'Software Developer',
                'created_At' => '2024-12-25 22:12:03',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 5,
                'nama_Jabatan' => 'Quality Assurance',
                'created_At' => '2024-12-25 22:12:03',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 6,
                'nama_Jabatan' => 'IT Consultant',
                'created_At' => '2024-12-25 22:12:53',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 7,
                'nama_Jabatan' => 'Senior Developer',
                'created_At' => '2024-12-25 22:14:03',
                'created_By' => 1,
                'updated_At' => '2024-12-25 22:14:26',
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 8,
                'nama_Jabatan' => 'Junior Developer',
                'created_At' => '2024-12-25 22:13:46',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Jabatan' => 9,
                'nama_Jabatan' => 'none',
                'created_At' => now(),
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ]
        ]);
    }
}
