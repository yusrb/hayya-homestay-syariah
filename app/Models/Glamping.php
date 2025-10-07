<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Glamping extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'type', 'description', 'status', 'capacity', 'beds', 'price', 'rating'
    ];

    public function images()
    {
        return $this->hasMany(GlampingImage::class);
    }
}
