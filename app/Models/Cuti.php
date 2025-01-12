<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';

    protected $primaryKey = 'id_Cuti';

    protected $fillable = [
        'user_id',
        'jenis_Cuti',
        'tanggal_Mulai',
        'tanggal_Selesai',
        'Keterangan',
        'Attachment',
        'status_Cuti',
        'Feedback',
        'created_By',
        'updated_By',
    ];
    // Kolom yang akan otomatis dikonversi ke Carbon
    protected $dates = ['tanggal_Mulai', 'tanggal_Selesai', 'tanggal_pengajuan'];

    // Alternatif jika hanya ingin casting sebagai datetime
    protected $casts = [
        'tanggal_Mulai' => 'datetime',
        'tanggal_Selesai' => 'datetime',
        'tanggal_pengajuan' => 'datetime',
    ];
    /**
     * Defining the relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'user_id', 'user_id');
    }

    // Relasi dengan tabel saldo_cuti
    public function saldoCuti()
    {
        return $this->belongsTo(SaldoCuti::class);
    }

    public function updateSaldoTerpakai()
    {
        // Menghitung jumlah hari berdasarkan tanggal mulai dan selesai
        $jumlah_hari = $this->tanggal_Mulai->diffInDays($this->tanggal_Selesai) + 1; // +1 untuk mencakup tanggal mulai

        // Update saldo_terpakai di tabel saldo_cuti
        $this->saldoCuti->updateSaldoTerpakai($jumlah_hari);
    }
}
