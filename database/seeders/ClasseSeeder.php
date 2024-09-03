<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('classes')->insert([
                'niveau_id' => rand(1, 10), // Associe chaque classe à un niveau aléatoire
                'school_information_id' => 3, // Remplacez par l'ID approprié
                'name' => 'Classe ' . Str::random(5), // Génère un nom de classe aléatoire
                'status' => rand(0, 1), // Génère un statut aléatoire (1 ou 0)
                'prof_titulaire' => 'Prof ' . Str::random(3), // Génère un nom de prof titulaire aléatoire
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
