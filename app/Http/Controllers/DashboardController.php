<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Presence;
use App\Models\Moratoire;
use App\Models\remiseDue;
use App\Models\Scolarite;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalStudents = Student::count();
        $totalPayments = Payment::sum('amount');
        $totalRemises = remiseDue::sum('rest');
        $totalAbsences = Absence::count();
        $totalPresences = Presence::count();
        $totalMoratoires = Moratoire::count();
        $totalScolarites = Scolarite::sum('amount');
        $weeklyAbsences = Absence::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->selectRaw('DAYNAME(created_at) as day, COUNT(*) as count')
            ->groupBy('day')
            ->pluck('count', 'day');

        // Plus de statistiques par exemple, par mois, par semaine, etc.
        $monthlyPayments = Payment::whereMonth('created_at', now()->month)->sum('amount');
        $weeklyPayments = Payment::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('amount');

        return view('dashboard', compact('totalStudents','weeklyAbsences', 'totalPayments', 'totalRemises', 'totalAbsences', 'totalPresences', 'totalMoratoires', 'totalScolarites', 'monthlyPayments', 'weeklyPayments'));
    }
}
