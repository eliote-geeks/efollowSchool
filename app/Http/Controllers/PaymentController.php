<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Scolarite;
use Illuminate\Http\Request;
use App\Models\SchoolInformation;
use PDF;

class PaymentController extends Controller
{
    protected $schoolInformation;

    public function __construct()
    {
        $this->schoolInformation = SchoolInformation::where('status', 1)->first();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment.payment');
    }

    public function paymentStudent(Student $student)
    {
        if ($student->status != 1) {
            return redirect()
                ->back()
                ->with('message', 'Paiement impossible pour l\' etudiant: ' . $student->first_name . ' ' . $student->last_name . 'car il est desactivé');
        }
        $status = '';
        $niveau = $student->studentClasse->classe->niveau->id;
        // Récupérer les scolarités correspondantes au niveau de l'étudiant
        // $scolarites = Scolarite::whereRaw("JSON_CONTAINS(niveaux, '\"{$niveau}\"')")->get();
        // $scolarites = Scolarite::whereRaw("JSON_SEARCH(niveaux, 'one', '{$niveau}') IS NOT NULL")->get();
        // $scolarites = Scolarite::whereJsonContains('niveaux', $niveau)->get();
        $scolarites = Scolarite::all()->filter(function ($scolarite) use ($niveau) {
            $niveaux = json_decode($scolarite->niveaux, true);
            return in_array($niveau, $niveaux);
        });

        // Calculer le montant total des scolarités
        $totalScolariteAmount = $scolarites->sum('amount');

        // Récupérer tous les paiements effectués par l'étudiant pour ces scolarités
        $payments = Payment::where('student_id', $student->id)
            ->whereIn('scolarite_id', $scolarites->pluck('id'))
            ->get();

        // Calculer le montant total des paiements effectués
        $totalPaymentsAmount = $payments->sum('amount');

        // Calculer la balance restante
        $balance = $totalScolariteAmount - $totalPaymentsAmount;

        // Vérifier si l'étudiant est à jour ou non
        if ($balance > 0) {
            $status = "L'étudiant doit encore payer " . number_format($balance) . ' FCFA.';
        } else {
            $status = "L'étudiant est à jour avec ses paiements.";
        }

        // Retourner le statut

        return view('payment.payment', [
            'totalPaymentsAmount' => $totalPaymentsAmount,
            'balance' => $balance,
            'student' => $student,
            'scolarites' => $scolarites,
            'status' => $status,
            'totalScolariteAmount' => $totalScolariteAmount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student' => 'required',
            'amount' => 'required',
            'scolarite' => 'required',
        ]);

        $scolarite = Scolarite::find($request->scolarite);

        $str = str_replace(' ', '', $request->amount);

        $number = (float) $str;

        if ($request->totalPaymentsAmount + $number > $scolarite->amount) {
            return redirect()->back()->with('warning', 'Le montant entré excede celui du frais scolaire en cours !!');
        }

        $payment = new Payment();
        $payment->school_information_id = $this->schoolInformation->id;
        $payment->student_id = $request->student;
        $payment->scolarite_id = $request->scolarite;
        $payment->user_id = auth()->user()->id;
        $payment->amount = $number;
        $payment->save();
        return redirect()->route('receiptPayment', [
            'student' => $payment->student,
            'payment' => $payment,
            'balance' => $payment->scolarite->amount - $request->totalPaymentsAmount,
            'totalPaymentsAmount' => $request->totalPaymentsAmount,
        ])->with('success','Paiement Reussi !! reçu téléchargé !!');
    }

    public function receiptPayment(Student $student, Payment $payment)
    {
        $niveau = $student->studentClasse->classe->niveau->id;
        $scolarites = Scolarite::all()->filter(function ($scolarite) use ($niveau) {
            $niveaux = json_decode($scolarite->niveaux, true);
            return in_array($niveau, $niveaux);
        });

        // Calculer le montant total des scolarités
        $totalScolariteAmount = $scolarites->sum('amount');

        $payments = Payment::where('student_id', $student->id)
            ->whereIn('scolarite_id', $scolarites->pluck('id'))
            ->get();

        // Calculer le montant total des paiements effectués
        $totalPaymentsAmount = $payments->sum('amount');

        $balance = $totalScolariteAmount - $totalPaymentsAmount;

        $pdf = PDF::loadView('payment.receipt', compact('payment', 'student','totalPaymentsAmount','balance'));
        return $pdf->download('reçu-paiement.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
