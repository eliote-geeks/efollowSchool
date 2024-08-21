<base href="/">
<x-layouts>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                    <h2 class="mb-1">Statut du paiement de l'étudiant</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12 col-12 mb-4 position-relative">
                    <h5 class="mb-2">Photo de l'étudiant</h5>
                    <label for="img" class="img-thumbnail position-relative"
                        style="height: 100px; width: 100px; cursor: pointer;">
                        <img id="StudentImage"
                            src="{{ $student->user->profile_photo_url }}"
                            class=" w-100 h-100">
                    </label>
                </div>
                <p><strong>Nom complet:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
                <p><strong>Matricule :</strong> {{ $student->matricular }}</p>
                <p><strong>Niveau :</strong> {{ $student->studentClasse->classe->niveau->name }}</p>
                <p><strong>Classe :</strong> {{ $student->studentClasse->classe->name }} </p>

                <hr class="mb-5">

                @if ($balance > 0)
                    <div class="alert alert-danger">
                        <h5 class="alert-heading">Paiement en Retard</h5>
                        <p>L'étudiant doit encore payer <strong>{{ number_format($balance) }} FCFA</strong>.</p>
                    </div>
                @else
                    <div class="alert alert-success mb-5">
                        <h5 class="alert-heading">Paiement à Jour</h5>
                        <p>L'étudiant est à jour avec ses paiements.</p>
                    </div>
                @endif

                <hr class="mb-5">

                <h3 class="mb-3">Frais exigible à payer/compléter</h3>
                <div class="table-responsive">
                    <table class="table table-bordered" >
                        <thead>
                            <tr>
                                <th>Frais exigible</th>
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

                <hr class="mb-5">

                <h3 class="mb-3">Historique des paiements</h3>
                <div class="table-responsive">
                    <table class="table table-hover table-lg fs-4" id="dataTableBasic">
                        <thead class="table-light">
                            <tr>
                                <th>Paiement N°</th>
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
