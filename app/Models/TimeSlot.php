<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeSlot extends Model
{
    protected $fillable = [
        'start_time',
        'end_time'
    ];
    use HasFactory;

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
