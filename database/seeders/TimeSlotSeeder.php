<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\TimeSlot;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           // Définir l'intervalle en minutes (par exemple, 30 minutes)
           $interval = 30;
        
           // Heure de début de la journée (08:00)
           $startTime = Carbon::createFromTime(8, 0, 0);
   
           // Heure de fin de la journée (18:00)
           $endTime = Carbon::createFromTime(18, 0, 0);
   
           while ($startTime->lessThan($endTime)) {
               // Calculer l'heure de fin du créneau
               $slotEndTime = $startTime->copy()->addMinutes($interval);
   
               // Insérer le créneau horaire dans la base de données
               TimeSlot::create([
                   'start_time' => $startTime->format('H:i:s'),
                   'end_time' => $slotEndTime->format('H:i:s'),
               ]);
   
               // Avancer à l'heure de début du prochain créneau
               $startTime->addMinutes($interval);
           }
    }
}
