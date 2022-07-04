<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function penilai()
    // {
    //     return $this->belongsTo(User::class, 'penilai_id');
    // }

    public function rencana()
    {
        return $this->belongsTo(Rencana::class);
    }
}
