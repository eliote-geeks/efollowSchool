<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SchoolInformation;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    protected $schoolInformation;

    public function __construct()
    {
        $this->schoolInformation = SchoolInformation::where('status', 1)->first();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::where('school_information_id', $this->schoolInformation->id)
            ->latest()
            ->get();
        return view('enseignant.enseignant', [
            'teachers' => $teachers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:8',
                ],
                [
                    'name.required' => 'le champ Nom ne peut rester vide',
                    'email.required' => 'le champ Email ne peut rester vide',
                    'email.email' => 'le champ Email Doit etre un email Valide',
                    'email.unique' => 'Cet Email a déja été pris',
                    'password.required' => 'le champ mot de passe ne peut rester vide',
                    'password.min' => 'le champ mot de passe doit contenir au moins 8 caractères',
                ],
            );
            // dd($request->all());
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = 'enseignant';
            $user->password = Hash::make($request->password);
            $user->save();

            $teacher = new Teacher();
            $teacher->school_information_id = $this->schoolInformation->id;
            $teacher->user_id = $user->id;
            $teacher->matricular = date('Y') . Str::limit($request->first, 3) . strtoupper(uniqid());
            $teacher->save();
            return redirect()->back()->with('success', 'Nouvel enseignant enregistré !!');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Oups une erreur s\'est produite');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        try {
            $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required|email',
                    // 'password' => 'required|min:8'
                ],
                [
                    'name.required' => 'le champ Nom ne peut rester vide',
                    'email.required' => 'le champ Email ne peut rester vide',
                    'email.email' => 'le champ Email Doit etre un email Valide',
                    'password.required' => 'le champ mot de passe ne peut rester vide',
                    'password.min' => 'le champ mot de passe doit contenir au moins 8 caractères',
                ],
            );

            $user = User::find($teacher->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if (isset($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return redirect()->back()->with('success', 'Enseignant Edité !!');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Oups une erreur s\'est produite');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            $teacher->delete();
            return redirect()->back()->with('success', 'enseignant retiré !!');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Une erreur s\'est produite !!');
        }
    }
}
