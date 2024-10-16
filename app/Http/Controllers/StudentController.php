<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Student;
use App\Models\SmartCard;
use Illuminate\Http\Request;
use App\Models\StudentClasse;
use App\Imports\StudentImport;
use App\Imports\StudentsImport;
use App\Models\SchoolInformation;
use Maatwebsite\Excel\Facades\Excel;
use App\Actions\Fortify\UpdateUserProfileInformation;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function searchByCard()
    {
        return view('student.card.search-student');
    }

    public function printCard(Student $student, SchoolInformation $schoolInformation)
    {
        return view('student.card-view', [
            'student' => $student,
            'schoolInformation' => $schoolInformation,
        ]);
    }

    public function showImportForm($classe)
    {
        return view('student.import-students', [
            'classe' => $classe,
        ]);
    }

    public function importStudentClase(Request $request, $classe)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
        Excel::import(new StudentsImport($classe), $request->file('file'));

        return redirect()->back()->with('success', 'Les étudiants ont été importés avec succès.');
    }

    public function createStudentClass(Classe $classe)
    {
        return view('student.create', [
            'classe' => $classe,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $st = Student::where([
            'id' => $student->id,
            'school_information_id' => SchoolInformation::where('status', 1)->first()->id,
        ])->firstOrFail();
        $student = $st;
        return view('student.student-view', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    public function searchByname()
    {
        return view('student.searchByname');
    }

    public function status(Student $student)
    {
        $smartCard = SmartCard::where([
            'user_id' => $student->id,
            'status' => 'on',
        ])->firstOrFail();
        $smartCard->status = 'false';
        $smartCard->save();

        $student->status = 0;
        $student->save();

        return redirect()->back()->with('success', 'etudiant désactivé avec success !!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'first' => 'required',
            'last' => 'required',
            'date_birth' => 'required',
            'place_birth' => 'required',
            'matricular' => 'required',
            'classe' => 'required',
            'name_father' => 'required',
            'phone_father' => 'required',
            'name_mother' => 'required',
            'phone_mother' => 'required',
            'sexe' => 'required',
        ]);

        if (isset($request->avatar)) {
            $student->user->updateProfilePhoto($request->avatar);
        }

        $student->first_name = $validatedData['first'];
        $student->last_name = $validatedData['last'];
        $student->date_birth = $validatedData['date_birth'];
        $student->place_birth = $validatedData['place_birth'];
        $student->matricular = $validatedData['matricular'];
        $student->sexe = $validatedData['sexe'];
        // $student->discount = $validatedData['discount'];

        Classe::find($validatedData['classe']);
        $sc = StudentClasse::where([
            'student_id' => $student->id,
            'classe_id' => $validatedData['classe'],
        ])->first();
        $sc->classe_id = $validatedData['classe'];
        $sc->save();
        User::log('etudiant mis à jour: '.$student->first_name.' '.$student->last_name);
        $student->name_father = $validatedData['name_father'];
        $student->phone_father = $validatedData['phone_father'];
        $student->name_mother = $validatedData['name_mother'];
        $student->phone_mother = $validatedData['phone_mother'];

        $student->save();
        return redirect()->back()->with('success', 'Elève mis a jour !!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->status = 2;
            $student->save();
            User::log('etudiant detruit: '.$student->first_name.' '.$student->last_name);
            return redirect()->back()->with('success', 'etudiant Retiré !!');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Une erreur s\'est produite veuillez reessayer !!');
        }
        // supprimer la carte
    }
}
