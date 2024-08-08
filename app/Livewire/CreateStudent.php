<?php

namespace App\Livewire;

// use d;
use PDF;
use App\Models\User;
use App\Models\Classe;
use App\Models\Student;
use Livewire\Component;
use App\Models\StudentClasse;
use Livewire\WithFileUploads;
use App\Models\SchoolInformation;
use Livewire\Attributes\Validate;

use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\alert;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateStudent extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $step = 0;

    public $schoolInformation;
    #[Validate('required|image')]
    public $avatar;

    #[Validate('required')]
    public $first_name;

    #[Validate('required')]
    public $last_name;

    #[Validate('required')]
    public $place_birth;

    #[Validate('required|date')]
    public $date_birth;

    #[Validate('required')]
    public $phone_father;

    #[Validate('required')]
    public $phone_mother;

    #[Validate('required')]
    public $name_father;

    #[Validate('required')]
    public $name_mother;

    #[Validate('required')]
    public $classe;

    public $matricular;

    public $student;

    public function save()
    {
        try {
            $this->validate();
            DB::transaction(function () {
                $user = new User();

                $firstName = $this->first_name;
                $lastName = $this->last_name;

                $uniqueId = uniqid();
                $email = strtolower($firstName . '.' . $lastName . '.' . $uniqueId . '@example.com');

                $user->name = $firstName . ' ' . $lastName;
                $user->email = $email;
                $user->password = Hash::make('500//#ERROR');
                $user->save();
                $user->updateProfilePhoto($this->avatar);

                $uniqueId = str_pad($user->id, 5, '0', STR_PAD_LEFT);
                $matricule = date('Y') . $this->schoolInformation->matricular . $uniqueId;

                $student = new Student();
                $student->first_name = $this->first_name;
                $student->last_name = $this->last_name;
                $student->place_birth = $this->place_birth;
                $student->date_birth = $this->date_birth;
                $student->phone_father = $this->phone_father;
                $student->phone_mother = $this->phone_mother;
                $student->name_father = $this->name_father;
                $student->name_mother = $this->name_mother;
                $student->matricular = $matricule;
                $student->school_information_id = $this->schoolInformation->id;
                $student->user_id = $user->id;
                $student->save();

                $classe = Classe::find($this->classe)->id;
                $studentClass = new StudentClasse();
                $studentClass->classe_id = $classe;
                $studentClass->student_id = $student->id;
                $studentClass->school_information_id = $this->schoolInformation->id;
                $studentClass->save();
                $this->step = 1;
                $this->student = $student;
                $this->alert('success', 'Elève Crée Mais Désactivé !!');
            });
        } catch (\Exception $e) {
            $this->alert('warning', 'Veuillez remplir correctement les informations: ' . $e->getMessage());
        }
    }

    public function dec($dec)
    {
        if ($dec == 1) {
            $student = $this->student;
            $schoolInformation = $this->schoolInformation;
            return redirect()->route('print.card',[
                'student' => $student,
                'schoolInformation' => $schoolInformation,
            ]);
        } else {
            $this->reset();
        }
    }

    public function render()
    {
        if (SchoolInformation::where('status', 1)->count() > 0) {
            $this->schoolInformation = SchoolInformation::where('status', 1)->first();
            return view('livewire.create-student', [
                'classes' => Classe::where('status', 1)->get(),
            ]);
        } else {
            return view('welcome');
        }
    }
}
