<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::latest()->get();
        return view('enseignant.enseignant',[
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
        try{
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8'
            ],[
                'name.required' => 'le champ Nom ne peut rester vide',
                'email.required' => 'le champ Email ne peut rester vide',
                'email.email' => 'le champ Email Doit etre un email Valide',
                'email.unique' => 'Cet Email a déja été pris',   
                'password.required' => 'le champ mot de passe ne peut rester vide',
                'password.min' => 'le champ mot de passe doit contenir au moins 8 caractères',
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->user_type = 'App\Models\Teacher';
            $user->password = Hash::make($request->password);
            $user->save();

            $teacher = new Teacher();
            $teacher->user_id = $user->id;
            $teacher->matricular = date('Y') .Str::limit($request->first,3) .strtoupper(uniqid());
            $teacher->save();
            return redirect()->back()->with('message','Nouvel enseignant enregistré !!');
        }catch(\Exception $e)
        {
            return redirect()->back()->with('message','Oups une erreur s\'est produite');
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
        try{
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                // 'password' => 'required|min:8'
            ],[
                'name.required' => 'le champ Nom ne peut rester vide',
                'email.required' => 'le champ Email ne peut rester vide',
                'email.email' => 'le champ Email Doit etre un email Valide',
                'password.required' => 'le champ mot de passe ne peut rester vide',
                'password.min' => 'le champ mot de passe doit contenir au moins 8 caractères',
            ]);

            $user = User::find($teacher->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()->back()->with('message','Nouvel enseignant enregistré !!');
        }catch(\Exception $e)
        {
            return redirect()->back()->with('message','Oups une erreur s\'est produite');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try{
            $teacher->delete();
        }catch(\Exception $e){
            return redirect()->back()->with('message','enseignant retiré !!');
        }
    }
}
