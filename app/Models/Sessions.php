<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    protected $table = 'sessions';

    protected $primaryKey = 'id'; // Primary key dari tabel

    protected $fillable = [
        'user_id',
        'last_activity'
    ];
}
