<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Attendance;
use App\Models\Presence;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function printDay()
    {
        $today = \Carbon\Carbon::today();
        $attendances = Attendance::whereDate('created_at', $today)->get();

        return view('attendance.print_day', compact('attendances'));
    }

    public function printWeek()
    {
        $weekStart = \Carbon\Carbon::now()->startOfWeek();
        $weekEnd = \Carbon\Carbon::now()->endOfWeek();
        $attendances = Attendance::whereBetween('created_at', [$weekStart, $weekEnd])->get();

        return view('attendance.print_week', compact('attendances'));
    }

    public function printMonth()
    {
        $monthStart = \Carbon\Carbon::now()->startOfMonth();
        $monthEnd = \Carbon\Carbon::now()->endOfMonth();
        $attendances = Attendance::whereBetween('created_at', [$monthStart, $monthEnd])->get();

        return view('attendance.print_month', compact('attendances'));
    }

    public function printPeriod(Request $request)
    {
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $attendances = Attendance::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('attendance.print_period', compact('attendances', 'startDate', 'endDate'));
    }

    public function historiquePresence(Classe $classe)
    {
        $courses = Schedule::where('classe_id',$classe->id)->get();
        $presences = Presence::where('classe_id',$classe->id)->get();
        return view('historique.appelPresence',compact('classe','courses','presences'));
    }

    public function historiqueAbsence(Classe $classe)
    {
        return view('historique.appelAbsence',compact('classe'));
    }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
