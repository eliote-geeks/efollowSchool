<base href="/">

<x-layouts>
    <div class="container mt-5">
        <!-- Status du Paiement -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Status du Paiement</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $status }}</p>
            </div>
        </div>

        <!-- Informations financières -->
        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Totale à Payer</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ number_format($totalScolariteAmount) }} FCFA</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Reste à Payer</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ number_format($balance) }} FCFA</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Solde Total Payé</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ number_format($totalPaymentsAmount) }} FCFA</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Remise</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ number_format($studentRemise) }} FCFA</p>

                    </div>
                </div>
            </div>
        </div>


        <div class="container py-8">
            <div class="row">
                <div class="col-12">
                    <div class="mb-5">
                        <!-- heading -->
                        <h2 class="fw-bold">Paiements</h2>
                        <p class="mb-0">Liste de Paiements .</p>
                    </div>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-lg fs-4" id="dataTableBasic">
                            <thead class="table-light">
                                <tr>
                                    <th>Identifiant Paiement</th>
                                    <th scope="col">Frais Scolaire</th>
                                    <th>Montant</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $p)
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ $p->scolarite->name }}</td>
                                        <td>{{ number_format($p->amount) }}</td>
                                        <td class="text-end"><a class="btn btn-info"
                                                href="{{ route('receiptPayment', [$p->student->id, $p]) }}">Imprimer</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>






        <!-- Informations de l'Étudiant -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Informations de l'Étudiant</h4>
            </div>
            <div class="card-body">
                <p><strong>Nom Complet :</strong> {{ $student->first_name . ' ' . $student->last_name }}</p>
                <p><strong>Matricule :</strong> {{ $student->matricular }}</p>
                <p><strong>Date de Naissance :</strong>
                    {{ \Carbon\Carbon::parse($student->date_birth)->format('d, M Y') }}</p>
                <p><strong>Lieu de Naissance :</strong> {{ $student->place_birth }}</p>
                <p><strong>Classe :</strong>
                    {{ $student->studentClasse->classe->niveau->name . ' ' . $student->studentClasse->classe->name }}
                </p>
            </div>
        </div>

        <!-- Formulaire de Paiement -->
        <form action="{{ route('payment.store') }}" method="POST" class="mt-4">
            @csrf

            <input type="hidden" name="student" value="{{ $student->id }}">
            <input type="hidden" name="totalPaymentsAmount" value="{{ $totalPaymentsAmount }}">

            <div class="mb-3">
                <label for="scolarite_id" class="form-label">Tranche</label>
                <select name="scolarite" id="scolarite_id" class="form-control">
                    @foreach ($scolarites as $scolarite)
                        @if ($scolarite->amount > $totalPaymentsAmount)
                            <option value="{{ $scolarite->id }}">{{ $scolarite->name }} -
                                {{ number_format($scolarite->amount) }} FCFA</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Montant</label>
                <input type="number" name="amount" id="amount" class="form-control" step="0.01"
                    placeholder="Entrez le montant à payer" required>
            </div>

            <!-- Bouton de Confirmation -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target=".payment-confirmation-modal">
                Confirmation de paiement
            </button>

            <!-- Modal de Confirmation -->
            <div class="modal fade payment-confirmation-modal" tabindex="-1" role="dialog"
                aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content p-4">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">Confirmation de Paiement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Nom de l'Étudiant :</strong> {{ $student->first_name }}
                                {{ $student->last_name }}</p>
                            <p><strong>Matricule :</strong> {{ $student->matricular }}</p>
                            <p><strong>Date de Paiement :</strong> {{ \Carbon\Carbon::now()->format('d, M Y') }}</p>
                            <p><strong>Montant :</strong> <span id="confirmation-amount"></span> FCFA</p>
                            <p><strong>Tranche :</strong> <span id="confirmation-tranche"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Effectuer le Paiement</button>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('searchByname') }}" class="btn btn-info mt-3">Retour</a>
        </form>
    </div>

    <script>
        document.querySelector('[data-bs-target=".payment-confirmation-modal"]').addEventListener('click', function() {
            const amount = document.getElementById('amount').value;
            const tranche = document.getElementById('scolarite_id').options[document.getElementById('scolarite_id')
                .selectedIndex].text;

            document.getElementById('confirmation-amount').textContent = amount;
            document.getElementById('confirmation-tranche').textContent = tranche;
        });
    </script>
</x-layouts>
