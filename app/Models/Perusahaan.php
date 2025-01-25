<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';
    protected $primaryKey = 'id_Perusahaan';
    protected $fillable = ['id_Perusahaan', 'nama_Perusahaan'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_Jabatan', 'id_Jabatan');
    }
}
