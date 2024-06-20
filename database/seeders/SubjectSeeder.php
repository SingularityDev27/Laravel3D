<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        $subjects = [
            'Aplicaciones Web', 'Base de Datos', 'Base de Datos para Aplicaciones', 'Aplicaciones Web para I4.0',
            'Integradora', 'Sistemas Operativos', 'Programacion Orientada a Objetos', 
            'Estandares y Metricas de Calidad Para el Desarrollo de Software', 
            'Evaluacion y Mejora para el Desarrollo de Software', 'Estructura de Datos'
        ];

        foreach ($subjects as $subject) {
            DB::table('subjects')->insert([
                'code' => strtoupper(Str::random(10)),
                'grade' => rand(1, 6),
                'name' => $subject,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
