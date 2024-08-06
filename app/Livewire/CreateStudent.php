<?php

namespace App\Livewire;

use App\Models\Classe;
use App\Models\User;
use App\Models\Student;
use Livewire\Component;
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

    public function mount()
    {
        try {
            $this->schoolInformation = SchoolInformation::where('status',1)->first();
        } catch (\Exception $e) {
            return redirect()->route('schoolInformation.create', [
                'message' => 'Veuillez configurer les informations de votre école',
            ]);
        }
    }

    public function save()
    {
        try {
            $this->validate();

            DB::transaction(function () {
                $user = new User();

                $firstName = $this->first_name;
                $lastName = $this->first_last;

                $uniqueId = uniqid();
                $email = strtolower($firstName . '.' . $lastName . '.' . $uniqueId . '@example.com');

                $user->name = $firstName;
                $user->email = $email;
                $user->password = Hash::make('500//#ERROR');
                $user->save();
                $user->updateProfilePhoto($this->avatar);

                $uniqueId = str_pad($user->id, 6, '0', STR_PAD_LEFT);
                $matricule = date('Y') . $this->schoolInformation->matricular . $uniqueId;

                $student = new Student();
                $student->classe_id = Classe::find($this->classe)->id;
                $student->first_name = $this->first_name;
                $student->last_name = $this->last_name;
                $student->place_birth = $this->place_birth;
                $student->date_birth = $this->date_birth;
                $student->phone_father = $this->phone_father;
                $student->phone_mother = $this->phone_mother;
                $student->name_father = $this->name_father;
                $student->name_mother = $this->name_mother;
                $student->matricular = $matricule;
                $student->schoolInformation_id = $this->schoolInformation->id;
                $student->user_id = $user->id;
                $student->save();
            });

            alert('success', 'utilisateur Crée mais non actif', 'position', 'center');

            
        } catch (\Exception $e) {
            alert('danger', 'erreur de creation de ce profil: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.create-student');
    }
}
