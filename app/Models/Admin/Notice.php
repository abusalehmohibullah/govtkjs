<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'title',
        'content',
        'attachment',
        'published_on',
        'scroll',
    ];
    
    
}
