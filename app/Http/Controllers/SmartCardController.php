<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Classe;
use App\Models\Absence;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Presence;
use App\Models\Schedule;
use App\Models\Scolarite;
use App\Models\SmartCard;
use App\Models\EndSchedule;
use Illuminate\Http\Request;
use App\Models\StudentClasse;

class SmartCardController extends Controller
{
    public function remplace($texte)
    {
        $equivalences = [
            '&' => '1',
            'é' => '2',
            '"' => '3',
            "'" => '4',
            '(' => '5',
            '-' => '6',
            'è' => '7',
            '_' => '8',
            'ç' => '9',
            'à' => '0',
        ];

        $nouveau = str_replace(array_keys($equivalences), array_values($equivalences), $texte);

        return $nouveau;
    }

    public function addPostStudentCard(Request $request, Student $student)
    {
        try {
            $request->validate(
                [
                    'id_card_smart' => 'required|max:10|min:10',
                ],
                [
                    'id_card_smart.required' => 'Le champ carte à puce est obligatoire.',
                    'id_card_smart.max' => 'oups veuiller reesayer.',
                    'id_card_smart.min' => 'oups veuiller reesayer.',
                ],
            );
            $id = $this->remplace($request->id_card_smart);
            if (
                SmartCard::where([
                    'id_card_smart' => $id,
                ])->count() == 0
            ) {
                if (
                    SmartCard::where([
                        'user_id' => $student->id,
                        'status' => 'on',
                    ])->count() == 0
                ) {
                    $card = new SmartCard();
                    $card->id_card_smart = $id;
                    $card->user_id = $student->id;
                    $card->status = 'on';
                    $card->save();

                    $student->status = 1;
                    $student->save();
                    $class = StudentClasse::where('student_id', $student->id)->first();
                    $classe = Classe::find($class->classe_id);
                    return redirect()
                        ->route('classe.show', $classe)
                        ->with('success', 'Reussie !! L\'étudiant: ' . $student->first_name . ' dispose d\'une nouvelle carte!');
                } else {
                    $card = SmartCard::where([
                        'user_id' => $student->id,
                        'status' => 'on',
                    ])->first();
                    $card->status = 'false';
                    $card->save();

                    $card = new SmartCard();
                    $card->id_card_smart = $id;
                    $card->user_id = $student->id;
                    $card->status = 'on';
                    $card->save();

                    $student->status = 1;
                    $student->save();
                    $class = StudentClasse::where('student_id', $student->id)->first();
                    $classe = Classe::find($class->classe_id);
                    return redirect()
                        ->route('classe.show', $classe)
                        ->with('success', 'Reussie !! L\'étudiant: ' . $student->first_name . ' dispose d\'une nouvelle carte! Ancienne Carte retirée');
                }
            } else {
                return redirect()->back()->with('error', 'Carte déja prise !!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'une erreur innatendue s\'est produite');
        }
    }

    public function searchByStudentCard(Request $request, Student $student)
    {
        try {
            $request->validate([
                'id_card_smart' => 'required|min:10|max:10',
            ]);

            $id = $this->remplace($request->id_card_smart);

            if (
                SmartCard::where([
                    'id_card_smart' => $id,
                    'status' => 'on',
                ])->count() > 0
            ) {
                $card = SmartCard::where([
                    'id_card_smart' => $id,
                    'status' => 'on',
                ])->firstOrFail();
                $student = Student::find($card->user_id);

                return redirect()->route('student.show', [
                    'student' => $student,
                ]);
            } else {
                return redirect()->back()->with('error', 'Etudiant non repertorié !');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    public function addStudentCard(Student $student)
    {
        return view('student.card.add-student-card', [
            'student' => $student,
        ]);
    }

    public function controlPayment()
    {
        return view('student.card.payment');
    }

    public function paymentControlStudent(Request $request)
    {
        try {
            $request->validate([
                'id_card_smart' => 'required|min:10|max:10',
            ]);

            $id = $this->remplace($request->id_card_smart);

            if (
                SmartCard::where([
                    'id_card_smart' => $id,
                    'status' => 'on',
                ])->count() > 0
            ) {
                $card = SmartCard::where([
                    'id_card_smart' => $id,
                    'status' => 'on',
                ])->firstOrFail();
                $student = Student::find($card->user_id);
                if ($student->status != 1) {
                    return redirect()
                        ->back()
                        ->with('error', 'Controle impossible pour l\' etudiant: ' . $student->first_name . ' ' . $student->last_name . 'car il est desactivé');
                }
                $niveau = $student->studentClasse->classe->niveau->id;
                $scolarites = Scolarite::where('end_date', '<', now())
                    ->get()
                    ->filter(function ($scolarite) use ($niveau) {
                        $niveaux = json_decode($scolarite->niveaux, true);
                        return in_array($niveau, $niveaux);
                    });

                // Calculer le m// Calculer le montant total des scolarités
                $totalScolariteAmount = $scolarites->sum('amount');
                // Récupérer tous les paiements effectués par l'étudiant pour ces scolarités
                $payments = Payment::where('student_id', $student->id)
                    // ->whereIn('scolarite_id', $scolarites->pluck('id'))
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

                return view('payment.student-control', compact('scolarites', 'payments', 'totalPaymentsAmount', 'student', 'balance', 'status', 'totalScolariteAmount'));
            } else {
                return redirect()->back()->with('error', 'Etudiant non repertorié !');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    public function scheduleCard(Request $request, Schedule $schedule)
    {
        try {
            $request->validate([
                'id_card_smart' => 'required|min:10|max:10',
            ]);

            $id = $this->remplace($request->id_card_smart);

            if (
                SmartCard::where([
                    'id_card_smart' => $id,
                    'status' => 'on',
                ])->count() > 0
            ) {
                $card = SmartCard::where([
                    'id_card_smart' => $id,
                    'status' => 'on',
                ])->firstOrFail();
                $today = Carbon::today()->toDateString();
                $student = Student::find($card->user_id);
                if (
                    Presence::where([
                        'schedule_id' => $schedule->id,
                        'student_id' => $student->id,
                        'date' => $today,
                    ])->count() == 0
                ) {
                    $currentDay = Carbon::now()->format('l'); // 'l' retourne le jour en anglais, par ex: 'Monday'

                    // Vérifiez si le jour actuel correspond au jour du cours
                    if ($currentDay === $schedule->day_of_week) {
                        if ($student->StudentClasse->classe->id == $schedule->classe->id) {
                            $presence = new Presence();
                            $presence->schedule_id = $schedule->id;
                            $presence->student_id = $student->id;
                            $presence->date = $today;
                            $presence->save();
                            return redirect()->back()->with('success', 'Etudiant Présent enregistré !!');
                        } else {
                            return redirect()->back()->with('error', 'Etudiant ne fait pas parti de la classe !!');
                        }
                    } else {
                        return redirect()->back()->with('error', 'L\'appel ne peut etre effectué le jour ne correspond pas!!');
                    }
                } else {
                    return redirect()->back()->with('error', 'Etudiant déja enregistré !!');
                }

                return redirect()->route('student.show', [
                    'student' => $student,
                ]);
            } else {
                return redirect()->back()->with('error', 'Etudiant non repertorié !');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    public function endListCardschedule(Schedule $schedule)
    {
        try {
            $today = Carbon::today()->toDateString();
            if (
                endSchedule::where([
                    'schedule_id' => $schedule->id,
                    'date' => $today,
                ])->count() == 0
            ) {
                $course = $schedule->course_id;

                $start = Carbon::parse($schedule->timeSlot->start_Hour);
                $end = Carbon::parse($schedule->timeSlot->end_Hour);
                $time = $start->diffInMinutes($end);
                foreach (StudentClasse::where('classe_id', $schedule->classe_id)->get() as $sc) {
                    if (
                        Presence::where([
                            'schedule_id' => $schedule->id,
                            'student_id' => $sc->student_id,
                            'date' => $today,
                        ])->count() == 0
                    ) {
                        $ab = new Absence();
                        $ab->student_id = $sc->student_id;
                        $ab->schedule_id = $schedule->id;
                        $ab->date = $today;
                        $ab->duree = $time;
                        $ab->save();
                    }
                }

                $endschedule = new EndSchedule();
                $endschedule->schedule_id = $schedule->id;
                $endschedule->date = $today;
                // $endschedule->status = 1;
                $endschedule->save();

                return redirect()->route('scheduleCLass', [
                    'classe' => $schedule->classe_id,
                ])->with('Appel Terminé vous pouvez consultez la liste de presence de ce jour !!');
            } else {
                return redirect()->back()->with('error', 'Presence au cours déja terminé');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(SmartCard $smartCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SmartCard $smartCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SmartCard $smartCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SmartCard $smartCard)
    {
        //
    }
}
