<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Scolarite;
use Illuminate\Http\Request;
use App\Models\SchoolInformation;

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
                ->with('message', 'Paiement impossible pour l\' etudiant: ' . $student->name . 'car desactivé');
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
            'scolarite' => 'required'
        ]);

        $str = str_replace(' ', '', $request->amount);

        $number = (float) $str;

        $payment = new Payment();
        $payment->school_information_id = $this->schoolInformation->id;
        $payment->student_id = $request->student_id;
        $payment->scolarite_id = $request->scolarite_id;
        $payment->amount = $number;
        $payment->save();
        // return redirect()->route('searchByname')->with('succe');

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
