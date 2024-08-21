<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Classe;
use App\Models\Absence;
use App\Models\Presence;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\SchoolInformation;
use Illuminate\Http\Request;
use App\Models\StudentClasse;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    protected $schoolInformation;

    protected function __construct()
    {
        $this->schoolInformation = SchoolInformation::where('status',1)->first();
    }
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
        $students = StudentClasse::where([
            'classe_id' => $classe->id,
        ])->get();
        $courses = Schedule::where('classe_id', $classe->id)->get();
        $presences = Presence::where('classe_id', $classe->id)->get();
        return view('historique.appelPresence', compact('classe', 'courses', 'presences', 'students'));
    }

    public function historiqueAbsence(Classe $classe)
    {
        $students = StudentClasse::where([
            'classe_id' => $classe->id,
        ])->get();
        $courses = Schedule::where('classe_id', $classe->id)->get();
        $presences = Absence::where('classe_id', $classe->id)->get();
        return view('historique.appelAbsence', compact('classe', 'courses', 'presences', 'students'));
    }

    public function absencegenerateReport(Request $request, Classe $classe)
    {
        $request->validate([
            'period' => 'required|in:week,month,custom',
            // 'start_date' => 'required_if:period,custom|date',
            // 'end_date' => 'required_if:period,custom|date|after_or_equal:start_date',
        ]);

        $absences = [];
        // dd($request->all());

        if ($request->period == 'week') {
            $start_date = Carbon::now()->startOfWeek();
            $end_date = Carbon::now()->endOfWeek();
        } elseif ($request->period == 'month') {
            $start_date = Carbon::now()->startOfMonth();
            $end_date = Carbon::now()->endOfMonth();
        } elseif ($request->period == 'custom') {
            if ($request->has('start_date') && $request->has('end_date')) {
                $start_date = Carbon::parse($request->start_date);
                $end_date = Carbon::parse($request->end_date);
            } else {
                return back()->withErrors(['start_date' => 'La date de début est requise pour une période personnalisée.', 'end_date' => 'La date de fin est requise pour une période personnalisée.']);
            }
        } else {
            return back()->withErrors(['period' => 'La période sélectionnée n\'est pas valide.']);
        }

        if ($request->course) {
            $absences = DB::table('schedules')
                ->leftJoin('absences', 'absences.schedule_id', '=', 'schedules.id')
                ->selectRaw('absences.date date, schedules.day_of_week day_of_week, schedules.subject subject, schedules.teacher_id teacher, schedules.time_slot_id timeslot, absences.student_id student')
                ->where('schedules.classe_id', '=', $classe->id)
                ->where('schedules.subject', '=', $request->course)
                ->whereBetween('absences.date', [$start_date, $end_date])
                ->get();
        } elseif ($request->student) {
            $absences = DB::table('schedules')
                ->leftJoin('absences', 'absences.schedule_id', '=', 'schedules.id')
                ->selectRaw('absences.date date, schedules.day_of_week day_of_week, schedules.subject subject, schedules.teacher_id teacher, schedules.time_slot_id timeslot, absences.student_id student')
                ->where('schedules.classe_id', '=', $classe->id)
                ->where('absences.student_id', '=', $request->student)
                ->whereBetween('absences.date', [$start_date, $end_date])
                ->get();
        } elseif ($request->student && $request->course) {
            $absences = DB::table('schedules')
                ->leftJoin('absences', 'absences.schedule_id', '=', 'schedules.id')
                ->selectRaw('absences.date date, schedules.day_of_week day_of_week, schedules.subject subject, schedules.teacher_id teacher, schedules.time_slot_id timeslot, absences.student_id student')
                ->where('schedules.classe_id', '=', $classe->id)
                ->where('absences.student_id', '=', $request->student)
                ->where('schedules.subject', '=', $request->course)
                ->whereBetween('absences.date', [$start_date, $end_date])
                ->get();
        } else {
            $absences = DB::table('schedules')
                ->leftJoin('absences', 'absences.schedule_id', '=', 'schedules.id')
                ->selectRaw('absences.date date, schedules.day_of_week day_of_week, schedules.subject subject, schedules.teacher_id teacher, schedules.time_slot_id timeslot, absences.student_id student')
                ->where('schedules.classe_id', '=', $classe->id)
                ->whereBetween('absences.date', [$start_date, $end_date])
                ->get();
        }

        $pdf = PDF::loadView('historique.absencePdf', compact('absences', 'classe'), [
            'format' => 'A4',
            'orientation' => 'P',
        ]);
        return $pdf->download('absence-'.$classe->niveau->name.' '.$classe->name.'-'.Carbon::parse($this->schoolInformation->start)->format('Y').'-'.Carbon::parse($this->schoolInformation->end)->format('Y').'.pdf');
    }

    public function presencegenerateReport(Request $request, Classe $classe)
    {
        $request->validate([
            'period' => 'required|in:week,month,custom',
            // 'start_date' => 'required_if:period,custom|date',
            // 'end_date' => 'required_if:period,custom|date|after_or_equal:start_date',
        ]);

        $presences = [];

        if ($request->period == 'week') {
            $start_date = Carbon::now()->startOfWeek();
            $end_date = Carbon::now()->endOfWeek();
        } elseif ($request->period == 'month') {
            $start_date = Carbon::now()->startOfMonth();
            $end_date = Carbon::now()->endOfMonth();
        } elseif ($request->period == 'custom') {
            if ($request->has('start_date') && $request->has('end_date')) {
                $start_date = Carbon::parse($request->start_date);
                $end_date = Carbon::parse($request->end_date);
            } else {
                return back()->withErrors(['start_date' => 'La date de début est requise pour une période personnalisée.', 'end_date' => 'La date de fin est requise pour une période personnalisée.']);
            }
        } else {
            return back()->withErrors(['period' => 'La période sélectionnée n\'est pas valide.']);
        }

        if ($request->course) {
            $presences = DB::table('schedules')
                ->leftJoin('presences', 'presences.schedule_id', '=', 'schedules.id')
                ->selectRaw('presences.date date, schedules.day_of_week day_of_week, schedules.subject subject, schedules.teacher_id teacher, schedules.time_slot_id timeslot, presences.student_id student')
                ->where('schedules.classe_id', '=', $classe->id)
                ->where('schedules.subject', '=', $request->course)
                ->whereBetween('presences.date', [$start_date, $end_date])
                ->get();
        } elseif ($request->student) {
            $presences = DB::table('schedules')
                ->leftJoin('presences', 'absences.schedule_id', '=', 'schedules.id')
                ->selectRaw('presences.date date, schedules.day_of_week day_of_week, schedules.subject subject, schedules.teacher_id teacher, schedules.time_slot_id timeslot, presences.student_id student')
                ->where('schedules.classe_id', '=', $classe->id)
                ->where('presences.student_id', '=', $request->student)
                ->whereBetween('presences.date', [$start_date, $end_date])
                ->get();
        } elseif ($request->student && $request->course) {
            $presences = DB::table('schedules')
                ->leftJoin('presences', 'presences.schedule_id', '=', 'schedules.id')
                ->selectRaw('presences.date date, schedules.day_of_week day_of_week, schedules.subject subject, schedules.teacher_id teacher, schedules.time_slot_id timeslot, presences.student_id student')
                ->where('schedules.classe_id', '=', $classe->id)
                ->where('presences.student_id', '=', $request->student)
                ->where('schedules.subject', '=', $request->course)
                ->whereBetween('presences.date', [$start_date, $end_date])
                ->get();
        } else {
            $presences = DB::table('schedules')
                ->leftJoin('presences', 'presences.schedule_id', '=', 'schedules.id')
                ->selectRaw('presences.date date, schedules.day_of_week day_of_week, schedules.subject subject, schedules.teacher_id teacher, schedules.time_slot_id timeslot, presences.student_id student')
                ->where('schedules.classe_id', '=', $classe->id)
                ->whereBetween('presences.date', [$start_date, $end_date])
                ->get();
        }

        $pdf = PDF::loadView('historique.presencePdf', compact('absences', 'classe'), [
            'format' => 'A4',
            'orientation' => 'P',
        ]);
        return $pdf->download('presence-'.$classe->niveau->name.' '.$classe->name.'-'.Carbon::parse($this->schoolInformation->start)->format('Y').'-'.Carbon::parse($this->schoolInformation->end)->format('Y').'.pdf');
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
