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
            $table->string('unique_id')->nullable();
            $table->string('roll_number')->nullable(); // Current roll number (changes every year)
            $table->string('registration_number')->nullable(); // Registration number

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
            $table->string('brid', 17)->nullable();
 
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('student_mobile_no');
            $table->string('father_mobile_no')->nullable();
            $table->string('mother_mobile_no')->nullable();
            $table->string('guardian_mobile_no')->nullable();
            $table->text('address_en')->nullable();
            $table->text('address_bn')->nullable();

            $table->enum('gender_en', ['male', 'female', 'others'])->nullable();
            $table->enum('gender_bn', ['পুরুষ', 'মহিলা', 'অন্যান্য'])->nullable();            
            $table->enum('religion_en', ['islam', 'hinduism', 'buddhism', 'christianity', 'others'])->nullable();
            $table->enum('religion_bn', ['ইসলাম', 'হিন্দু', 'বৌদ্ধ', 'খ্রিষ্টান', 'অন্যান্য'])->nullable();            
            $table->enum('disability_status_en', ['physical', 'visual', 'hearing', 'verbal', 'intellectual', 'others'])->nullable();
            $table->enum('disability_status_bn', ['দৃষ্টি প্রতিবন্ধী', 'শ্রবণ প্রতিবন্ধী', 'বাক প্রতিবন্ধী', 'বুদ্ধি প্রতিবন্ধী', 'অন্যান্য'])->nullable();           

            $table->unsignedBigInteger('classroom_id')->nullable();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('set null');

            $table->timestamps();
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
