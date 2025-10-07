<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'rating', 'text', 'image', 'source', 'date'];

    protected $casts = [
        'date' => 'datetime',
    ];
}