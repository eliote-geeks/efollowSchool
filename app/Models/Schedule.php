<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Absence;
use App\Models\Teacher;
use App\Models\Presence;
use App\Models\TimeSlot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function absence()
    {
        return $this->hasMany(Absence::class);
    }

    public function presence()
    {
        return $this->hasMany(Presence::class);
    }
}
