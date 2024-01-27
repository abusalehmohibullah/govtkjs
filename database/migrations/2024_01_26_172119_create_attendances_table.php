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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            // Foreign key to link attendance to a specific classroom
            $table->foreignId('classroom_id')->constrained('classrooms');
            // Foreign key to link attendance to a specific user (student)
            $table->string('student_id');
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');

            // Date and time of attendance
            $table->dateTime('attendance_date');

            $table->integer('status')->default(0);

            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
