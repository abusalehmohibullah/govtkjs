<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
