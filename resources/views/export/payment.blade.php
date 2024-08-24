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
        <th>Date de Creation</th>
        <th>Frais Concerné</th>
        <th>Montant</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->student->first_name . ' ' . $payment->student->first_name }}</td>
            <td>{{ $payment->student->matricular }}</td>
            <td>{{ \Carbon\Carbon::parse($payment->student->date_birth)->format('d, M Y') }}</td>
            <td>{{ $payment->student->place_birth }}</td>
            <td>{{ $payment->student->sexe }}</td>
            <td>{{  $payment->student->studentClasse->classe->name }}</td>
            <td>{{ $payment->student->studentClasse->classe->niveau->name }}</td>
            <td>{{ \Carbon\Carbon::parse($payment->student->created_at)->format('d, M Y') }}</td>
            <td>{{ $payment->scolarite->name }}</td>
            <td>{{ number_format($payment->amount) }} FCFA</td>
        </tr>
    @endforeach
    </tbody>
</table>
