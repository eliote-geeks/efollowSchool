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
            <th>Durée (minutes)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($absences as $absence)
            <tr>
                <td>{{ $absence->student->first_name.' '.$absence->student->last_name }}</td>
                <td>{{ $absence->student->matricular }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->date)->format('d, M Y') }}</td>
                <td>{{ $absence->schedule->subject }}</td>
                <td>{{ $absence->teacher->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->timeSlot->start_time)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->timeSlot->end_time)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->timeSlot->start_time)->diffInHours(\Carbon\Carbon::parse($absence->timeSlot->end_time)) }} heure(s)</td>
            </tr>
        @endforeach
    </tbody>
</table>