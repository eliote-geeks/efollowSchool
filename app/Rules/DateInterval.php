<?php

namespace App\Rules;

use Closure;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;

class DateInterval implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startDate = Carbon::parse(request('start_date'));
        $endDate = Carbon::parse($value);

        if($startDate->diffInMonths($endDate) >= 11){
            $fail('L\'intervalle entre les dates ne doit pas dépasser 11 mois.');
        }
    }
}
