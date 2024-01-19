<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {

            $table->string('student_id')->primary(); // Custom student ID (e.g., 240001)
            $table->string('unique_id')->nullable()->unique();
            $table->string('roll_no')->nullable(); // Current roll number (changes every year)
            $table->string('registration_no')->nullable(); // Registration number

            // Existing student details
            $table->string('student_name_en');
            $table->string('student_name_bn');
            $table->string('father_name_en');
            $table->string('father_name_bn');
            $table->string('mother_name_en');
            $table->string('mother_name_bn');
            $table->string('guardian_name_en')->nullable();
            $table->string('guardian_name_bn')->nullable();
            $table->date('date_of_birth');
            $table->string('brid', 17);
 
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('student_mobile_no');
            $table->string('father_mobile_no')->nullable();
            $table->string('mother_mobile_no')->nullable();
            $table->string('guardian_mobile_no')->nullable();
            $table->text('address_en')->nullable();
            $table->text('address_bn')->nullable();

            $table->enum('gender_en', ['Male', 'Female', 'Others']);
            $table->enum('gender_bn', ['বালক', 'বালিকা', 'অন্যান্য']);            
            $table->enum('religion_en', ['Islam', 'Hinduism', 'Buddhism', 'Christianity', 'Others'])->nullable();
            $table->enum('religion_bn', ['ইসলাম', 'হিন্দু', 'বৌদ্ধ', 'খ্রিষ্টান', 'অন্যান্য'])->nullable();            
            $table->enum('disability_status_en', ['None', 'Physical', 'visual', 'Hearing', 'Verbal', 'Intellectual', 'Others'])->nullable();
            $table->enum('disability_status_bn', ['প্রযোজ্য নয়', 'শারীরিক প্রতিবন্ধী', 'দৃষ্টি প্রতিবন্ধী', 'শ্রবণ প্রতিবন্ধী', 'বাক প্রতিবন্ধী', 'বুদ্ধি প্রতিবন্ধী', 'অন্যান্য'])->nullable();           

            $table->unsignedBigInteger('classroom_id')->nullable();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('set null');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
