<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Schedule;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::all();
        $timeSlots = TimeSlot::all();
        $schedules = Schedule::with(['classe', 'timeSlot'])->get();
        return view('schedules.index', compact('schedules', 'classes', 'timeSlots'));
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
        $validatedData = $request->validate([
            'class_id' => 'required|exists:classes,id',
            // 'subject_id' => 'required|exists:subjects,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'day_of_week' => 'required|string',
        ]);

        $schedule = new Schedule();
        $schedule->classe_id = $request->class_id;
        $schedule->time_slot_id = $request->time_slot_id; 
        $schedule->day_of_week = $request->day_of_week;
        $schedule->subject = 'mliel';
        $schedule->teacher_id = 1;
        $schedule->save();

        return redirect()->route('schedules.index')->with('success', 'Emploi du temps créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validatedData = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'day_of_week' => 'required|string',
        ]);

        $schedule->update($validatedData);

        return redirect()->route('schedules.index')->with('success', 'Emploi du temps mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Emploi du temps supprimé avec succès');
    }
}
