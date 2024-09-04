<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Moratoire;
use App\Models\Scolarite;
use Illuminate\Http\Request;
use App\Models\SchoolInformation;
Use PDF;

class MoratoireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moratoires = Moratoire::where('school_information_id',SchoolInformation::where('status', 1)->latest()->first()->id)->get();
        $scolarites = Scolarite::where('school_information_id', SchoolInformation::where('status', 1)->latest()->first()->id)
        // ->where('end_date', '>', now())
        ->get();
        return view('moratoire.moratoire',[
            'moratoires' => $moratoires,
            'scolarites' => $scolarites
        ]);
    }

    public function downloadMoratoire(Moratoire $moratoire)
    {
        $pdf = Pdf::loadView('moratoire.pdf', compact('moratoire'));

        User::log('Impression moratoire !!');
        return $pdf->download('moratoire_' . $moratoire->name . '.pdf');
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
                'scolarite' => 'required',
                'student' => 'required',
                'name' => 'required',
                'duree' => 'required|integer',
            ]);

            if (
                Moratoire::where('school_information_id', SchoolInformation::where('status', 1)->latest()->first()->id)
                    ->where('student_id', $request->student)
                    ->where('end_date', '>', now())
                    ->count() == 0
            ) {
                $moratoire = new Moratoire();
                $moratoire->scolarite_id = $request->scolarite;
                $moratoire->student_id = $request->student;
                $moratoire->name = $request->name;
                $moratoire->end_date = Carbon::now()->addDays($request->duree);
                $moratoire->file_path = $request->reason->store('moratoires', 'public');
                $moratoire->school_information_id = SchoolInformation::where('status', 1)->latest()->first()->id;
                $moratoire->save();
                User::log('Enregistrement Moratoire');
                return redirect()->route('moratoire.index')->with('danger', 'Moratoire Crée pour l\'etudiant: '.$moratoire->student->first_name.' '.$moratoire->student->last_name);
            } else {
                return redirect()->back()->with('warning', 'Oups cet etudiant dispose deja d\'un moratoire !!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Oups erreur innatendue !!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Moratoire $moratoire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Moratoire $moratoire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Moratoire $moratoire)
    {
        try {
            $request->validate([
                'scolarite' => 'required',
                // 'student' => 'required',
                'name' => 'required',
                'duree' => 'required',
            ]);

            $moratoire->scolarite_id = $request->scolarite;
            // $moratoire->student_id = $request->student;
            $moratoire->name = $request->name;
            $moratoire->end_date = Carbon::now()->addDays($request->duree);
            // $moratoire->file_path = $request->reason->store('moratoires', 'public');
            $moratoire->school_information_id = SchoolInformation::where('status', 1)->latest()->first()->id;
            $moratoire->save();
            User::log('Mise à jour moratoire !!');
            return redirect()->back()->with('success', 'Moratoire mis à jour !!');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Oups erreur innatendue !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moratoire $moratoire)
    {
        try {
            $moratoire->delete();
            User::log('Suppression moratoire !!');
            return redirect()->back()->with('success', 'moratoire retiré !!');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Oups erreur innatendue !!');
        }
    }
}
