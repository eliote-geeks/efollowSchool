<?php

namespace App\Exports;

use App\Models\Payment;
use App\Models\SchoolInformation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentMonthExport implements FromView
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
        $payments = Payment::where('school_information_id', $this->schoolInformation->id)
            ->whereDate('created_at', '>=', now()->startOfMonth())
            ->whereDate('created_at', '<=', now()->endOfMonth())
            ->get();
        return view('export.payment-month', compact('payments'));
    }
}
