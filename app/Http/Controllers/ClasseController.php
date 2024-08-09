<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\SchoolInformation;
use App\Models\Student;
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
            $classe->niveau_id = Niveau::find($request->niveau)->id;
            $classe->name = $request->name;
            $classe->prof_titulaire = $request->prof_titulaire;
            $classe->save();
            return redirect()->back()->with('message','Nouvelle Classe AJoutée !!');
        }catch(\Exception $e){
            return redirect()->back()->with('message','Erreur innatendue !!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {

        return view('student.student-list',[
            'classe' => $classe,
        ]);
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
            return redirect()->back()->with('message','Nouvelle Classe AJoutée !!');
        }catch(\Exception $e){
            return redirect()->back()->with('message','Erreur innatendue !!');
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
            return redirect()->back()->with('message','Nouvelle Classe AJoutée !!');
        }catch(\Exception $e)
        {
            return redirect()->back()->with('message','Oups une erreur s\'est produite veuillez reesayer: '.$e->getMessage()); 
        }
    }
}
