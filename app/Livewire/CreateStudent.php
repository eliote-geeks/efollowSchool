<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateStudent extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $year;
    public $avatar;
    public $first_name;
    public $last_name;
    public $place_birth;
    public $date_birth;
    public $phone_father;
    public $phone_mother;
    public $matricular;
    public $logo;
    // public 


    // $table->foreignId('school_information_id')->references('id')->on('school_informations')->onDelete('cascade');
    // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
    // $table->string('first_name');
    // $table->string('last_name');
    // $table->string('place_birth');
    // $table->timestamp('date_birth');
    // $table->string('phone_father')->nullable();
    // $table->string('phone_mother')->nullable();
    // $table->string('matricular');
    // $table->boolean('status');

    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.create-student');
    }
}
