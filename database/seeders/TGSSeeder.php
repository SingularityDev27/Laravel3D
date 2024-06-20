<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TGSSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) { // 10 Groups
            for ($j = 1; $j <= 10; $j++) { // 10 Subjects
                DB::table('teacher_subject_group')->insert([
                    'teacher_id' => rand(1, 20),
                    'subject_id' => $j,
                    'group_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
