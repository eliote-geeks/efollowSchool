<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('niveaux')->insert([
                'school_information_id' => 3, // Remplacez par l'ID approprié ou utilisez une logique pour le générer dynamiquement
                'name' => 'Niveau ' . $i,
                'status' => rand(0, 1), // Génère un statut aléatoire (1 ou 0)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
    }
}
