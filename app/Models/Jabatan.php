<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $guarded = [];

    protected $primaryKey ='id_Jabatan';

    protected $fillable = [
        'id_Perusahaan',
        'nama_Jabatan',
        'created_At',
        'created_By',
        'updated_At',
        'updated_By',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_Perusahaan', 'id');
    }
}
