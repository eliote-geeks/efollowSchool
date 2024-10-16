<?php

namespace App\Models;

use App\Models\User;
use App\Models\Classe;
use App\Models\Payment;
use App\Models\Moratoire;
use App\Models\remiseDue;
use App\Models\Scolarite;
use App\Models\SmartCard;
use App\Models\StudentClasse;
use App\Models\SpecialScolarite;
use App\Models\SchoolInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public function absence()
    {
        return $this->hasMany(Absence::class);
    }

    public function presence()
    {
        return $this->hasMany(Presence::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schoolInformation()
    {
        return $this->belongsTo(SchoolInformation::class);
    }

    public function smartCard()
    {
        return $this->hasOne(SmartCard::class);
    }

    public function studentClasse()
    {
        return $this->hasOne(StudentClasse::class);
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

    public function moratoire()
    {
        return $this->hasMany(Moratoire::class);
    }

    public function request_payment()
    {
        return $this->hasMany(RequestPayment::class);
    }
}
