<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';
    protected $primaryKey = 'id_Perusahaan';
    protected $fillable = ['id_Perusahaan', 'nama_perusahaan'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
