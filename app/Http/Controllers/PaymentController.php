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
        $niveau = $student->studentClasse->classe->niveau->id;
        // Récupérer les scolarités correspondantes au niveau de l'étudiant
        $scolarites = Scolarite::whereRaw("JSON_CONTAINS(niveaux, '\"{$niveau}\"')")->get();

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
            $status = "L'étudiant doit encore payer $balance.";
        } else {
            $status = "L'étudiant est à jour avec ses paiements.";
        }

        // Retourner le statut
       dd($status);

        dd($scolarites);
        return view('payment.payment', [
            'payments' => $payments,
            'totalAmount' => $totalAmount,
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
        //
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
