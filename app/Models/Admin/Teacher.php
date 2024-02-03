<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Admin\Room;

class Teacher extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'unique_id',
        'designation',
        'priority',
        'subject_id',
        'classroom_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'teacher_has_classrooms', 'teacher_id', 'classroom_id');
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
