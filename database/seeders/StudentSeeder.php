<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= User::count(); $i++) {
            DB::table('students')->insert([
                'school_information_id' => 3, // Associe un étudiant à une école aléatoire
                'user_id' => User::find($i)->id, // ID utilisateur aléatoire
                'first_name' => 'FirstName' . $i,
                'last_name' => 'LastName' . $i,
                'place_birth' => 'City' . rand(1, 10),
                'date_birth' => Carbon::now()->subYears(rand(18, 25))->subDays(rand(0, 365)), // Génère une date de naissance
                'phone_father' => '6' . rand(100000000, 999999999), // Numéro de téléphone fictif du père
                'phone_mother' => '6' . rand(100000000, 999999999), // Numéro de téléphone fictif de la mère
                'name_father' => 'Father' . $i,
                'name_mother' => 'Mother' . $i,
                'matricular' => '2023STD' . Str::random(5), // Matricule unique
                'status' => 1, // Statut aléatoire (0 ou 1)
                'sexe' => rand(0, 1) == 0 ? 'Masculin' : 'Feminin', // Sexe aléatoire (M ou F)
                'discount' => rand(0, 20), // Remise aléatoire entre 0% et 20%
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
