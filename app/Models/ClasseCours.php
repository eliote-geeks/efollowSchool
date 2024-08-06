<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClasseCours extends Model
{
    use HasFactory;

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
