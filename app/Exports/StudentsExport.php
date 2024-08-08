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
        return Student::all(['first_name', 'last_name', 'place_birth', 'date_birth', 'phone_father', 'phone_mother', 'name_father', 'name_mother', 'matricular']);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ['First Name', 'Last Name', 'Place of Birth', 'Date of Birth', 'Father\'s Phone', 'Mother\'s Phone', 'Father\'s Name', 'Mother\'s Name', 'matricular'];
    }

    /**
     * Mappe les données de la collection pour l'export.
     *
     * @param  \App\Models\Student  $student
     * @return array
     */
    public function map($student): array
    {
        return [
            $student->first_name,
            $student->last_name,
            $student->place_birth,
            $student->date_birth->format('d/m/Y'), // Formate la date au format souhaité
            $student->phone_father,
            $student->phone_mother,
            $student->name_father,
            $student->name_mother,
            $student->matricular,
        ];
    }
}
