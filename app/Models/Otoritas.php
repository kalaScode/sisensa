<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otoritas extends Model
{
    protected $table = 'otorisasi';
    public function user()
    {
        return $this->hasOne(User::class,'user_id');
    }
}
