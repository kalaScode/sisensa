<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Karyawan;

class SaldoCuti extends Model
{
    use HasFactory;

    protected $table = 'saldo_cuti';

    protected $primaryKey = 'id_Saldocuti';

    protected $fillable = [
        'user_id',
        'Tahun',
        'saldo_Awal',
        'saldo_Terpakai',
        'saldo_Sisa',
        'created_by',
        'updated_by'
    ];

    /**
     * Defining the relationship with User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'user_id', 'user_id');
    }

    public function updateSaldoTerpakai($jumlah_hari)
    {
        // Tambahkan jumlah hari ke saldo_terpakai
        $this->saldo_Terpakai += $jumlah_hari;
        $this->save();
    }
}
