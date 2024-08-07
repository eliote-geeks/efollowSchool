<?php

namespace App\Models;

use App\Models\Scolarite;
use App\Models\SchoolInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialScolarite extends Model
{
    use HasFactory;

    public function scolarite()
    {
        return $this->belongsTo(Scolarite::class);
    }

    public function schoolInformation()
    {
        return $this->belongsTo(SchoolInformation::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
