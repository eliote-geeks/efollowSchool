<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Scolarite;
use App\Models\SchoolInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Niveau extends Model
{
    use HasFactory;

    public function schoolInformation()
    {
        return $this->belongsTo(SchoolInformation::class);
    }

    public function scolarite()
    {
        return $this->hasMany(Scolarite::class);
    }

    public function classe()
    {
        return $this->hasMany(Classe::class);
    }
}
