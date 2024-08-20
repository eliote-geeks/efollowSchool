<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Classe;
use App\Models\EndSchedule;
use App\Models\Teacher;
use App\Models\Schedule;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use App\Models\SchoolInformation;

class ScheduleController extends Controller
{
    protected $schoolInformation;

    public function __construct()
    {
        $this->schoolInformation = SchoolInformation::where('status', 1)->first();
    }
    public function scheduleCLass(Classe $classe)
    {
        $schoolInformation = $this->schoolInformation;
        $timeSlots = TimeSlot::where('classe_id', $classe->id)->get();
        $teachers = Teacher::where('school_information_id', $this->schoolInformation->id)
            ->latest()
            ->get();
        $schedules = Schedule::where('classe_id', $classe->id)
            ->with(['classe', 'timeSlot'])
            ->get();
        return view('schedules.index', compact('schedules', 'classe', 'timeSlots', 'teachers', 'schoolInformation'));
    }

    public function attendanceStudent(Schedule $schedule)
    {
        $endSchedule = EndSchedule::where('schedule_id', $schedule->id)->count();
        $currentDay = Carbon::now()->format('l'); // 'l' retourne le jour en anglais, par ex: 'Monday'
        if ($currentDay === $schedule->day_of_week) {
            if ($endSchedule == 0) {
                if(!Carbon::parse($schedule->timeSlot->start_time)->gte(now())){
                    return view('student.card.attendance', [
                        'schedule' => $schedule,
                    ]);
                }else{
                    return redirect()->back()->with('error','Veuillez patientez le debut du cours pour effectuez l\'appel!! ');
                }
            } else {
                return redirect()->back()->with('error', 'L\'appel a déja été effectué pour ce créneau !!');
            }
        } else {
            return redirect()->back()->with('error', 'L\'appel ne peut etre effectué le jour ne correspond pas!!');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            // 'class_id' => 'required|exists:classes,id',
            'subject' => 'required|string',
            'time_slot_id' => 'required|exists:time_slots,id',
            'day_of_week' => 'required|string',
            'teacher' => 'required',
        ]);

        $schedule = new Schedule();
        $schedule->classe_id = $request->class_id;
        $schedule->time_slot_id = $request->time_slot_id;
        $schedule->day_of_week = $request->day_of_week;
        $schedule->subject = $request->subject;
        $schedule->teacher_id = $request->teacher;
        $schedule->save();

        return redirect()->back()->with('success', 'Emploi du temps créé avec succès');
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
            // 'class_id' => 'required|exists:classes,id',
            // 'subject_id' => 'required|exists:subjects,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'day_of_week' => 'required|string',
            'subject' => 'required|string',
            'teacher' => 'required',
        ]);

        // $schedule->classe_id = $request->class_id;
        $schedule->time_slot_id = $request->time_slot_id;
        $schedule->day_of_week = $request->day_of_week;
        $schedule->subject = $request->subject;
        $schedule->teacher_id = $request->teacher;
        $schedule->save();

        return redirect()->back()->with('success', 'Emploi du temps mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('success', 'Emploi du temps supprimé avec succès');
    }
}
