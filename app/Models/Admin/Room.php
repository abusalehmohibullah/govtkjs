<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin\Building;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'room_no',
        'name',
        'student_capacity',
        'examinee_capacity',
    ];
    
    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
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
