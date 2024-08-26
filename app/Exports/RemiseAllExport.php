<?php

namespace App\Exports;

use App\Models\remiseDue;
use App\Models\SchoolInformation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RemiseAllExport implements FromView
{
    protected $schoolInformation;

    public function __construct()
    {
        $this->schoolInformation = SchoolInformation::where('status',1)->first();
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $remises = remiseDue::where('school_information_id',$this->schoolInformation->id)->get();
        return view('export.remise',compact('remises'));   
    }
}
