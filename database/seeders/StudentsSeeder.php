<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class StudentsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 200; $i++) {
            DB::table('students')->insert([
                'name' => $faker->firstName,
                'lastname_p' => $faker->lastName,
                'lastname_m' => $faker->lastName,
                'age' => $faker->numberBetween(18, 30),
                'degree' => 'Degree ' . $faker->randomDigitNotNull,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->numerify('###########'),
                'birthdate' => $faker->date(),
                'group_id' => $faker->numberBetween(1, 10), // Asignar un grupo aleatorio
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
