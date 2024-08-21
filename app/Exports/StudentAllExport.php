<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\SchoolInformation;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentAllExport implements ToModel, WithHeadingRow
{
    protected $schoolInformation;

    public function __construct()
    {
        $this->schoolInformation = SchoolInformation::where('status', 1)->first();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function model(array $studentsArray)
    {
        $students = Student::select('id', 'first_name', 'last_name', 'date_birth', 'place_birth', 'sexe', 'matricular')
            ->where('school_information_id', $this->schoolInformation->id)
            ->with('studentClasse.classe.niveau')
            ->get();

        // $studentsArray = [];

        foreach ($students as $student) {
            $studentsArray[] = [
                'nom_complet' => $student->first_name . ' ' . $student->first_name,
                'Matricule' => $student->matricular,
                'date_de_naissance' => Carbon::parse($student->date_birth)->format('d, M Y'),
                'lieu_de_naissance' => $student->place_birth,
                'sexe' => $student->sexe,
                'classe' => $student->studentClasse->classe->name,
                'niveau' => $student->studentClasse->classe->niveau->name,
            ];
        }
        dd($studentsArray);
        return $studentsArray;
    }

    /**
     * Définir les en-têtes du fichier Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return ['nom_complet', 'matricule', 'date_de_naissance', 'lieu_de_naissance', 'sexe', 'classe', 'niveau'];
    }

}
