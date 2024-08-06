<?php

namespace App\Models;

use App\Models\Niveau;
use App\Models\Student;
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
}
