<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoCuti extends Model
{
    use HasFactory;

    protected $table = 'saldo_cuti'; // Nama tabel
    protected $primaryKey = 'id_Saldocuti'; // Primary key

    protected $fillable = [
        'user_id',
        'saldo_Awal',
        'updated_By',
        'created_By'
    ];

    // Relasi ke user/karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
