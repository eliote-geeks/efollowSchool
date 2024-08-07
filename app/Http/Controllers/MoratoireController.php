<?php

namespace App\Http\Controllers;

use App\Models\Moratoire;
use App\Models\SchoolInformation;
use Illuminate\Http\Request;

class MoratoireController extends Controller
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
                'scolarite' => 'required',
                'students' => 'required|array',
                'name' => 'required',
                'end_date' => 'required',
                'file_path' => 'required',
            ]);

            foreach ($request->students as $stu) {
                if (
                    Moratoire::where([
                        'school_information_id' => SchoolInformation::where('status', 1)->latest()->first()->id,
                        'student_id' => $stu,
                    ])->count() == 0
                ) {
                    $moratoire = new Moratoire();
                    $moratoire->scolarite_id = $request->scolarite;
                    $moratoire->student_id = $stu;
                    $moratoire->name = $request->name;
                    $moratoire->end_date = $request->end_date;
                    $moratoire->file_path = $request->file_path->store('moratoires', 'public');
                    $moratoire->school_information_id = SchoolInformation::where('status', 1)->latest()->first()->id;
                    $moratoire->save();
                } else {
                    return redirect()->back()->with('message', 'Oups cet etudiant dispose deja d\'un moratoire !!');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Oups erreur innatendue !!');
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
                'students' => 'required|array',
                'name' => 'required',
                'end_date' => 'required',
                'file_path' => 'required',
            ]);

            foreach ($request->students as $stu) {
                if (
                    Moratoire::where([
                        'school_information_id' => SchoolInformation::where('status', 1)->latest()->first()->id,
                        'student_id' => $stu,
                    ])->count() == 0
                ) {
                    $moratoire->scolarite_id = $request->scolarite;
                    $moratoire->student_id = $stu;
                    $moratoire->name = $request->name;
                    $moratoire->end_date = $request->end_date;
                    $moratoire->file_path = $request->file_path->store('moratoires', 'public');
                    $moratoire->school_information_id = SchoolInformation::where('status', 1)->latest()->first()->id;
                    $moratoire->save();
                } else {
                    return redirect()->back()->with('message', 'Oups cet etudiant dispose deja d\'un moratoire !!');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Oups erreur innatendue !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moratoire $moratoire)
    {
        //
    }
}
