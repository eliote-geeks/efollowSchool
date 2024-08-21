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
        $totalAbsences = Absence::whereBetween('created_at', [$start, $end])->count();
        $totalPresences = Presence::whereBetween('created_at', [$start, $end])->count();
        $totalMoratoires = Moratoire::where('school_information_id', $this->schoolInformation->id)->count();
        $totalScolarites = Scolarite::where('school_information_id', $this->schoolInformation->id)->sum('amount');
        $weeklyAbsences = Absence::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->selectRaw('DAYNAME(created_at) as day, COUNT(*) as count')
            ->groupBy('day')
            ->pluck('count', 'day');

        // Plus de statistiques par exemple, par mois, par semaine, etc.
        $monthlyPayments = Payment::where('school_information_id', $this->schoolInformation->id)
            ->whereDate('created_at', '>=', now()->startOfMonth())
            ->whereDate('created_at', '<=', now()->endOfMonth())
            ->sum('amount');

        $weeklyPayments = Payment::where('school_information_id', $this->schoolInformation->id)
            ->whereDate('created_at', '>=', now()->startOfWeek())
            ->whereDate('created_at', '<=', now()->endOfWeek())
            ->sum('amount');

        return view('dashboard', compact('totalStudents', 'weeklyAbsences', 'totalPayments', 'totalRemises', 'totalAbsences', 'totalPresences', 'totalMoratoires', 'totalScolarites', 'monthlyPayments', 'weeklyPayments'));
    }
}
