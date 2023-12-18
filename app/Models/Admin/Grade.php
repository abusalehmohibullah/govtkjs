<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Grade extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'name',
    ];

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'grade_has_sections', 'grade_id', 'section_id');
    }
    
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'grade_has_groups', 'grade_id', 'group_id');
    }
    
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'grade_has_subjects', 'grade_id', 'subject_id');
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
