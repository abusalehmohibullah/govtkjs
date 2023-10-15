<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
    ];

    
    public function media()
    {
        return $this->hasMany(Media::class, 'album_id');
    }
}
