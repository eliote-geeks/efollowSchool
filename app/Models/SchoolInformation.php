<?php

namespace App\Models;

use App\Models\Niveau;
use App\Models\Student;
use App\Models\Moratoire;
use App\Models\Scolarite;
use App\Models\StudentClasse;
use App\Models\SpecialScolarite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolInformation extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function niveau()
    {
        return $this->hasMany(Niveau::class);
    }

    public function scolarite()
    {
        return $this->hasMany(Scolarite::class);
    }

    public function studentClasse()
    {
        return $this->hasMany(StudentClasse::class);
    }

    public function moratoire()
    {
        return $this->hasMany(Moratoire::class);
    }

    public function specialScolarite()
    {
        return $this->hasMany(SpecialScolarite::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
