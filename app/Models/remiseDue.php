<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Scolarite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class remiseDue extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function scolarite()
    {
        return $this->belongsTo(Scolarite::class);
    }
}
