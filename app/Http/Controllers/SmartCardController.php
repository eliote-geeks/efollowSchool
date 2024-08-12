<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SmartCard;
use App\Models\StudentClasse;
use Illuminate\Http\Request;

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
                    return redirect()
                        ->route('classe.show', $class->id)
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
                    return redirect()
                        ->route('classe.show', $class->id)
                        ->with('success', 'Reussie !! L\'étudiant: ' . $student->first_name . ' dispose d\'une nouvelle carte! Ancienne Carte retirée');
                }
            } else {
                return redirect()->back()->with('message', 'Carte déja prise !!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'une erreur innatendue s\'est produite');
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
                return redirect()->back()->with('message', 'Etudiant non repertorié !');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Une erreur s\'est produite');
        }
    }

    public function addStudentCard(Student $student)
    {
        return view('student.card.add-student-card', [
            'student' => $student,
        ]);
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
