<?php

namespace App\Models;

use App\Models\User;
use App\Models\Niveau;
use App\Models\Student;
use App\Models\SchoolInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scolarite extends Model
{
    use HasFactory;

    public function schoolInformation()
    {
        return $this->belongsTo(SchoolInformation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
}
