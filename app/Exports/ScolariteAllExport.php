<?php

namespace App\Exports;

use App\Models\Scolarite;
use App\Models\SchoolInformation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ScolariteAllExport implements FromView
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
        $scolarites = Scolarite::where('school_information_id',$this->schoolInformation->id)->get();
        return view('export.scolarite',compact('scolarites'));   
    }
}
