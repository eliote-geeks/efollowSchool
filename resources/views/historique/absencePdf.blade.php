<!DOCTYPE html>
<html>
<head>
    <title>Liste des Absences</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Liste Absences Classe:({{ $classe->niveau->name }}) {{ $classe->name }}</h1>
    <table>
        <thead>
            <tr>
                <td>Etudiant</td>
                <th>Jour</th>
                <th>Matière</th>
                <th>Prof</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Durée (minutes)</th>
                {{-- <th>Absences</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($absences as $absence)
                <tr>
                    <td>{{ \App\Models\Student::find($absence->student)->first_name.' '.\App\Models\Student::find($absence->student)->last_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($absence->date)->format('d, M Y') }}</td>
                    <td>{{ $absence->subject }}</td>
                    <td>{{ \App\Models\Teacher::find($absence->teacher)->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse(\App\Models\TimeSlot::find($absence->timeslot)->start_time)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse(\App\Models\TimeSlot::find($absence->timeslot)->end_time)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse(\App\Models\TimeSlot::find($absence->timeslot)->start_time)->diffInHours(\Carbon\Carbon::parse(\App\Models\TimeSlot::find($absence->timeslot)->end_time)) }} heure(s)</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
