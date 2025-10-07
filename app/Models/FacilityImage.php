<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityImage extends Model
{
    protected $fillable = ['facility_id', 'file_path', 'is_primary'];
}