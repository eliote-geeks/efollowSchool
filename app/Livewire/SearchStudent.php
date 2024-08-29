<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\Scolarite;
use App\Models\SchoolInformation;

class SearchStudent extends Component
{
    public $search = '';
    protected $schoolInformation;

    public function mount()
    {
        $this->schoolInformation = SchoolInformation::where('status', 1)->first();
    }

    public function render()
    {
        $this->schoolInformation = SchoolInformation::where('status', 1)->first(); 
        $students = Student::query()
            ->where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->orWhere('place_birth', 'like', '%' . $this->search . '%')
            ->orWhere('date_birth', 'like', '%' . $this->search . '%')
            ->orWhere('phone_father', 'like', '%' . $this->search . '%')
            ->orWhere('phone_mother', 'like', '%' . $this->search . '%')
            ->orWhere('name_father', 'like', '%' . $this->search . '%')
            ->orWhere('name_mother', 'like', '%' . $this->search . '%')
            ->orWhere('matricular', 'like', '%' . $this->search . '%')
            ->take(10)
            ->get();
        return view('livewire.search-student', [
            'students' => $students,
            'scolarites' => Scolarite::where('school_information_id', $this->schoolInformation->id)
                // ->where('end_date', '>', now())
                ->get(),
        ]);
    }
}
