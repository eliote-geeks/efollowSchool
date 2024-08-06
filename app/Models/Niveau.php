<?php

namespace App\Models;

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
}
