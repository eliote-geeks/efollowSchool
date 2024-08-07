<?php

namespace App\Models;

use App\Models\Niveau;
use App\Models\Student;
use App\Models\ClasseCours;
use App\Models\StudentClasse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;
    public function niveau()
    {
        return $this->hasMany(Niveau::class);
    }

    public function ClasseCours()
    {
        return $this->hasMany(ClasseCours::class);
    }

    public function studentClasse()
    {
        return $this->hasMany(StudentClasse::class);
    }
}
