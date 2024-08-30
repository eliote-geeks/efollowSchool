<table>
    <thead>
        <tr>
            <td>Nom Complet Etudiant</td>
            <th>Matricule</th>
            <th>Jour</th>
            <th>Matière</th>
            <th>Prof</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Durée</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($absences as $absence)
            <tr>
                <td>{{ $absence->student->first_name.' '.$absence->student->last_name }}</td>
                <td>{{ $absence->student->matricular }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->date)->format('d, M Y') }}</td>
                <td>{{ $absence->schedule->subject }}</td>
                <td>{{ $absence->schedule->teacher->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->schedule->timeSlot->start_time)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->schedule->timeSlot->end_time)->format('H:i') }}</td>
                @php
                    $start = \Carbon\Carbon::parse($absence->schedule->timeSlot->start_time);
                    $end = \Carbon\Carbon::parse($absence->schedule->timeSlot->end_time);    
                @endphp
                <td>{{ $start->diffInHours($end) < 1 ? $start->diffInMinutes($end).' m' : $start->diffInHours($end).' h' }} </td>
            </tr>
        @endforeach
    </tbody>
</table>