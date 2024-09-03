<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= Student::count(); $i++) {
            DB::table('student_classes')->insert([
                'student_id' => Student::find($i)->id, // ID d'un étudiant aléatoire
                'classe_id' => rand(1, 10),  // ID d'une classe aléatoire
                'school_information_id' => 3, // ID d'information sur l'école aléatoire
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
