<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::all([
            'first_name',
            'last_name',
            'place_birth',
            'date_birth',
            'phone_father',
            'phone_mother',
            'name_father',
            'name_mother',
            'matricular',
        ]);
    }


       /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Place of Birth',
            'Date of Birth',
            'Father\'s Phone',
            'Mother\'s Phone',
            'Father\'s Name',
            'Mother\'s Name',
            'matricular',
        ];
    }
}
