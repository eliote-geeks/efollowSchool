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
        @foreach ($presences as $presence)
            <tr>
                <td>{{ $presence->student->first_name.' '.$presence->student->last_name }}</td>
                <td>{{ $presence->student->matricular }}</td>
                <td>{{ \Carbon\Carbon::parse($presence->date)->format('d, M Y') }}</td>
                <td>{{ $presence->schedule->subject }}</td>
                <td>{{ $presence->teacher->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($presence->timeSlot->start_time)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($presence->timeSlot->end_time)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($presence->timeSlot->start_time)->diffInHours(\Carbon\Carbon::parse($presence->timeSlot->end_time)) }} heure(s)</td>
            </tr>
        @endforeach
    </tbody>
</table>