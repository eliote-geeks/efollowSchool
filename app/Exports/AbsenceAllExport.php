<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Absence;
use App\Models\SchoolInformation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsenceAllExport implements FromView
{
    protected $schoolInformation;

    public function __construct()
    {
        $this->schoolInformation = SchoolInformation::where('status', 1)->first();
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $start = Carbon::parse($this->schoolInformation->start)->format('Y');
        $end = Carbon::parse($this->schoolInformation->end)->format('Y');
        $absences = Absence::whereBetween('created_at', [$start, $end])->get();
        return view('export.absence', compact('absences'));
    }
}
