<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Student;
use App\Models\StudentClasse;
use App\Models\SchoolInformation;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    protected $classe;
    protected $schoolInformation;

    public function __construct($classe)
    {
        $this->classe = $classe;
        $this->schoolInformation = SchoolInformation::where('status', 1)->first();
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        $user = new User();

        $firstName = $row['nom'];
        $lastName = $row['prenom'];

        $uniqueId = uniqid();
        $email = strtolower($firstName . '.' . $lastName . '.' . $uniqueId . '@example.com');

        $user->name = $firstName . ' ' . $lastName;
        $user->email = $email;
        $user->password = Hash::make('500//#ERROR');
        $user->save();
        $uniqueId = str_pad($user->id, 5, '0', STR_PAD_LEFT);
        $matricule = $this->schoolInformation->matricular . $uniqueId;
        // Créez un nouvel étudiant
        $student = new Student();
        $student->user_id = $user->id;
        $student->school_information_id = $this->schoolInformation->id;
        $student->first_name = $row['nom'];
        $student->last_name = $row['prenom'];
        $student->place_birth = $row['lieu_de_naissance'];
        $student->date_birth = \Carbon\Carbon::parse($row['date_de_naissance']);
        $student->phone_father = $row['telephone_pere'];
        $student->phone_mother = $row['telephone_mere'];
        $student->name_father = $row['nom_mere'];
        $student->name_mother = $row['nom_pere'];
        $student->sexe = $row['sexe'];
        // $student->remise = $row['remise'];
        $student->matricular = $matricule;
        $student->save();

        // Liez cet étudiant à la classe spécifiée
        $studentClasse = new StudentClasse();
        $studentClasse->classe_id = $this->classe; // Utilisez l'ID de classe passé dans le constructeur
        $studentClasse->student_id = $student->id; // Associez l'étudiant nouvellement créé
        $studentClasse->school_information_id = $this->schoolInformation->id; // Associez l'ID de l'information scolaire si nécessaire
        $studentClasse->save();
        User::log('Etudiant ajouté: '.$student->first_name.' '.$student->last_name);
        return $student;
    }
}
