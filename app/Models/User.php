<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'pangkat_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function penilai()
    {
        return $this->belongsTo(User::class, 'penilai_id');
    }

    public function pegawai()
    {
        return $this->hasMany(User::class, 'penilai_id');
        return $this->hasMany(User::class, 'atasan_id');
    }

    public function atasan()
    {
        return $this->belongsTo(User::class, 'atasan_id');
    }

    public function sasaran()
    {
        return $this->hasMany(Sasaran::class);
    }

    public function perilaku()
    {
        return $this->hasOne(Perilaku::class);
    }
}
