<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory;

    protected $fillable = ['kode_skema', 'nama_skema', 'jenis_skema'];

    // Relasi One-to-Many ke Peserta
    public function pesertas()
    {
        return $this->hasMany(Peserta::class);
    }
}
