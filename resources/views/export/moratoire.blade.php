<table>
    <thead>
    <tr>
        <th>Nom Complet Etudiant</th>
        <th>Matricule</th>
        <th>Date de Naissance</th>
        <th>Lieu de naissance</th>
        <th>Sexe</th>
        <th>Classe</th>
        <th>Niveau</th>
        <th>Frais Concerné</th>
        <th>Delai</th>
        <th>Date expiration du moratoire</th>
    </tr>
    </thead>
    <tbody>
    @foreach($moratoires as $moratoire)
        <tr>
            <td>{{ $moratoire->student->first_name . ' ' . $moratoire->student->first_name }}</td>
            <td>{{ $moratoire->student->matricular }}</td>
            <td>{{ \Carbon\Carbon::parse($moratoire->student->date_birth)->format('d, M Y') }}</td>
            <td>{{ $moratoire->student->place_birth }}</td>
            <td>{{ $moratoire->student->sexe }}</td>
            <td>{{  $moratoire->student->studentClasse->classe->name }}</td>
            <td>{{ $moratoire->student->studentClasse->classe->niveau->name }}</td>
            <td>{{ $moratoire->scolarite->name }}</td>
            <td>{{ \Carbon\Carbon::parse($moratoire->created_at)->diffInDays(\Carbon\Carbon::parse($moratoire->end_date)) }} Jour(s)</td>
            <td>{{ \Carbon\Carbon::parse($moratoire->end_date)->format('d, M Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
