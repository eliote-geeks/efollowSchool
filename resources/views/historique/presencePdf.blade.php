<!DOCTYPE html>
<html>
<head>
    <title>Liste des Presences</title>
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
    <h1>Liste Presences Classe:({{ $classe->niveau->name }}) {{ $classe->name }}</h1>
    <table>
        <thead>
            <tr>
                <td>Etudiant</td>
                <th>Jour</th>
                <th>Matière</th>
                <th>Prof</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                {{-- <th>Durée (minutes)</th> --}}
                {{-- <th>Presences</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($presences as $presence)
                <tr>
                    <td>{{ \App\Models\Student::find($presence->student)->first_name.' '.\App\Models\Student::find($presence->student)->last_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($presence->date)->format('d, M Y') }}</td>
                    <td>{{ $presence->subject }}</td>
                    <td>{{ \App\Models\Teacher::find($presence->teacher)->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse(\App\Models\TimeSlot::find($presence->timeslot)->start_time)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse(\App\Models\TimeSlot::find($presence->timeslot)->end_time)->format('H:i') }}</td>
                    {{-- <td>{{ \Carbon\Carbon::parse(\App\Models\TimeSlot::find($presence->timeslot)->start_time)->diffInHours(\Carbon\Carbon::parse(\App\Models\TimeSlot::find($presence->timeslot)->end_time)) }} heure(s)</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
