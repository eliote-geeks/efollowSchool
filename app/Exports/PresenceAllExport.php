<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Presence;
use App\Models\SchoolInformation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class PresenceAllExport implements FromView
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
        $start = $this->schoolInformation->start;
        $end = $this->schoolInformation->end;
        $presences = Presence::whereBetween('date', [$start, $end])->get();
        return view('export.presence', compact('presences'));
    }
}
