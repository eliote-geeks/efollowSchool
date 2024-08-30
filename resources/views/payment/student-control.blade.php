<base href="/">
<x-layouts>

    <div class="container mt-5">
        <div class="card" id="statusIndicator">
            <div class="card-header @if ($balance > 0) alert alert-danger @else alert alert-success @endif">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                    <h2 class="mb-1">
                        @if ($balance > 0)
                            Paiement en retard
                        @else
                            Paiement à Jour
                        @endif
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12 col-12 mb-4 position-relative">
                    <h5 class="mb-2">Photo de l'étudiant</h5>
                    <label for="img" class="img-thumbnail position-relative"
                        style="height: 100px; width: 100px; cursor: pointer;">
                        <img id="StudentImage" src="{{ $student->user->profile_photo_url }}" class=" w-100 h-100">
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

                <!-- Bouton pour voir plus d'informations -->
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                        data-bs-target="#studentInfoModal">
                        Voir plus d'informations
                    </button>

                    <a href="{{ url()->previous() }}" class="btn btn-info">
                        Retour
                    </a>
                </div>


            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="studentInfoModal" tabindex="-1" aria-labelledby="studentInfoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentInfoModalLabel">Informations Complètes de l'Étudiant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informations Générales</h5>
                            <p><strong>Nom complet:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
                            <p><strong>Matricule :</strong> {{ $student->matricular }}</p>
                            <p><strong>Niveau :</strong> {{ $student->studentClasse->classe->niveau->name }}</p>
                            <p><strong>Classe :</strong> {{ $student->studentClasse->classe->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Statut du Paiement</h5>
                            @if ($balance > 0)
                                <div class="alert alert-danger">
                                    <h5 class="alert-heading">Paiement en Retard</h5>
                                    <p>L'étudiant doit encore payer <strong>{{ number_format($balance) }}
                                            FCFA</strong>.</p>
                                </div>
                            @else
                                <div class="alert alert-success mb-5">
                                    <h5 class="alert-heading">Paiement à Jour</h5>
                                    <p>L'étudiant est à jour avec ses paiements.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr class="mb-5">

                    <h3 class="mb-3">Frais exigible à payer/compléter</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>



</x-layouts>

<script>
    function playBeep(frequency, duration) {
        try {
            // Créer un contexte audio
            const audioContext = new(window.AudioContext || window.webkitAudioContext)();

            // Créer un oscillateur
            const oscillator = audioContext.createOscillator();

            // Définir la fréquence de l'oscillateur (en Hertz)
            oscillator.frequency.value = frequency;

            // Connecter l'oscillateur à la destination (haut-parleurs)
            oscillator.connect(audioContext.destination);

            // Démarrer l'oscillateur
            oscillator.start();

            // Arrêter l'oscillateur après la durée spécifiée
            setTimeout(() => {
                oscillator.stop();
                // Fermer le contexte audio pour libérer des ressources
                audioContext.close();
            }, duration);
        } catch (error) {
            console.error("Erreur lors de la génération du bip :", error);
        }
    }

    function simulateBeep(isUpToDate) {
        if (isUpToDate > 0) {
            // Trois bips courts
            playBeep(440, 200); // Premier bip court
            setTimeout(() => {
                playBeep(440, 200);
            }, 400); // Deuxième bip court
            setTimeout(() => {
                playBeep(440, 200);
            }, 800); // Troisième bip court

        } else {
            // Un seul bip long
            playBeep(440, 3000); // 440 Hz (A4), 1 seconde
        }
    }

    // Exemple d'utilisation : appeler simulateBeep avec un statut
    document.addEventListener('DOMContentLoaded', function() {
        let status = {{ $balance }}; // ou true, selon votre logique
        simulateBeep(status);
    });
</script>
