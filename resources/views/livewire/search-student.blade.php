<div class="container mt-4">
    <!-- Search Input -->
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <input type="text" wire:model.live="search" placeholder="Rechercher..."
                class="form-control rounded-pill shadow-sm py-2 px-4">
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow-sm" id="dataTableBasic">
            <thead class="table-primary text-center">
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Date de Naissance</th>

                    <th>Matricule</th>
                    <td>Classe</td>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr class="text-center align-middle">
                        <td>{{ $student->first_name }} @if ($student->status == 0)
                                <small class="d-inline-block" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover focus"
                                    data-bs-content="Cet élève est désactivé, veuillez lui attribuer une carte pour l'activer."
                                    style="cursor:pointer;">
                                    <i class="bi bi-exclamation text-danger" style="font-size: 40px;"></i>
                                </small>
                            @endif
                        </td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($student->date_birth)->format('d M, Y') }}</td>
                        <td>{{ $student->matricular }}</td>

                        <td>{{ $student->studentClasse->classe->niveau->name }}&nbsp;{{ $student->studentClasse->classe->name }}
                        </td>
                        <td>
                            <!-- Boutons d'action -->
                            <div class="btn-group" role="group">
                                <a href="" class="btn btn-info btn-sm">
                                    <i class="fas fa-user"></i> Profil
                                </a>
                                <a href="{{ route('payment.student', $student) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-money-bill-wave"></i> Paiement
                                </a>
                                <a href="" class="btn btn-warning btn-sm">
                                    <i class="fas fa-check-circle"></i> Présence
                                </a>
                                <a href="" class="btn btn-primary btn-sm">
                                    <i class="fas fa-school"></i> Scolarité
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Aucun étudiant trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
