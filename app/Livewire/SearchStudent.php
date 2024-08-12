<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class SearchStudent extends Component
{
    public $search = '';
    public function render()
    {
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
            ->get();
        return view('livewire.search-student', ['students' => $students]);
    }
}
