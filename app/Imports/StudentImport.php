<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use App\Models\SchoolInformation;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'erreur innatendue');
        }
        $user = new User();
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];

        $email = strtolower($firstName . '.' . $lastName . '.' . uniqid() . '@example.com');

        $user->name = $firstName;
        $user->email = $email;
        $user->password = Hash::make('500//#ERROR');
        $user->save();

        $uniqueId = str_pad($user->id, 6, '0', STR_PAD_LEFT);

        return new Student([
            'school_information_id' => SchoolInformation::where('status', 1)->latest()->first()->id,
            'first_name'    => $row['first_name'],
            'last_name'     => $row['last_name'],
            'place_birth'   => $row['place_birth'],
            'date_birth'    => Carbon::createFromFormat('Y-m-d', $row['date_birth']),
            'phone_father'  => $row['phone_father'],
            'phone_mother'  => $row['phone_mother'],
            'name_father'   => $row['name_father'],
            'name_mother'   => $row['name_mother'],
            'matricular' => date('Y') . SchoolInformation::where('status', 1)->latest()->first()->id->matricular . $uniqueId,
        ]);
    }
}
