<?php

namespace App\Imports;

use App\Models\Payment;
use App\Models\Student;
use App\Models\SchoolInformation;
use Maatwebsite\Excel\Concerns\ToModel;

class PaymentImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $classe;
    protected $schoolInformation;

    public function __construct($classe)
    {
        $this->classe = $classe;
        $this->schoolInformation = SchoolInformation::where('status', 1)->first();
    }

    public function model(array $row)
    {
        if (Student::where('matricular', $row['matricule'])->count() == 0) {
            return redirect()
                ->back()
                ->with('message', 'Echec de la transaction du matricule: ' . $row['matricule'] . ' Matricule Introuvable');
        }

        $payment = new Payment();
        $payment->student_id = Student::where([
            'matricular' => $row['matricule'],
            ])->first()->id;
        $payment->amount = $row['montant'];
        $payment->classe_id = $this->classe->id;
        $payment->user_id = auth()->user()->id;
        $payment->save();
        return $payment;
    }
}
