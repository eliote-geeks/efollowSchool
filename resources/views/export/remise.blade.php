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
        <th>Montant</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($remises as $remise)
        <tr>
            <td>{{ $remise->student->first_name . ' ' . $remise->student->first_name }}</td>
            <td>{{ $remise->student->matricular }}</td>
            <td>{{ \Carbon\Carbon::parse($remise->student->date_birth)->format('d, M Y') }}</td>
            <td>{{ $remise->student->place_birth }}</td>
            <td>{{ $remise->student->sexe }}</td>
            <td>{{  $remise->student->studentClasse->classe->name }}</td>
            <td>{{ $remise->student->studentClasse->classe->niveau->name }}</td>
            <td>{{ $remise->scolarite->name }}</td>
            <td>{{ number_format($remise->rest) }} FCFA</td>
            <td>{{ $remise->status == 1 ? 'payé' : 'non Payé' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
