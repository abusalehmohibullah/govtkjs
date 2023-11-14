<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin\Room;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'building_id');
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
