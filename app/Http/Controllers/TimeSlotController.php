<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TimeSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timeslots = TimeSlot::all();
        return view('creneau.index', compact('timeslots'));
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
        $request->validate(
            [
                'start_time' => [
                    'required',
                    'date_format:H:i',
                    Rule::unique('time_slots')->where(function ($query) use ($request) {
                        return $query->where('start_time', $request->start_time)->where('end_time', $request->end_time);
                    }),
                ],
                'end_time' => 'required|date_format:H:i|after:start_time',
            ],
            [
                'start_time.unique' => 'Ce créneau horaire existe déjà.',
            ],
        );

        $timeslot = new TimeSlot();
        $timeslot->start_time = $request->start_time;
        $timeslot->end_time = $request->end_time;
        $timeslot->save();

        return redirect()->route('timeslots.index')->with('success', 'Créneau horaire créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TimeSlot $timeSlot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimeSlot $timeSlot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TimeSlot $timeSlot)
    {
        $request->validate(
            [
                'start_time' => [
                    'required',
                    'date_format:H:i',
                    Rule::unique('time_slots')->where(function ($query) use ($request, $timeSlot) {
                        return $query
                            ->where('start_time', $request->start_time)
                            ->where('end_time', $request->end_time)
                            ->where('id', '!=', $timeSlot->id); // Exclure l'ID actuel de la vérification
                    }),
                ],
                'end_time' => 'required|date_format:H:i|after:start_time',
            ],
            [
                'start_time.unique' => 'Ce créneau horaire existe déjà.',
            ],
        );

        $timeSlot->update($request->all());

        return redirect()->route('timeslots.index')->with('success', 'Créneau horaire mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeSlot $timeSlot)
    {
        $timeSlot->delete();

        return redirect()->route('timeslots.index')->with('success', 'Créneau horaire supprimé avec succès.');
    }
}
