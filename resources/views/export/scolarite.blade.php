<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Montant</th>
            <th>Niveau</th>
            <th>Dernier Delai</th>
            <th>Auteur</th>
        </tr>
        @foreach ($scolarites as $sc)
            <tr>
                <td>{{ $sc->name }}</td>
                <td>{{ number_format($sc->amount) }}FCFA</td>
                <td>
                    <ul>
                        @foreach (json_decode($sc->niveaux) as $n)
                            <li>{{ \App\Models\Niveau::find($n)->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ \Carbon\Carbon::parse($sc->end_date)->format('d, M Y') }}</td>
                <td>{{ $sc->user->name }}</td>

            </tr>
        @endforeach
    </thead>
</table>
