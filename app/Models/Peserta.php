<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skema_id',
        'nama_lengkap',
        'email',
        'no_hp',
        'alamat',
        'status_sertifikasi',
    ];

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
