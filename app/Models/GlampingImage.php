<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GlampingImage extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['glamping_id', 'image_path'];

    public function glamping()
    {
        return $this->belongsTo(Glamping::class);
    }
}
