<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Scolarite;
use Illuminate\Http\Request;
use App\Models\SchoolInformation;

class ScolariteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $scolarites = Scolarite::where([
                'school_information_id' => SchoolInformation::where('status', 1)->first()->id,
                // 'status' => 1
            ])->get();
            $niveaux = Niveau::where([
                'school_information_id' => SchoolInformation::where('status', 1)->first()->id,
                'status' => 1,
            ])->get();

            return view('scolarité.scolarité', [
                'scolarites' => $scolarites,
                'niveaux' => $niveaux,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Impossible d\'acceder à cette page si une annéé n\'est pas fonctionnelle');
        }
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
                // 'tranche' => 'nullable',
                'name' => 'required',
                'amount' => 'required',
                // 'tranche' => 'required',
                'end_date' => 'required|date',
                'niveaux' => 'required|array',
                'niveaux.*' => 'exists:niveaux,id',
            ]);

            $str = str_replace(' ', '', $request->amount);

            $number = (float) $str;

            $schoolInformation = SchoolInformation::where('status', 1)->first();
            $user = auth()->user();

            if (Scolarite::where('school_information_id', $schoolInformation->id)->count() > 0) {
                $lastScolarite = Scolarite::where('school_information_id', $schoolInformation->id)
                    ->latest()
                    ->first();
                if (Carbon::parse($lastScolarite->end_date) > $request->end_date) {
                    return redirect()->back()->with('error', 'La date limite de ce frais doit venir apres celle du frais precédent');
                }
            }

            $tranche = $request->tranche == null ? '//' : $request->tranche;
            if (
                Scolarite::where([
                    'name' => $request->name,
                    'niveaux' => json_encode($request->niveaux),
                ])->count() == 0
            ) {
                $scolarite = new Scolarite();
                $scolarite->school_information_id = $schoolInformation->id;
                $scolarite->user_id = $user->id;
                $scolarite->niveaux = json_encode($request->niveaux);
                $scolarite->tranche = $tranche;
                $scolarite->end_date = $request->end_date;
                $scolarite->name = $request->name;
                $scolarite->amount = $number;
                $scolarite->uniqid = str_pad($user->id, 9, '0', STR_PAD_LEFT);
                $scolarite->save();
                User::log('Scolarité enregistré: Nom: ' . $scolarite->name . ' Montant: ' . number_format($scolarite->amount));

                return redirect()->back()->with('success', 'Frais AJouté');
            } else {
                return redirect()->back()->with('warning', 'Frais déja existant');
            }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('warning', 'Oups une erreur s\'est produite !!: ' . $e->getMessage());
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
                'name' => 'required',
                'amount' => 'required',
                'end_date' => 'required|date',
                'niveaux' => 'required|array',
                'niveaux.*' => 'exists:niveaux,id',
            ]);
            $str = str_replace(' ', '', $request->amount);

            $number = (float) $str;

            // $schoolInformation = SchoolInformation::where('status', 1)->first();
            $user = auth()->user();

            $tranche = $request->tranche == null || $request->tranche == 0 ? '//' : $request->tranche;

            // $scolarite->school_information_id = $schoolInformation->id;
            $scolarite->user_id = $user->id;
            $scolarite->niveaux = json_encode($request->niveaux);
            $scolarite->tranche = $tranche;
            $scolarite->end_date = $request->end_date;
            $scolarite->name = $request->name;
            $scolarite->amount = $number;
            // $scolarite->uniqid = str_pad($user->id, 9, '0', STR_PAD_LEFT);
            $scolarite->save();
            User::log('Scolarité modifié: Nom: ' . $scolarite->name . ' Montant: ' . number_format($scolarite->amount));
            return redirect()->back()->with('success', 'Frais Edité');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Oups une erreur s\'est produite : !!' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scolarite $scolarite)
    {
        try {
            User::log('Scolarité Détruite: Nom: '.$scolarite->name.' Montant: '.number_format($scolarite->amount));
            $scolarite->delete();
            return redirect()->back()->with('success', 'Scolarité Supprimé !! ');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Erreur innatendue !!');
        }
    }
}
