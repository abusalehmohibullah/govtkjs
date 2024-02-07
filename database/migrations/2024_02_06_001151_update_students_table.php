<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Remove existing columns
            $table->dropColumn(['address_en', 'address_bn']);

            // Add new columns after mother_name_bn
            $table->string('village_en')->nullable()->after('mother_name_bn');
            $table->string('village_bn')->nullable()->after('village_en');
            $table->string('post_office_en')->nullable()->after('village_bn');
            $table->string('post_office_bn')->nullable()->after('post_office_en');
            $table->string('upazila_en')->nullable()->after('post_office_bn');
            $table->string('upazila_bn')->nullable()->after('upazila_en');
            $table->string('district_en')->nullable()->after('upazila_bn');
            $table->string('district_bn')->nullable()->after('district_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Reverse the changes if needed
            $table->string('address_en')->nullable();
            $table->string('address_bn')->nullable();

            $table->dropColumn([
                'village_en', 'village_bn',
                'post_office_en', 'post_office_bn',
                'upazila_en', 'upazila_bn',
                'district_en', 'district_bn',
            ]);
        });
    }
};
