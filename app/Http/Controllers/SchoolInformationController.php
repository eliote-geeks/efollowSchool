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
        $schoolInformations = SchoolInformation::latest()->get();
        return view('school-information.school-information', [
            'schoolInformations' => $schoolInformations,
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
                    'start' => 'required|date',
                    'logo' => 'required|image',
                    'verso_path' => 'required|image',
                    'recto_path' => 'required|image',
                    'tel_school' => 'required',
                    'name' => 'required|string|max:150',
                    'matricular' => 'required',
                    // 'fillPath' => 'required',
                    'end' => 'required|date|after:start',
                    // 'recto_path' => 'image|nullable',
                    // 'verso_path' => 'image|nullable',
                ],
                [
                    'start.required' => 'le champ designant l\'année de debut ne peut rester vide',
                    'start.date' => 'le champ designant l\'année de debut doit etre une date valide',
                    'end.required' => 'le champ designant l\'année de fin ne peut rester vide',
                    'end.date' => 'le champ designant l\'année de fin doit etre une date valide',
                    'name.required' => 'Le nom de l\'établissement doit etre renseigné',
                    'name.string' => 'Le nom de l\'établissement doit etre un simple intitulé',
                    'logo.required' => 'Le logo de l\'établissement doit etre renseigné',
                    'logo.image' => 'Le logo de l\'établissement doit etre une image',
                    'matricular.required' => 'Le masque de matricule doit etre renseigné',
                    'fillPath.required' => 'veuiller selectionner si oui ou non vous desirez imprimer vous vos informations',
                    'end.after' => 'l\'année  de fin doit venir apres l\'année de debut',
                    // 'verso_path.image' => 'Le verso de l\'établissement doit etre une image',
                    // 'recto_path.image' => 'Le recto de l\'établissement doit etre une image',
                ],
            );

            $start = Carbon::parse($request->start);
            $end = Carbon::parse($request->end);

            if (SchoolInformation::where('status', 1)->count() > 0) {
                return redirect()->back()->with('error', 'Une année est déja active !!');
            }

            if ($start->diffInMonths($end) >= 11) {
                return redirect()->back()->with('error', 'L\'intervalle entre les dates ne doit pas dépasser 11 mois');
            }

            $school = new SchoolInformation();
            $school->start = $request->start;
            $school->end = $request->end;
            $school->name = $request->name;
            $school->poBox = $request->poBox;
            $school->tel_school = $request->tel_school;
            $school->matricular = $request->matricular;
            $school->logo = 'storage/' . $request->logo->store('logoSchool', 'public');
            $school->verso_path = 'storage/' . $request->verso_path->store('verso_path', 'public');
            $school->recto_path = 'storage/' . $request->recto_path->store('recto_path', 'public');
            if ($request->fillPath == 'on') {
                // $request->validate([
                //     'verso_path' => 'required|image',
                //     'recto_path' => 'required|image',
                // ]);
                $school->fillPath = 1;
            }
            $school->save();
            return redirect()->back()->with('success', 'Nouvelle année ajoutée avec success !!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Oups une erreur s\'est produite veuillez reesayer: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolInformation $schoolInformation)
    {
        //
    }

    /** * Show the form for editing the specified resource.
     */ public function edit(SchoolInformation $schoolInformation)
    {
        //
    }
    //
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolInformation $schoolInformation)
    {
        try {
            $request->validate(
                [
                    'tel_school' => 'required',
                    'name' => 'required|string|max:150',
                    'matricular' => 'required',
                    'poBox' => 'required',
                    'start' => 'required|date',
                    'end' => 'required|date|after:start',
                ],
                [
                    'start.required' => 'le champ designant l\'année de debut ne peut rester vide',
                    'start.date' => 'le champ designant l\'année de debut doit etre une date valide',
                    'end.required' => 'le champ designant l\'année de fin ne peut rester vide',
                    'end.date' => 'le champ designant l\'année de fin doit etre une date valide',
                    'name.required' => 'Le nom de l\'établissement doit etre renseigné',
                    'name.string' => 'Le nom de l\'établissement doit etre un simple intitulé',
                    'matricular.required' => 'Le masque de matricule doit etre renseigné',
                    'fillPath.required' => 'veuiller selectionner si oui ou non vous desirez imprimer vous vos informations',
                    'end.after' => 'l\'année  de fin doit venir apres l\'année de debut',
                    'start.required' => 'le champ designant l\'année de debut ne peut rester vide',
                    'start.date' => 'le champ designant l\'année de debut doit etre une date valide',
                    'end.required' => 'le champ designant l\'année de fin ne peut rester vide',
                    'end.date' => 'le champ designant l\'année de fin doit etre une date valide',
                    'end.after' => 'l\'année  de fin doit venir apres l\'année de debut',
                ],
            );

            $start = Carbon::parse($request->start);
            $end = Carbon::parse($request->end);

            if ($start->diffInMonths($end) >= 11) {
                return redirect()->with('error', 'L\'intervalle entre les dates ne doit pas dépasser 11 mois');
            }
            $schoolInformation->start = $request->start;
            $schoolInformation->end = $request->end;
            $schoolInformation->name = $request->name;
            $schoolInformation->poBox = $request->poBox;
            $schoolInformation->tel_school = $request->tel_school;
            $schoolInformation->matricular = $request->matricular;

            if ($request->logo) {
                $schoolInformation->logo = 'storage/' . $request->logo->store('logoSchool', 'public');
            }

            if ($request->verso_path) {
                $schoolInformation->verso_path = 'storage/' . $request->verso_path->store('verso_path', 'public');
            }

            if ($request->recto_path) {
                $schoolInformation->recto_path = 'storage/' . $request->recto_path->store('recto_path', 'public');
            }

            if ($request->fillPath == 'on') {
                // $request->validate([
                //     'verso_path' => 'required|image',
                //     'recto_path' => 'required|image',
                // ]);
                $schoolInformation->fillPath = 1;
            }
            $schoolInformation->save();
            return redirect()->back()->with('success', 'Modifié avec success !!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Oups une erreur s\'est produite veuillez reesayer: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolInformation $schoolInformation)
    {
        try {
            if (SchoolInformation::where('status', 1)->count() > 0) {
                $sc = SchoolInformation::where('status', 1)->first();
                $sc->status = 0;
                $sc->save();
            }

            if ($schoolInformation->status == 1) {
                $schoolInformation->status = 0;
            } else {
                $schoolInformation->status = 1;
            }
            $schoolInformation->save();
            return redirect()->back()->with('message', 'Status changé !!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('message', 'Oups une erreur s\'est produite veuillez reesayer: ' . $e->getMessage());
        }
    }
}
