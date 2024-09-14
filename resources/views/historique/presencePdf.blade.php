<!DOCTYPE html>
<html>

<head>
    <title>Récapitulatif presences et Retards</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            width: 100%;
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header p {
            margin: 2px 0;
        }

        .school-info,
        .student-info {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }

        .sub-table {
            width: 100%;
            border: none;
        }

        .sub-table td {
            border: none;
        }

        .highlight {
            background-color: #f2f2f2;
        }

        .justify {
            text-align: justify;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    @php
    $schoolInformation = \App\Models\SchoolInformation::where('status', 1)->first();
    @endphp

    <div class="header">
        <div class="school-info">
            <p>{{ $schoolInformation->name }}</p>
        </div>
        <div class="student-info">
            <p>{{ $classe->niveau->name }} - {{ $classe->name }} ( {{ \App\Models\StudentClasse::where('classe_id',$classe->id)->count() }} élèves)</p>
        
        </div>
        <h2>Récapitulatif presences </h2>
    </div>

    <h3>presences</h3>
    <table>
        <thead>
            <tr>
                <th>Étudiant</th>
                <th>Jour</th>
                <th>Matière</th>
                <th>Prof</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presences as $presence)
            <tr>
                <td>{{ \App\Models\Student::find($presence->student)->first_name . ' ' . \App\Models\Student::find($presence->student)->last_name }}</td>
                <td>{{ \Carbon\Carbon::parse($presence->date)->format('d, M Y') }}</td>
                <td>{{ $presence->subject }}</td>
                <td>{{ \App\Models\Teacher::find($presence->teacher)->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse(\App\Models\TimeSlot::find($presence->timeslot)->start_time)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse(\App\Models\TimeSlot::find($presence->timeslot)->end_time)->format('H:i') }}</td>
                @php
                $start = \Carbon\Carbon::parse(\App\Models\TimeSlot::find($presence->timeslot)->start_time);
                $end = \Carbon\Carbon::parse(\App\Models\TimeSlot::find($presence->timeslot)->end_time);
                @endphp
                
            </tr>
            @endforeach
        </tbody>
    </table>

   
</body>

</html>
