<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'room_id',
        'grade_id',
        'section_id',
        'group_id',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }
        
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
        
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
        
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
        
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
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
