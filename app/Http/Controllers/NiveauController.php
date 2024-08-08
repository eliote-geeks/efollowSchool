<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Models\SchoolInformation;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::where('status', 1)->get();
        return view('niveau.niveau', [
            'niveaux' => $niveaux,
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
            $request->validate([
                'name' => 'required',
            ]);

            $schoolInformation = SchoolInformation::where('status', 1)->first();
            if (
                Niveau::where([
                    'name' => $request->name,
                    'school_information_id' => $schoolInformation->id,
                ])->count() == 0
            ) {
                $niveau = new Niveau();
                $niveau->name = $request->name;
                $niveau->school_information_id = $schoolInformation->id;
                $niveau->save();
                return redirect()->back()->with('message', 'Nouveau niveau ajouté !!');
            } else {
                return redirect()->back()->with('message', 'Ce niveau existe déja dans le système');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Une erreur s\' est produite !!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Niveau $niveau)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Niveau $niveau)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $schoolInformation = SchoolInformation::where('status', 1)->first();
            if (
                Niveau::where([
                    'name' => $request->name,
                    'school_information_id' => $schoolInformation->id,
                ])->count() == 0
            ) {
                $niveau->name = $request->name;
                $niveau->save();
                return redirect()->back()->with('message', 'Niveau Edité !!');
            } else {
                return redirect()->back()->with('message', 'Ce niveau existe déja dans le système');
            }
        } catch (\Exception $e) {
            return redirect()->route('schoolInformation.index', [
                'message' => 'Une erreur s\' est produite !!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        try {
            $niveau->status = 0;
            $niveau->save();
            return redirect()->back()->with('message', 'Niveau Retiré avec success !!');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Oups erreur innatendue s\'est produite !!');
        }
    }
}
