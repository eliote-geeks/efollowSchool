<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\SchoolInformation;
use App\Models\Student;
use App\Models\StudentClasse;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       


     
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
                'niveau' => 'required'
            ]);
            $classe = new Classe();
            $classe->school_information_id = SchoolInformation::where('status',1)->latest()->first()->id;
            $classe->niveau_id = $request->niveau;
            $classe->name = $request->name;
            $classe->prof_titulaire = $request->prof_titulaire;
            $classe->save();
            return redirect()->back()->with('success','Nouvelle Classe AJoutée !!');
        }catch(\Exception $e){
            return redirect()->back()->with('error','Erreur innatendue !!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        try{
        $classes = Classe::where('school_information_id',SchoolInformation::where('status',1)->first()->id)->orderBy('name','desc')->get();
        $students = StudentClasse::where([
            'classe_id' => $classe->id,            
            ])->get();

        return view('student.student-list',[
            'classe' => $classe,
            'students' => $students,
            'classes' => $classes
        ]);
    }catch(\Exception $e){
        return redirect()->back()->with('error','Oups petit probleme!!');
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $classe)
    {
        try{
            $request->validate([
                'name' => 'required',
                'niveau' => 'required'
            ]);
            $classe->niveau_id = Niveau::find($request->niveau)->id;
            $classe->name = $request->name;
            $classe->prof_titulaire = $request->prof_titulaire;
            $classe->save();
            return redirect()->back()->with('success','Classe Mise A jour !!');
        }catch(\Exception $e){
            return redirect()->back()->with('error','Erreur innatendue !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        try{
            $classe->status = 0;
            $classe->save();
            return redirect()->back()->with('success','Classe Retirée !!');
        }catch(\Exception $e)
        {
            return redirect()->back()->with('danger','Oups une erreur s\'est produite veuillez reesayer: '.$e->getMessage()); 
        }
    }
}
