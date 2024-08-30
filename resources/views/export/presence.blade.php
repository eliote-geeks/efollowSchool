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
        @foreach ($presences as $presence)
            <tr>
                <td>{{ $presence->student->first_name.' '.$presence->student->last_name }}</td>
                <td>{{ $presence->student->matricular }}</td>
                <td>{{ \Carbon\Carbon::parse($presence->date)->format('d, M Y') }}</td>
                <td>{{ $presence->schedule->subject }}</td>
                <td>{{ $presence->schedule->teacher->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($presence->schedule->timeSlot->start_time)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($presence->schedule->timeSlot->end_time)->format('H:i') }}</td>
                @php
                $start = \Carbon\Carbon::parse($presence->schedule->timeSlot->start_time);
                $end = \Carbon\Carbon::parse($presence->schedule->timeSlot->end_time);    
            @endphp
            <td>{{ $start->diffInHours($end) < 1 ? $start->diffInMinutes($end).' m' : $start->diffInHours($end).' h' }} </td>
            </tr>
        @endforeach
    </tbody>
</table>