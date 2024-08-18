<base href="/">
<x-layouts>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Statut de Paiement de l'Étudiant</h3>
            </div>
            <div class="card-body">
                <h4 class="card-title">Informations de l'Étudiant</h4>
                <p><strong>Nom :</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
                <p><strong>Matricule :</strong> {{ $student->matricular }}</p>
                <p><strong>Classe :</strong> {{ $student->studentClasse->classe->name }}
                    ({{ $student->studentClasse->classe->niveau->name }})</p>

                <hr>

                <h4 class="card-title">Statut de Paiement</h4>
                @if ($balance > 0)
                    <div class="alert alert-danger">
                        <h5 class="alert-heading">Paiement en Retard</h5>
                        <p>L'étudiant doit encore payer <strong>{{ number_format($balance) }} FCFA</strong>.</p>
                    </div>
                @else
                    <div class="alert alert-success">
                        <h5 class="alert-heading">Paiement à Jour</h5>
                        <p>L'étudiant est à jour avec ses paiements.</p>
                    </div>
                @endif

                <hr>

                <h4 class="card-title">Détails des Scolarités</h4>
                <div class="table-responsive">
                    <table class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>Tranche</th>
                                <th>Montant</th>
                                <th>Date d'echéance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scolarites as $scolarite)
                                <tr>
                                    <td>{{ $scolarite->name }}</td>
                                    <td>{{ number_format($scolarite->amount) }} FCFA</td>
                                    <td>{{ \Carbon\Carbon::parse($scolarite->end_date)->format('d, M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Scolarité</th>
                                <th>{{ number_format($totalScolariteAmount) }} FCFA</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <hr>

                <h4 class="card-title">Détails des Paiements</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-lg fs-4" id="dataTableBasic">
                        <thead class="table-light">
                            <tr>
                                <th>Identifiant Paiement</th>
                                <th scope="col">Frais Scolaire</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th class="text-center">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->scolarite->name }}</td>
                                    <td>{{ number_format($p->amount) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d, M Y') }}</td>
                                    <td class="text-end"><a class="btn btn-info"
                                            href="{{ route('receiptPayment', [$p->student->id, $p]) }}">Imprimer</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 

                <a href="{{ url()->previous() }}" class="btn btn-info mt-3">Retour</a>
            </div>
        </div>
    </div>



</x-layouts>
