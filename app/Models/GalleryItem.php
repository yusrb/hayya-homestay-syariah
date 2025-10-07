<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'title', 'description', 'file_path'];

    public function isFoto(): bool
    {
        return $this->type === 'foto';
    }

    public function isVideo(): bool
    {
        return $this->type === 'video';
    }
}