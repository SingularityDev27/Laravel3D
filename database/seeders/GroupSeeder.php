<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GroupSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('groups')->insert([
                'grade' => rand(1, 6),
                'section' => chr(rand(65, 90)),
                'code' => strtoupper(Str::random(10)),
                'tutor_id' => rand(1, 20),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
