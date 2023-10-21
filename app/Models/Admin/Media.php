<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
       
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
