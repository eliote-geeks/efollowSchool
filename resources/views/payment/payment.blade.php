<base href="/">

<x-layouts>
    <section class="container-fluid p-4">

        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase fw-semibold ls-md">Total à payer</span>
                            </div>
                            <div>
                                <span class="bi bi-currency-dollar fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">{{ number_format($totalScolariteAmount) }} FCFA</h2>
                        <span class="text-success fw-semibold">
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase fw-semibold ls-md">Solde Total payé</span>
                            </div>
                            <div>
                                <span class="bi bi-wallet fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">{{ number_format($totalPaymentsAmount) }} FCFA</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase fw-semibold ls-md">Reste à payer</span>
                            </div>
                            <div>
                                <span class="bi bi-hourglass-split fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">{{ number_format($balance) }} FCFA</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase fw-semibold ls-md">Remise</span>
                            </div>
                            <div>
                                <span class="bi bi-graph-up fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            @foreach ($studentRemises as $rem)
                                <div class="card-body">
                                    <p>Frais exigible: {{ $rem->scolarite->name }}</p>
                                    <p class="mb-0">{{ number_format($rem->rest) }} FCFA</p>
                                    <small>{{ $rem->status == 1 ? 'payé' : 'non payé' }}</small>
                                </div>
                            @endforeach

                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase fw-semibold ls-md">Statut de l'étudiant</span>
                            </div>
                            <div>
                                <span class="bi bi-check-circle fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $status }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- basic table -->
            <div class="col-md-12 col-12 mb-5">
                <div class="card">
                    <!-- table  -->
                    <div class="card-body">

                        <div class="row">

                            <div class="mb-5 col-md-6">
                                <h2 class="mb-1 me-auto">Informations sur l'étudiant</b></h2>
                                <div class="card-body">
                                    <p><strong>Nom Complet :</strong>
                                        {{ $student->first_name . ' ' . $student->last_name }}</p>
                                    <p><strong>Matricule :</strong> {{ $student->matricular }}</p>
                                    <p><strong>Date de Naissance :</strong>
                                        {{ \Carbon\Carbon::parse($student->date_birth)->format('d, M Y') }}</p>
                                    <p><strong>Lieu de Naissance :</strong> {{ $student->place_birth }}</p>
                                    <p><strong>Niveau :</strong> {{ $student->studentClasse->classe->niveau->name }}
                                    </p>
                                    <p><strong>Classe :</strong> {{ $student->studentClasse->classe->name }}</p>
                                </div>
                            </div>

                            <div class="mb-5 col-md-6">

                                <form action="{{ route('payment.store') }}" method="POST">
                                    @csrf
                                    <h2 class="mb-5 me-auto">Effectuer un paiement</b></h2><!-- input -->
                                    <div class="mb-5 col-md-12">
                                        <input type="hidden" name="student" value="{{ $student->id }}">
                                        <input type="hidden" name="totalPaymentsAmount"
                                            value="{{ $totalPaymentsAmount }}">

                                        <label class="form-label" for="masque">Frais exigible</label>
                                        <select name="scolarite" id="scolarite_id" class="form-control">
                                            @foreach ($scolarites as $scolarite)
                                                @if (
                                                    $scolarite->amount >
                                                        \App\Models\Payment::where('student_id', $student->id)->where('scolarite_id', $scolarite->id)->sum('amount'))
                                                    <option value="{{ $scolarite->id }}">{{ $scolarite->name }} -
                                                        {{ number_format($scolarite->amount) }} FCFA</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- input -->
                                    <div class="mb-5 col-md-12">
                                        <label class="form-label" for="amount">Montant
                                            en FCFA</label>
                                        <input type="text" class="form-control"
                                            placeholder="Entrez le montant des frais exigibles" value=""
                                            id="amount" name="amount" onInput="formatAmountCosts(this)"
                                            step="0.01" onkeypress="return formatAmountCosts(this, event)" required>
                                    </div>
                                    <button type="button" class="btn btn-primary confirm" data-bs-toggle="modal"
                                        href="#payment-confirmation-modal">Confirmer le paiement</button>
                            </div>

                            <div class="modal fade" id="payment-confirmation-modal" aria-hidden="true"
                                aria-labelledby="payment-confirmation-modal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="payment-confirmation-modalLabel">Confirmation du
                                                paiement</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <!-- input -->
                                                <p><strong>Nom de l'Étudiant :</strong> {{ $student->first_name }}
                                                    {{ $student->last_name }}</p>
                                                <p><strong>Matricule :</strong> {{ $student->matricular }}</p>
                                                <p><strong>Date de Paiement :</strong>
                                                    {{ \Carbon\Carbon::now()->format('d, M Y') }}</p>
                                                <p><strong>Montant :</strong> <span id="confirmation-amount"></span>
                                                    FCFA</p>
                                                <p><strong>Tranche :</strong> <span id="confirmation-tranche"></span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Effectuer le
                                                paiement</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">
            <!-- basic table -->
            <div class="col-md-12 col-12 mb-5">
                <div class="card">
                    <!-- table  -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <!-- heading -->
                                    <h2 class="fw-bold">Historique des Paiements</h2>
                                </div>
                                <!-- table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg fs-4" id="dataTableBasic">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Paiement N°</th>
                                                <th scope="col">Frais Scolaire (montant)</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                                <th class="text-center">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $p)
                                                <tr>
                                                    <td>{{ $p->id }}</td>
                                                    <td>{{ $p->scolarite->name }}({{ number_format($p->scolarite->amount) }}
                                                        FCFA)</td>
                                                    <td>{{ number_format($p->amount) }} FCFA</td>
                                                    <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d, M Y') }}
                                                    </td>
                                                    <td class="text-center">

                                                        <a class="btn btn-info"
                                                            href="{{ route('receiptPayment', [$p->student->id, $p]) }}">
                                                            <i class="bi bi-printer me-1"></i> Imprimer </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-hover table-lg fs-4" id="dataTableBasic">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">Frais Scolaire (montant)</th>
                                                <th>Montant Reglé</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (\App\Models\Scolarite::where('school_information_id',$schoolInformationId)->get() as $s)
                                                <tr>
                                                    <td>{{ $s->name }}({{ number_format($s->amount) }}
                                                        FCFA)</td>
                                                    <td>{{ number_format(\App\Models\Payment::where([
                                                        'student_id' => $student->id,
                                                        'scolarite_id' => $s->id,
                                                        'school_information_id' => $schoolInformationId
                                                        ])->sum('amount')) }} FCFA</td>                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        </div>



    </section>



    <script>
        document.querySelector('.confirm').addEventListener('click', function() {
            const amount = document.getElementById('amount').value;
            const tranche = document.getElementById('scolarite_id').options[document.getElementById('scolarite_id')
                .selectedIndex].text;

            document.getElementById('confirmation-amount').textContent = amount;
            document.getElementById('confirmation-tranche').textContent = tranche;
        });
    </script>
</x-layouts>
