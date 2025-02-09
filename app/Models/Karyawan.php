<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Karyawan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'no_Telp',
        'Alamat',
        'status_Kerja',
        'id_Perusahaan',
        'id_Jabatan',
        'status_Akun',
        'saldo_Awal',
        'Avatar',
        'updated_by'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_Perusahaan', 'id_Perusahaan');
    }

    public function jabatan()
    {
        return $this->hasOne(Jabatan::class, 'id_Jabatan', 'id_Jabatan');
    }

    public function Otorisasi()
    {
        return $this->belongsTo(Otoritas::class, 'id_Otoritas', 'id_Otoritas');
    }

    public function saldo_cuti()
    {
        return $this->hasOne(SaldoCuti::class, 'user_id', 'user_id');
    }

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
