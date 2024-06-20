<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('teachers')->insert([
                'name' => $faker->firstName,
                'lastname_p' => $faker->lastName,
                'lastname_m' => $faker->lastName,
                'age' => $faker->numberBetween(25, 65),
                'degree' => $faker->jobTitle,
                'salary' => $faker->randomFloat(2, 30000, 90000),
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->numerify('###########'),
                'birthdate' => $faker->date(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
