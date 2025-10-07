<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['name', 'description', 'icon'];

    public function images()
    {
        return $this->hasMany(FacilityImage::class);
    }

    public function primaryImage()
    {
        return $this->images()->where('is_primary', true)->first() ?? $this->images()->first();
    }
}