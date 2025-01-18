<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Perusahaan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua perusahaan
        $perusahaans = Perusahaan::all();

        // Tambahkan jabatan default "NONE - [Nama Perusahaan]" untuk setiap perusahaan
        foreach ($perusahaans as $perusahaan) {
            DB::table('jabatan')->insertOrIgnore([
                'id_Perusahaan' => $perusahaan->id_Perusahaan,
                'nama_Jabatan' => "NONE - {$perusahaan->nama_Perusahaan}",
                'created_At' => now('GMT+7')->setTimezone('Asia/Jakarta'),
                'created_By' => 1,
            ]);
        }

        // Daftar jabatan tambahan
        $jabatanTambahan = [
            ['id_Perusahaan' => 1, 'nama_Jabatan' => 'Master Administrator'],
            ['id_Perusahaan' => 1, 'nama_Jabatan' => 'Administrator Berkreasi', 'created_At' => '2024-12-25 22:11:18'],
            ['id_Perusahaan' => 2, 'nama_Jabatan' => 'Administrator SFT'],
            ['id_Perusahaan' => 3, 'nama_Jabatan' => 'Administrator Limbers'],
            ['id_Perusahaan' => 4, 'nama_Jabatan' => 'Administrator Toko Expert'],
            ['id_Perusahaan' => 1, 'nama_Jabatan' => 'Direktur Berkreasi', 'created_At' => '2024-12-25 22:11:18'],
            ['id_Perusahaan' => 2, 'nama_Jabatan' => 'Direktur SFT', 'created_At' => '2024-12-25 22:11:18'],
            ['id_Perusahaan' => 3, 'nama_Jabatan' => 'Direktur Limbers', 'created_At' => '2024-12-25 22:11:18'],
            ['id_Perusahaan' => 4, 'nama_Jabatan' => 'Direktur Toko Expert', 'created_At' => '2024-12-25 22:11:18'],
            ['id_Perusahaan' => 1, 'nama_Jabatan' => 'HRD Berkreasi', 'created_At' => '2024-12-25 22:12:03'],
            ['id_Perusahaan' => 2, 'nama_Jabatan' => 'HRD SFT', 'created_At' => '2024-12-25 22:12:03'],
            ['id_Perusahaan' => 3, 'nama_Jabatan' => 'HRD Limbers', 'created_At' => '2024-12-25 22:12:03'],
            ['id_Perusahaan' => 4, 'nama_Jabatan' => 'HRD Toko Expert', 'created_At' => '2024-12-25 22:12:03'],
            ['id_Perusahaan' => 1, 'nama_Jabatan' => 'Software Developer', 'created_At' => '2024-12-25 22:12:03'],
            ['id_Perusahaan' => 1, 'nama_Jabatan' => 'Quality Assurance', 'created_At' => '2024-12-25 22:12:03'],
            ['id_Perusahaan' => 1, 'nama_Jabatan' => 'IT Consultant', 'created_At' => '2024-12-25 22:12:53'],
            ['id_Perusahaan' => 2, 'nama_Jabatan' => 'Senior Developer', 'created_At' => '2024-12-25 22:14:03'],
            ['id_Perusahaan' => 2, 'nama_Jabatan' => 'Junior Developer', 'created_At' => '2024-12-25 22:13:46'],
            ['id_Perusahaan' => 2, 'nama_Jabatan' => 'Fullstack Developer', 'created_At' => '2024-12-25 22:13:46'],
            ['id_Perusahaan' => 3, 'nama_Jabatan' => 'Logistic Staff', 'created_At' => '2024-12-25 22:13:46'],
            ['id_Perusahaan' => 3, 'nama_Jabatan' => 'Development Staff', 'created_At' => '2024-12-25 22:13:46'],
            ['id_Perusahaan' => 3, 'nama_Jabatan' => 'Driver', 'created_At' => '2024-12-25 22:13:46'],
            ['id_Perusahaan' => 4, 'nama_Jabatan' => 'Staff Toko', 'created_At' => '2024-12-25 22:13:46'],
        ];

        // Insert semua jabatan tambahan tanpa id_Jabatan untuk mencegah duplikasi
        foreach ($jabatanTambahan as &$jabatan) {
            $jabatan['created_At'] = $jabatan['created_At'] ?? now('GMT+7')->setTimezone('Asia/Jakarta');
            $jabatan['created_By'] = 1;
        }

        DB::table('jabatan')->insertOrIgnore($jabatanTambahan);
    }
}