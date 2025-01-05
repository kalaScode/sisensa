<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Notification;
use App\Notifications\PengumumanGeneral;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'name',
        'email',
        'id_Perusahaan',
        'id_otoritas',
        'no_Telp',
        'password',
        'status_Kerja',
        'status_Akun',
        'id_Jabatan',
        'Avatar',
        'Alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_Perusahaan', 'id_Perusahaan');
    }

    public function otorisasi()
    {
        return $this->belongsTo(Otoritas::class, 'id_Otoritas', 'id_Otoritas');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!$user->id_Jabatan && $user->id_Perusahaan) {
                $user->id_Jabatan = Jabatan::where('id_Perusahaan', $user->id_Perusahaan)
                    ->value('id_Jabatan') ?? null; // Default NULL jika tidak ditemukan
            }
        });
    }
    
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_Jabatan', 'id_Jabatan');
    }

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Gunakan notifikasi khusus
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPassword($token));
    }
}
