<?php

namespace App\Exports;

use App\Models\Payment;
use App\Models\SchoolInformation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentAllExport implements FromView
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
        $payments = Payment::where('school_information_id',$this->schoolInformation->id)->get();
        return view('export.payment',compact('payments'));
    }
}
