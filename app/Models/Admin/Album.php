<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function delete()
    {
        // Delete associated media records and their files
        $this->media()->get()->each(function ($media) {
            // Delete the media record from the database
            $media->delete();

            // Delete the associated file
            Storage::disk('public')->delete($media->path);
        });

        // Delete the album record from the database
        parent::delete();
    }
}
