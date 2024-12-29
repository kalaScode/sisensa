<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perusahaan')->insert([
            [
                'id_Perusahaan' => 1,
                'nama_Perusahaan' => 'PT Bersama Kreasi Teknik',
                'Longitude' => 106.83398747,
                'Latitude' => -6.21876501,
                'Alamat' => 'Garden Avenue Rasuna Lt. 2, Jalan Epicentrum Tengah No. 3 Jakarta',
                'no_Telp' => '0218355085',
                'minimal_Jamkerja' => 8,
                'jam_Masuk' => '09:00:00',
                'jam_Keluar' => '17:00:00',
                'Logo' => '',
                'created_At' => '2024-12-25 22:15:05',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Perusahaan' => 2,
                'nama_Perusahaan' => 'PT Stand Focus Technology',
                'Longitude' => 106.82486643,
                'Latitude' => -6.18591165,
                'Alamat' => 'Jl. H. Agus Salim No. 50, Kebon Sirih, Menteng Jakarta Pusat 10340',
                'no_Telp' => '02139830570',
                'minimal_Jamkerja' => 8,
                'jam_Masuk' => '10:00:00',
                'jam_Keluar' => '18:00:00',
                'Logo' => '',
                'created_At' => '2024-12-25 22:15:05',
                'created_By' => 1,
                'updated_At' => '2024-12-25 22:25:18',
                'updated_By' => null
            ],
            [
                'id_Perusahaan' => 3,
                'nama_Perusahaan' => 'PT Lima Bersaudara Logistik',
                'Longitude' => 106.83240804,
                'Latitude' => -6.20916401,
                'Alamat' => 'Puri Imperium, Jl. Kuningan Madya No.5, RT.6/RW.6, Menteng Atas, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12960',
                'no_Telp' => '0218850321',
                'minimal_Jamkerja' => 12,
                'jam_Masuk' => '07:00:00',
                'jam_Keluar' => '19:00:00',
                'Logo' => '',
                'created_At' => '2024-12-25 22:25:33',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Perusahaan' => 4,
                'nama_Perusahaan' => 'PT Toko Expert Global',
                'Longitude' => 106.82886448,
                'Latitude' => -6.25916394,
                'Alamat' => 'Capital Eight, Jalan Duren Tiga Selatan No. 8, Duren Tiga, Pancoran, Jakarta Selatan, 12760',
                'no_Telp' => '0213354768',
                'minimal_Jamkerja' => 7,
                'jam_Masuk' => '11:00:00',
                'jam_Keluar' => '18:00:00',
                'Logo' => '',
                'created_At' => '2024-12-25 22:25:33',
                'created_By' => 1,
                'updated_At' => '2024-12-25 22:28:50',
                'updated_By' => null
            ]
        ]);
    }
}
