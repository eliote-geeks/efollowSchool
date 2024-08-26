<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.html">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Search Input -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <input type="text" wire:model.live="search" placeholder="Rechercher..."
                    class="form-control rounded-pill shadow-sm py-2 px-4">
            </div>
        </div>
        <!-- basic table -->
        <div class="col-md-12 col-12 mb-5">
            <div class="card">
                <!-- card header  -->
                <div class="card-header">

                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                        <h2 class="mb-1">Rechercher des élèves</b></h2>
                    </div>
                    <p class="mb-0">
                        Sur cette page, vous pouvez rechercher un élève par son nom, sa classe ou son matricule
                    </p>
                </div>
                <!-- table  -->
                <div class="card-body">

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered shadow-sm" id="dataTableBasic">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Nom complet de l'élève</th>
                                    <th scope="col">Date de naissance</th>
                                    <th scope="col">Matricule</th>
                                    <th>Classe</th>
                                    {{-- <th>Sexe</th> --}}
                                    {{-- <th>Remise Scolarite</th> --}}
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    @if ($student->school_information_id == $this->schoolInformation->id)
                                        <tr class="align-middle">
                                            <td>{{ $student->first_name . ' ' . $student->last_name }}
                                                @if ($student->status == 0)
                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover"
                                                        data-bs-trigger="hover focus"
                                                        data-bs-content="Cet élève est désactivé, veuillez lui attribuer une carte pour l'activer."
                                                        style="cursor:pointer;">
                                                        <i class="bi bi-exclamation text-danger"
                                                            style="font-size: 40px;"></i>
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($student->date_birth)->format('d M, Y') }}</td>
                                            <td>{{ $student->matricular }}</td>

                                            <td>{{ $student->studentClasse->classe->niveau->name . ' ' . $student->studentClasse->classe->name }}
                                            </td>
                                            {{-- <td>{{ $student->sexe }}</td> --}}
                                            {{-- <td>{{ number_format($student->discount) }}%</td> --}}
                                            <td scope="col" class="text-center">

                                                <span class="dropdown dropstart">
                                                    <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                        href="#" role="button" id="courseDropdown2"
                                                        data-bs-toggle="dropdown" data-bs-offset="-20,20"
                                                        aria-expanded="false">
                                                        <i class="fe fe-list fs-3"></i>
                                                    </a>
                                                    <span class="dropdown-menu" aria-labelledby="courseDropdown2">
                                                        <span class="dropdown-header">Action</span>
                                                        <a class="dropdown-item"
                                                            href="{{ route('student.show', $student) }}">
                                                            <i class="fe fe-eye dropdown-item-icon"></i>
                                                            Voir plus d'informations
                                                        </a>
                                                        @if ($student->status == 1)
                                                            <a class="dropdown-item"
                                                                href="{{ route('payment.student', $student) }}"
                                                                role="button">
                                                                <i class="fe fe-credit-card dropdown-item-icon"></i>
                                                                Effectuer un paiement
                                                            </a>
                                                       
                                                        <a class="dropdown-item" href="{{ route('controlPayment') }}"
                                                            role="button">
                                                            <i class="bi bi-currency-dollar dropdown-item-icon"></i>
                                                            Scolarité
                                                        </a>
                                                        @if (
                                                            \App\Models\Moratoire::where(
                                                                'school_information_id',
                                                                \App\Models\SchoolInformation::where('status', 1)->latest()->first()->id)->where('student_id', $student->id)->where('end_date', '>', now())->count() == 0)
                                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                                href="#addMoratoire{{ $student->id }}" role="button">
                                                                <i class="bi bi-pause-circle dropdown-item-icon"></i>
                                                                Ajouter un moratoire
                                                            </a>
                                                        @else
                                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                                href="javascript:;" role="button">
                                                                <i class="bi bi-pause-circle dropdown-item-icon"></i>
                                                                moratoire en activité
                                                            </a>
                                                        @endif
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            href="#addReduction{{ $student->id }}" role="button">
                                                            <i class="bi bi-cash-stack dropdown-item-icon"></i>
                                                            Ajouter une réduction
                                                        </a>
                                                        @endif
                                                    </span>
                                                </span>

                                            </td>
                                        </tr>

                                        <div class="modal fade" id="addMoratoire{{ $student->id }}" aria-hidden="true"
                                            aria-labelledby="addMoratoire" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="addMoratoireLabel">Ajouter
                                                            un moratoire à l'élève
                                                            <b>{{ $student->first_name . ' ' . $student->last_name }}</b>
                                                        </h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form class="needs-validation" method="POST"
                                                        action="{{ route('moratoire.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                @if ($errors->any())
                                                                    <div class="alert alert-danger">
                                                                        <ul>
                                                                            @foreach ($errors->all() as $error)
                                                                                <li>{{ $error }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="schoolName">Nom du
                                                                        moratoire</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le nom du moratoire"
                                                                        id="name" name="name" required>
                                                                    <div class="invalid-feedback">Veuillez entrer le
                                                                        nom
                                                                        du moratoire</div>
                                                                </div>

                                                                <input type="hidden" name="student"
                                                                    value="{{ $student->id }}">
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="phone">Durée de
                                                                        la
                                                                        validité du moratoire
                                                                        en nombre de jours</label>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Entrez la durée de validité du moratoire"
                                                                        id="durée" name="duree" required>
                                                                    <div class="invalid-feedback">Veuillez entrer la
                                                                        durée
                                                                        de
                                                                        validité du moratoire</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="phone">Frais
                                                                        exigibles auxquels
                                                                        sera appliqué le moratoire</label>
                                                                    <select class="form-control" id="frais"
                                                                        name="scolarite" required>
                                                                        <option value="">Veuillez selectionner
                                                                            les
                                                                            frais exigibles</option>
                                                                        @foreach ($scolarites as $sc)
                                                                            <option value="{{ $sc->id }}">
                                                                                {{ $sc->name }}
                                                                                ({{ number_format($sc->amount) }})
                                                                                FCFA
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="invalid-feedback">Veuillez selectionner
                                                                        les
                                                                        frais exigibles auxquels
                                                                        sera appliqué le moratoire</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label"
                                                                            for="decision">Sélectionnez l'image ou le
                                                                            fichier PDF de
                                                                            la décision administrative</label>
                                                                        <div class="custom-file">
                                                                            <input type="file"
                                                                                class="custom-file-input form-control"
                                                                                id="decision" name="reason"
                                                                                accept="image/*,application/pdf"
                                                                                required>
                                                                            <div class="invalid-feedback">Veuillez
                                                                                sélectionner un fichier image ou PDF.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Ajouter</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="addReduction{{ $student->id }}"
                                            aria-hidden="true" aria-labelledby="addReduction" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="addReductionLabel">Ajouter une
                                                            réduction
                                                            à l'élève
                                                            <b>{{ $student->first_name . ' ' . $student->last_name }}</b>
                                                        </h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" method="POST"
                                                        action="{{ route('remiseStore') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                @if ($errors->any())
                                                                    <div class="alert alert-danger">
                                                                        <ul>
                                                                            @foreach ($errors->all() as $error)
                                                                                <li>{{ $error }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="schoolName">Montant
                                                                        de
                                                                        la réduction en FCFA</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le montant de la réduction"
                                                                        id="amount" name="amount"
                                                                        onInput="formatAmountCosts(this)"
                                                                        onkeypress="return formatAmountCosts(this, event)"
                                                                        required>
                                                                    <div class="invalid-feedback">Veuillez entrer le
                                                                        montant de la réduction</div>
                                                                </div>
                                                                <input type="hidden" name="student"
                                                                    value="{{ $student->id }}">
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="phone">Frais
                                                                        exigibles auxquels
                                                                        sera appliqué la Réduction</label>
                                                                    <select class="form-control" id="frais"
                                                                        name="scolarite" required>
                                                                        <option value="">Veuillez selectionner
                                                                            les
                                                                            frais exigibles</option>
                                                                        @foreach ($scolarites as $sc)
                                                                            @if (
                                                                                \App\Models\remiseDue::where([
                                                                                    'scolarite_id' => $sc->id,
                                                                                    'student_id' => $student->id,
                                                                                    'school_information_id' => $this->schoolInformation->id,
                                                                                ])->count() == 0)
                                                                                <option value="{{ $sc->id }}">
                                                                                    {{ $sc->name }}
                                                                                    ({{ number_format($sc->amount) }})
                                                                                    FCFA
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="invalid-feedback">Veuillez selectionner
                                                                        les
                                                                        frais exigibles auxquels
                                                                        sera appliqué le moratoire</div>
                                                                    <small>Si un frais n'apparait pas dans cette liste
                                                                        alors l'etudiant beneficie deja d'une reduction
                                                                        pour ce frais ou n'a pas encore été
                                                                        ajouté</small>
                                                                </div>
                                                            </div>
                                                            <small>Veuillez contacter un professionnel pour plus
                                                                d'informations</small>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Créer</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
