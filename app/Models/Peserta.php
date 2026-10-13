<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'skema_id',
        'nama_lengkap',
        'email',
        'no_hp',
        'alamat',
        'status_sertifikasi'
    ];

    // Relasi Inverse ke Skema
    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

