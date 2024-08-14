<?php

namespace App\Models;

use App\Models\User;
use App\Models\Classe;
use App\Models\Student;
use App\Models\Scolarite;
use App\Models\RequestPayment;
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

    public function scolarite()
    {
        return $this->belongsTo(Scolarite::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public static function statusDiscount($student, $scolarite)
    {
        $discountedAmount = $scolarite->amount - $scolarite->amount * ($student->discount / 100);
        return $discountedAmount;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function request_payment()
    {
        return $this->hasMany(RequestPayment::class);
    }
}
