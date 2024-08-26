<?php

namespace App\Exports;

use App\Models\Moratoire;
use App\Models\SchoolInformation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class MoratoireAllExport implements FromView
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
        $moratoires = Moratoire::where('school_information_id',$this->schoolInformation->id)->get();
        return view('export.moratoire',compact('moratoires'));       
    }
}
