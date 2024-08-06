<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SchoolInformation;

class SchoolInformationController extends Controller
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
        try {
            if(SchoolInformation::count() > 0){
                return redirect()->back()->with('message','Cette école existe deja !!');
            }
            $request->validate([
                'start_date' => 'required|date',
                'logo' => 'required|image',
                'name' => 'required|string|max:150',
                'matricular' => 'required|string',
                'fillPath' => 'required|boolean',
                'end_date' => 'required|date|after:start',
                'recto_path' => 'image|nullable',
                'verso_path' => 'image|nullable',
            ],
            [
                'start_date.required' => 'le champ designant l\'année de debut ne peut rester vide',
                'start_date.date' => 'le champ designant l\'année de debut doit etre une date valide',
                'end_date.required' => 'le champ designant l\'année de fin ne peut rester vide',
                'end_date.date' => 'le champ designant l\'année de fin doit etre une date valide',
                'name.required' => 'Le nom de l\'établissement doit etre renseigné',
                'name.string' => 'Le nom de l\'établissement doit etre un simple intitulé',
                'logo.required' => 'Le logo de l\'établissement doit etre renseigné',
                'logo.image' => 'Le logo de l\'établissement doit etre une image',
                'matricular.required' => 'Le masque de matricule doit etre renseigné',
                'fillPath.required' => 'veuiller selectionner si oui ou non vous desirez imprimer vous vos informations',
                'verso_path.image' => 'Le verso de l\'établissement doit etre une image',
                'recto_path.image' => 'Le recto de l\'établissement doit etre une image',
            ]);

            
            $school = new SchoolInformation();
            $school->start = Carbon::parse('start');
            $school->end = Carbon::parse('end');
            $school->name = $request->name;
            $school->matricular = $request->matricular;
            $school->logo = 'storage/' . $request->logo->store('logoSchool', 'public');
            if ($request->fillPath == 'on') {
                $school->verso_path = 'storage/' . $request->verso_path->store('verso_path', 'public');
                $school->recto_path = 'storage/' . $request->recto_path->store('recto_path', 'public');
            }
            $school->save();
            return response()->json(['message' => 'Event created successfully', 'event' => $school], 201);
        } catch (\Exception $e) {
            return redirect()->back()->with('message','Oups une erreur s\'est produite veuillez reesayer: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolInformation $schoolInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolInformation $schoolInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolInformation $schoolInformation)
    {
        try {
            $request->validate([
                'start_date' => 'required|date',
                'logo' => 'required|image',
                'name' => 'required|string|max:150',
                'matricular' => 'required|string',
                'fillPath' => 'required|boolean',
                'end_date' => 'required|date|after:start',
                'recto_path' => 'image|nullable',
                'verso_path' => 'image|nullable',
            ],
            [
                'start_date.required' => 'le champ designant l\'année de debut ne peut rester vide',
                'start_date.date' => 'le champ designant l\'année de debut doit etre une date valide',
                'end_date.required' => 'le champ designant l\'année de fin ne peut rester vide',
                'end_date.date' => 'le champ designant l\'année de fin doit etre une date valide',
                'name.required' => 'Le nom de l\'établissement doit etre renseigné',
                'name.string' => 'Le nom de l\'établissement doit etre un simple intitulé',
                'logo.required' => 'Le logo de l\'établissement doit etre renseigné',
                'logo.image' => 'Le logo de l\'établissement doit etre une image',
                'matricular.required' => 'Le masque de matricule doit etre renseigné',
                'fillPath.required' => 'veuiller selectionner si oui ou non vous desirez imprimer vous vos informations',
                'verso_path.image' => 'Le verso de l\'établissement doit etre une image',
                'recto_path.image' => 'Le recto de l\'établissement doit etre une image',
            ]);

            
            $schoolInformation->start = Carbon::parse('start');
            $schoolInformation->end = Carbon::parse('end');
            $schoolInformation->name = $request->name;
            $schoolInformation->matricular = $request->matricular;
            $schoolInformation->logo = 'storage/' . $request->logo->store('logoSchool', 'public');
            if ($request->fillPath == 'on') {
                $schoolInformation->verso_path = 'storage/' . $request->verso_path->store('verso_path', 'public');
                $schoolInformation->recto_path = 'storage/' . $request->recto_path->store('recto_path', 'public');
            }
            $schoolInformation->save();
            return ;
        } catch (\Exception $e) {
            return redirect()->back()->with('message','Oups une erreur s\'est produite veuillez reesayer: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolInformation $schoolInformation)
    {
        try{
            $schoolInformation->status = 0;
            // select all table passe status a 0
            $schoolInformation->save();
        }catch(\Exception $e)
        {
            return redirect()->back()->with('message','Oups une erreur s\'est produite veuillez reesayer: '.$e->getMessage()); 
        }
    }
}
