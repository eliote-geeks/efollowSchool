<?php

namespace App\Http\Controllers;

use App\Models\SchoolInformation;
use App\Models\Scolarite;
use Illuminate\Http\Request;

class ScolariteController extends Controller
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
            $request->validate([
                'tranche' => 'required',
                'name' => 'required',
                'amount' => 'required',
                'tranche' => 'required',
                'end_date' => 'required|date',
                'niveaux' => 'required|array',
                'niveaux.*' => 'exists:niveaux,id',
            ]);

            $str = str_replace(',', '', $request->amount);

            $number = (float) $str;

            $schoolInformation = SchoolInformation::where('status',1)->first();
            $user = auth()->user();

            foreach ($request->niveaux as $niveau) {
                if (
                    Scolarite::where([
                        'school_information_id' => $schoolInformation->id,
                        'niveau_id' => $niveau,
                    ])->count() == 0
                ) {
                    $scolarite = new Scolarite();
                    $scolarite->school_information_id = $schoolInformation->id;
                    $scolarite->user_id = $user->id;
                    $scolarite->niveau_id = $niveau;
                    $scolarite->tranche = $request->tranche;
                    $scolarite->end_date = $request->end_date;
                    $scolarite->name = $request->name;
                    $scolarite->amount = $number;
                    $scolarite->uniqid = str_pad($user->id, 9, uniqid(), STR_PAD_LEFT);
                    $scolarite->save();
                } else {
                    $scolarite = Scolarite::where([
                        'school_information_id' => $schoolInformation->id,
                        'niveau_id' => $niveau,
                    ])->first();
                    $scolarite->niveau_id = $niveau;
                    $scolarite->tranche = $request->tranche;
                    $scolarite->end_date = $request->end_date;
                    $scolarite->name = $request->name;
                    $scolarite->amount = $number;
                    $scolarite->save();
                }
            }

            return redirect()->back()->with('message', 'Pension AJouté');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Oups une erreur s\'est produite !!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Scolarite $scolarite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scolarite $scolarite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scolarite $scolarite)
    {
        try {
            $request->validate([
                'tranche' => 'required',
                'name' => 'required',
                'amount' => 'required',
                'tranche' => 'required',
                'end_date' => 'required|date',
                'niveaux' => 'required|array',
                'niveaux.*' => 'exists:niveaux,id',
            ]);

            $str = str_replace(',', '', $request->amount);

            $number = (float) $str;

            $schoolInformation = SchoolInformation::where('status',1)->first();
            $user = auth()->user();

            foreach ($request->niveaux as $niveau) {
                if (
                    Scolarite::where([
                        'school_information_id' => $schoolInformation->id,
                        'niveau_id' => $niveau,
                    ])->count() > 0
                ) {
                    $scolarite->school_information_id = $schoolInformation->id;
                    $scolarite->user_id = $user->id;
                    $scolarite->niveau_id = $niveau;
                    $scolarite->tranche = $request->tranche;
                    $scolarite->end_date = $request->end_date;
                    $scolarite->name = $request->name;
                    $scolarite->amount = $number;
                    $scolarite->save();
                } else {
                    $scolarite = new Scolarite();
                    $scolarite->school_information_id = $schoolInformation->id;
                    $scolarite->user_id = $user->id;
                    $scolarite->niveau_id = $niveau;
                    $scolarite->tranche = $request->tranche;
                    $scolarite->end_date = $request->end_date;
                    $scolarite->name = $request->name;
                    $scolarite->amount = $number;
                    $scolarite->uniqid = str_pad($user->id, 9, uniqid(), STR_PAD_LEFT);
                    $scolarite->save();
                }
            }
            return redirect()->back()->with('message', 'Pension Edité');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Oups une erreur s\'est produite !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scolarite $scolarite)
    {
        try{
            $scolarite->delete();
        }catch(\Exception $e)
        {
            return redirect()->back()->with('message','Erreur innatendue !!');
        }
    }
}
