<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otoritas extends Model
{
    protected $table = 'otorisasi';

    protected $primaryKey = 'id_Otoritas'; // Primary key dari tabel

    public $timestamps = false; // Karena Anda menggunakan kolom custom untuk timestamps

    protected $fillable = [
        'nama_Otoritas',
        'Presensi',
        'Cuti',
        'daftar_Karyawan',
        'edit_daftarKaryawan',
        'Persetujuan',
        'persetujuan_Akun',
        'riwayat_presensiPribadi',
        'riwayat_presensiKaryawan',
        'riwayat_cutiPribadi',
        'riwayat_cutiKaryawan',
        'buat_Pengumuman',
        'created_At',
        'created_By',
        'updated_At',
        'updated_By',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
