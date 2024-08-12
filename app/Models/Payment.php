<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Student;
use App\Models\SchoolInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    public function schoolInformation()
    {
        return $this->belongsTo(SchoolInformation::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
