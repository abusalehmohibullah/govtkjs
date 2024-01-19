<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';
    
    protected $fillable = [
        // 'student_id' => 'required|unique:students',
        'unique_id',
        'roll_no',
        'registration_no',
        'student_name_en',
        'student_name_bn',
        'father_name_en',
        'father_name_bn',
        'mother_name_en',
        'mother_name_bn',
        'guardian_name_en',
        'guardian_name_bn',
        'date_of_birth',
        'brid',
        'photo',
        'email',
        'student_mobile_no',
        'father_mobile_no',
        'mother_mobile_no',
        'guardian_mobile_no',
        'address_en',
        'address_bn',
        'gender_en',
        'gender_bn',
        'religion_en',
        'religion_bn',
        'disability_status_en',
        'disability_status_bn',
        'classroom_id',
    ];

        
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
