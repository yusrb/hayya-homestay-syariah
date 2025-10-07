<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPengunjung extends Model
{
    use HasFactory;

    protected $table = 'log_pengunjung';

    protected $fillable = ['tanggal', 'jumlah_kunjungan'];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah_kunjungan' => 'integer',
    ];

    public function scopeThisWeek($query)
    {
        return $query->where('tanggal', '>=', now()->startOfWeek())->orderBy('tanggal');
    }
}