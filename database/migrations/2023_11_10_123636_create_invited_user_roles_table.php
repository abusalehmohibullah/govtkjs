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
        Schema::create('invited_user_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('invitation_id');
                    
            $table->primary(['role_id', 'invitation_id']);
                    
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('invitation_id')->references('id')->on('user_invitations')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invited_user_roles');
    }
};
