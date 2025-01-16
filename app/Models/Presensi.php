<?php
// Model Presensi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';
    protected $primaryKey = 'id_Presensi';
    
    protected $fillable = [
        'user_id',
        'jenis_Presensi',
        'Tanggal',
        'Waktu',
        'Latitude',
        'Longitude',
        'status_Presensi',
        'Alamat',
        'Bagian',
        'Keterangan',
        'Foto', // Tambahkan kolom Foto
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}