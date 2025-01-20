<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtorisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('otorisasi')->insert([
            [
                'id_Otoritas' => 1,
                'nama_Otoritas' => 'Master Admin',
                'Presensi' => 'Ya',
                'Cuti' => 'Ya',
                'daftar_Karyawan' => 'Ya',
                'edit_daftarKaryawan' => 'Ya',
                'persetujuan_Presensi' => 'Ya',
                'Persetujuan' => 'Ya',
                'persetujuan_Akun' => 'Ya',
                'riwayat_presensiPribadi' => 'Ya',
                'riwayat_presensiKaryawan' => 'Ya',
                'riwayat_cutiPribadi' => 'Ya',
                'riwayat_cutiKaryawan' => 'Ya',
                'buat_Pengumuman' => 'Ya',
                'created_At' => '2024-12-25 22:07:58',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Otoritas' => 2,
                'nama_Otoritas' => 'Admin',
                'Presensi' => 'Ya',
                'Cuti' => 'Ya',
                'daftar_Karyawan' => 'Ya',
                'edit_daftarKaryawan' => 'Ya',
                'persetujuan_Presensi' => 'Ya',
                'Persetujuan' => 'Ya',
                'persetujuan_Akun' => 'Ya',
                'riwayat_presensiPribadi' => 'Ya',
                'riwayat_presensiKaryawan' => 'Ya',
                'riwayat_cutiPribadi' => 'Ya',
                'riwayat_cutiKaryawan' => 'Ya',
                'buat_Pengumuman' => 'Ya',
                'created_At' => '2024-12-25 22:07:58',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Otoritas' => 3,
                'nama_Otoritas' => 'Direktur',
                'Presensi' => 'Ya',
                'Cuti' => 'Ya',
                'daftar_Karyawan' => 'Ya',
                'edit_daftarKaryawan' => 'Tidak',
                'persetujuan_Presensi' => 'Ya',
                'Persetujuan' => 'Ya',
                'persetujuan_Akun' => 'Tidak',
                'riwayat_presensiPribadi' => 'Ya',
                'riwayat_presensiKaryawan' => 'Ya',
                'riwayat_cutiPribadi' => 'Ya',
                'riwayat_cutiKaryawan' => 'Ya',
                'buat_Pengumuman' => 'Ya',
                'created_At' => '2024-12-25 22:08:46',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Otoritas' => 4,
                'nama_Otoritas' => 'HRD',
                'Presensi' => 'Ya',
                'Cuti' => 'Ya',
                'daftar_Karyawan' => 'Ya',
                'edit_daftarKaryawan' => 'Ya',
                'persetujuan_Presensi' => 'Tidak',
                'Persetujuan' => 'Tidak',
                'persetujuan_Akun' => 'Ya',
                'riwayat_presensiPribadi' => 'Ya',
                'riwayat_presensiKaryawan' => 'Ya',
                'riwayat_cutiPribadi' => 'Ya',
                'riwayat_cutiKaryawan' => 'Ya',
                'buat_Pengumuman' => 'Ya',
                'created_At' => '2024-12-25 22:09:28',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ],
            [
                'id_Otoritas' => 5,
                'nama_Otoritas' => 'Karyawan',
                'Presensi' => 'Ya',
                'Cuti' => 'Ya',
                'daftar_Karyawan' => 'Ya',
                'edit_daftarKaryawan' => 'Tidak',
                'persetujuan_Presensi' => 'Tidak',
                'Persetujuan' => 'Tidak',
                'persetujuan_Akun' => 'Tidak',
                'riwayat_presensiPribadi' => 'Ya',
                'riwayat_presensiKaryawan' => 'Tidak',
                'riwayat_cutiPribadi' => 'Ya',
                'riwayat_cutiKaryawan' => 'Tidak',
                'buat_Pengumuman' => 'Ya',
                'created_At' => '2024-12-25 22:10:17',
                'created_By' => 1,
                'updated_At' => null,
                'updated_By' => null
            ]
        ]);
    }
}
