<?php

namespace App\Models;

use App\Models\User;
use App\Models\Niveau;
use App\Models\Payment;
use App\Models\Student;
use App\Models\SpecialScolarite;
use App\Models\SchoolInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scolarite extends Model
{
    protected $casts = [
        'niveaux' => 'array',
    ];
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

    public function remiseDue()
    {
        return $this->hasMany(remiseDue::class);
    }
}
