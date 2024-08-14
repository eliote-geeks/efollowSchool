<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Moratoire;
use App\Models\remiseDue;
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

        $discount = 0;
        if ($student->discount > 0) {
            $discount = $student->discount;
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

    public function getRemise()
    {
        // $moratoires = Moratoire::where('school_information_id',SchoolInformation::where('status', 1)->latest()->first()->id)->get();
        $remises = remiseDue::where('school_information_id',$this->schoolInformation->id)->get();
        $scolarites = Scolarite::where('school_information_id', SchoolInformation::where('status', 1)->latest()->first()->id)
        // ->where('end_date', '>', now())
        ->get();
        return view('reduction.reduction',[
            'remises' => $remises,
            'scolarites' => $scolarites
        ]);
    }

    public function remiseStore(request $request)
    {
        try {
            $request->validate([
                'amount' => 'required',
                'student' => 'required',
                'scolarite' => 'required',
            ]);

            $str = str_replace(' ', '', $request->amount);

            $number = (float) $str;

            $remise = new remiseDue();
            $remise->school_information_id = $this->schoolInformation->id;
            $remise->rest = $number;
            $remise->student_id = $request->student;
            $remise->scolarite_id = $request->scolarite;
            $remise->save();
            return redirect()->route('getRemise')->with('success', 'Nouvelle reduction ajoutée!!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Oups une erreur innatendue s\'est produite: ' . $e->getMessage());
        }
    }

    public function remiseEdit(request $request, remiseDue $reduction)
    {
        try {
            $request->validate([
                'amount' => 'required',
                'student' => 'required',
                'scolarite' => 'required',
            ]);

            $str = str_replace(' ', '', $request->amount);

            $number = (float) $str;

            $reduction->rest = $number;
            $reduction->student_id = $request->student;
            $reduction->scolarite_id = $request->scolarite;
            $reduction->save();
            return redirect()->route('reductions')->with('success', 'Nouvelle reduction ajoutée!!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Oups une erreur innatendue s\'est produite: ' . $e->getMessage());
        }
    }

    public function delRemise(remiseDue $reduction)
    {
        if ($reduction->status == 0) {
            $reduction->delete();
            return redirect()->back()->with('success', 'suppression reussie!!');
        } else {
            return redirect()->back()->with('warning', 'Impossible de supprimer cette reduction car actif!!');
        }
    }

    public function statusRemise(remiseDue $reduction)
    {
        try {
            $sumPayment = Payment::where([
                'scolarite_id' => $reduction->scolarite_id,
                'student_id' => $reduction->student_id,
                'school_information_id' => $this->schoolInformation->id,
            ])->sum('amount');

            $scolariteAmount = Scolarite::find($reduction->scolarite_id)->amount;

            if ($reduction->status == 0) {
                if ($sumPayment + $reduction->rest <= $scolariteAmount) {
                    $payment = new Payment();
                    $payment->school_information_id = $this->schoolInformation->id;
                    $payment->student_id = $reduction->student_id;
                    $payment->scolarite_id = $reduction->scolarite_id;
                    $payment->user_id = auth()->user()->id;
                    $payment->amount = $reduction->rest;
                    $payment->save();

                    $reduction->status = 1;
                    $reduction->save();
                    return redirect()->back()->with('warning', 'Reussie remise active !!');
                } else {
                    return redirect()->back()->with('warning', 'Le montant entré associé au precedent paiement excede celui du frais scolaire en cours !!');
                }
            } else {
                $payment = Payment::where([
                    'scolarite_id' => $reduction->scolarite_id,
                    'student_id' => $reduction->student_id,
                    'school_information_id' => $this->schoolInformation->id,
                ])->first();
                $payment->school_information_id = $this->schoolInformation->id;
                $payment->student_id = $reduction->student_id;
                $payment->scolarite_id = $reduction->scolarite_id;
                $payment->user_id = auth()->user()->id;
                $payment->amount -= $reduction->rest;
                $payment->save();

                $reduction->status = 0;
                $reduction->save();
                return redirect()->back()->with('warning', 'Reussie remise désactive !!');
            }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erreur innatendue: ' . $e->getMessage());
        }
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
        return redirect()
            ->route('receiptPayment', [
                'student' => $payment->student,
                'payment' => $payment,
                'balance' => $payment->scolarite->amount - $request->totalPaymentsAmount,
                'totalPaymentsAmount' => $request->totalPaymentsAmount,
            ])
            ->with('success', 'Paiement Reussi !! reçu téléchargé !!');
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

        $pdf = PDF::loadView('payment.receipt', compact('payment', 'student', 'totalPaymentsAmount', 'balance'));
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
