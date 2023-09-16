<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasicInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('basic_infos')->insert([
            [
                'name' => 'name',
                'key' => 'name',
                'content' => 'Rajoir Gopalgonj KJS Pilot Model Instittution & College',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'established',
                'key' => 'established',
                'content' => '1929',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'permission',
                'key' => 'permission',
                'content' => '1929',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'recognition',
                'key' => 'recognition',
                'content' => '1929',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'mpo',
                'key' => 'mpo',
                'content' => '0000',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'nationalized',
                'key' => 'nationalized',
                'content' => '2018',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'eiin',
                'key' => 'eiin',
                'content' => '110791',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'school_code',
                'key' => 'school_code',
                'content' => '5553',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'college_code',
                'key' => 'college_code',
                'content' => '5630',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'history_title',
                'key' => 'history_title',
                'content' => 'history title',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'history_content',
                'key' => 'history_content',
                'content' => 'history content',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'message_1_title',
                'key' => 'message_1_title',
                'content' => 'message 1 title',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'message_1_content',
                'key' => 'message_1_content',
                'content' => 'message 1 content',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'message_2_title',
                'key' => 'message_2_title',
                'content' => 'message 2 title',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'message_2_content',
                'key' => 'message_2_content',
                'content' => 'message 2 content',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'phone',
                'key' => 'phone',
                'content' => '0123456789',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'email',
                'key' => 'email',
                'content' => 'knock.mdch@gmail.com',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'address',
                'key' => 'address',
                'content' => 'Rajoir Madaripur',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'socials',
                'key' => 'facebook',
                'content' => 'facebook account link',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'socials',
                'key' => 'x',
                'content' => 'x account link',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'socials',
                'key' => 'instagram',
                'content' => 'instagram account link',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'socials',
                'key' => 'linkedin',
                'content' => 'linkedin account link',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'socials',
                'key' => 'youtube',
                'content' => 'youtube channel link',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}
