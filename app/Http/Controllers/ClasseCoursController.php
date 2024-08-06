<?php

namespace App\Http\Controllers;

use App\Models\ClasseCours;
use Illuminate\Http\Request;

class ClasseCoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                'day' => 'required',
                'name' => 'required',
                'start_hour' => 'required',
                'end_hour' => 'required',
                'class' => 'required',
            ]);

            $classeCours = new ClasseCours();
            $classeCours->name = $request->name;
            $classeCours->classe_id = $request->class;
            $classeCours->day = $request->day;
            $classeCours->start_Hour = $request->start_hour;
            $classeCours->end_Hour = $request->end_hour;
            $classeCours->save();
            return redirect()->back()->with('message','Nouvel emploi de temps ajouté !!');            
        }catch(\Exception $e){
            return redirect()->back()->with('message','Erreur Innatendue !!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClasseCours $classeCours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClasseCours $classeCours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClasseCours $classeCours)
    {
        try{
            $request->validate([
                'day' => 'required',
                'name' => 'required',
                'start_hour' => 'required',
                'end_hour' => 'required',
                'class' => 'required',
            ]);

            $classeCours->name = $request->name;
            $classeCours->classe_id = $request->class;
            $classeCours->day = $request->day;
            $classeCours->start_Hour = $request->start_hour;
            $classeCours->end_Hour = $request->end_hour;
            $classeCours->save();
            return redirect()->back()->with('message','Emploi de temps edité !!');            
        }catch(\Exception $e){
            return redirect()->back()->with('message','Erreur Innatendue !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClasseCours $classeCours)
    {
        try{
            $classeCours->status = 0;
            $classeCours->save();
        }catch(\Exception $e)
        {
            return redirect()->back()->with('message','Erreur innatendue !!');
        }
    }
}
