<table>
    <thead>
    <tr>
        <th>Nom Complet</th>
        <th>Matricule</th>
        <th>Date de Naissance</th>
        <th>Lieu de naissance</th>
        <th>Sexe</th>
        <th>Classe</th>
        <th>Niveau</th>
        <th>Date de Creation</th>
        <th>Montant Total Versé</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->first_name . ' ' . $student->first_name }}</td>
            <td>{{ $student->matricular }}</td>
            <td>{{ \Carbon\Carbon::parse($student->date_birth)->format('d, M Y') }}</td>
            <td>{{ $student->place_birth }}</td>
            <td>{{ $student->sexe }}</td>
            <td>{{  $student->studentClasse->classe->name }}</td>
            <td>{{ $student->studentClasse->classe->niveau->name }}</td>
            <td>{{ \Carbon\Carbon::parse($student->created_at)->format('d, M Y') }}</td>
            <td>{{ number_format($student->payment->sum('amount')) }} FCFA</td>
        </tr>
    @endforeach
    </tbody>
</table>
