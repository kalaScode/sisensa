<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaldoCuti extends Model
{
    protected $table = 'saldo_cuti';

    // Kolom yang boleh diisi (fillable)
    protected $fillable = [
        'user_id',  // Relasi dengan tabel user
        'saldo_Sisa',  // Saldo cuti yang tersisa
    ];

    // Mendefinisikan relasi dengan model User
    public function user()
    {
        // SaldoCuti belongsTo User, berarti setiap saldo cuti berhubungan dengan satu user
        return $this->belongsTo(User::class, 'user_id');
    }
}
