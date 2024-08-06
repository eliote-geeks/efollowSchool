<?php

namespace App\Models;

use App\Models\User;
use App\Models\SmartCard;
use App\Models\SchoolInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

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
}
