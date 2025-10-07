<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    protected $fillable = [
        'id_pengguna',
        'aksi',
        'sumber',
        'rincian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc')->take(4);
    }
}