<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absence;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Presence;
use App\Models\Moratoire;
use App\Models\remiseDue;
use App\Models\Scolarite;
use Illuminate\Http\Request;
use App\Models\SchoolInformation;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $schoolInformation;

    public function __construct()
    {
        $this->schoolInformation = SchoolInformation::where('status', 1)->first();
    }

    public function dashboard()
    {
        $start = Carbon::parse($this->schoolInformation->start)->format('Y');
        $end = Carbon::parse($this->schoolInformation->end)->format('Y');
        $totalStudents = Student::where('school_information_id', $this->schoolInformation->id)->count();
        $totalPayments = Payment::where('school_information_id', $this->schoolInformation->id)->sum('amount');
        $totalRemises = remiseDue::where('school_information_id', $this->schoolInformation->id)->sum('rest');
        $totalAbsences = Absence::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $totalPresences = Presence::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $totalMoratoires = Moratoire::where('school_information_id', $this->schoolInformation->id)->count();
        $totalScolarites = Scolarite::where('school_information_id', $this->schoolInformation->id)->sum('amount');
        $weeklyAbsences = Absence::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->selectRaw('DAYNAME(created_at) as day, COUNT(*) as count')
            ->groupBy('day')
            ->pluck('count', 'day');

        $absencesW = Absence::select(DB::raw('DAYNAME(date) as day, COUNT(*) as total_absences'))
        ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])  // Utilisez 'date' au lieu de 'created_at'
        ->groupBy('day')
        ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
        ->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $absenceDataW = [];

        foreach ($days as $day) {
            $absenceForDay = $absencesW->firstWhere('day', $day);
            $absenceDataW[] = $absenceForDay ? $absenceForDay->total_absences : 0;
        }

        // Plus de statistiques par exemple, par mois, par semaine..
        $monthlyPayments = Payment::where('school_information_id', $this->schoolInformation->id)
            ->whereDate('created_at', '>=', now()->startOfMonth())
            ->whereDate('created_at', '<=', now()->endOfMonth())
            ->sum('amount');

        $weeklyPayments = Payment::where('school_information_id', $this->schoolInformation->id)
            ->whereDate('created_at', '>=', now()->startOfWeek())
            ->whereDate('created_at', '<=', now()->endOfWeek())
            ->sum('amount');

        $absencesByClass = Absence::select('classe_id', DB::raw('COUNT(*) as total_absences'))
        ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
        ->groupBy('classe_id')
        ->orderByDesc('total_absences')->get();

        // Récupérer les noms des classes et les totaux d'absences
        $classes = [];
        $absenceCounts = [];

        foreach ($absencesByClass as $absence) {
            $classes[] = $absence->classe->niveau->name . ' ' . $absence->classe->name; // Assurez-vous que la relation `classe` est définie dans votre modèle `Absence`
            $absenceCounts[] = $absence->total_absences;
        }

        $studentsLatePayments = DB::table('students')
            ->leftJoin('payments', 'students.id', '=', 'payments.student_id')
            ->rightJoin('scolarites', function ($join) {
                $join->on('students.school_information_id', '=', 'scolarites.school_information_id');
            })
            ->select('students.first_name as student_name', 'scolarites.name as scolarite_name', 'scolarites.end_date', DB::raw('IFNULL(SUM(payments.amount), 0) as total_paid'), 'scolarites.amount as total_due')
            ->groupBy('students.id', 'scolarites.id')
            ->havingRaw('total_paid < total_due')
            ->where('students.school_information_id', $this->schoolInformation->id)
            ->where('scolarites.school_information_id', $this->schoolInformation->id)
            ->where('scolarites.end_date', '<', Carbon::now())
            ->get();

        // Préparer les données pour le graphique
        $studentNames = [];
        $lateAmounts = [];
        $scolariteNames = [];

        foreach ($studentsLatePayments as $payment) {
            $studentNames[] = $payment->student_name ? $payment->student_name . ' (' . $payment->scolarite_name . ')' : $payment->scolarite_name;
            $lateAmounts[] = $payment->total_due - $payment->total_paid;
        }

        foreach ($studentsLatePayments as $payment) {
            $studentNames[] = $payment->student_name;
            $lateAmounts[] = $payment->total_due - $payment->total_paid;
        }

        // Passer les données à la vue

        $classes = $classes;
        $absenceCounts = $absenceCounts;
        $studentNames = $studentNames;
        $lateAmounts = $lateAmounts;

        $years = SchoolInformation::all();
        $school = $this->schoolInformation;
        return view('dashboard', compact('lateAmounts', 'studentNames', 'classes', 'absenceCounts', 'years', 'school', 'totalStudents', 'weeklyAbsences', 'totalPayments', 'totalRemises', 'totalAbsences', 'totalPresences', 'totalMoratoires', 'totalScolarites', 'monthlyPayments', 'weeklyPayments', 'absenceDataW'));
    }
}




