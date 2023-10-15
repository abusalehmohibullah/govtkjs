<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'album_id',
        'caption',
    ];

    public function album()
    {
        return $this->belongsTo(Albums::class, 'album_id');
    }
}
