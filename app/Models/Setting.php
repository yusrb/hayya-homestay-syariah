<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'whatsapp_number',
        'logo',
        'map_embed_url',
    ];
}