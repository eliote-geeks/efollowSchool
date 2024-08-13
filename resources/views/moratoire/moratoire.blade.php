<base href="/">
<x-layouts>


    <section class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-3 mb-3">
                    <div>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="admin-dashboard.html">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">Gestion des moratoires</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- basic table -->
            <div class="col-md-12 col-12 mb-5">
                <div class="card">
                    <!-- card header  -->
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2 class="mb-1">Liste des moratoires</h2>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez visualiser ou modifier des moratoires
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive"
                                style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom du moratoire</th>
                                        <th scope="col">Frais exigibles concernés</th>
                                        <th>Date d'expiration</th>
                                        <th>Nom de l'élève</th>
                                        <th>Classe de l'élève</th>
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($moratoires as $mo)
                                        <tr>
                                            <td>{{ $mo->name }}</td>
                                            <td>{{ $mo->scolarite->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($mo->end_date)->format('d, M Y') }}</td>
                                            <td>{{ $mo->student->first_name . ' ' . $mo->student->last_name }}</td>
                                            <td>{{ $mo->student->studentClasse->classe->niveau->name . ' ' . $mo->student->studentClasse->classe->name }}
                                            </td>
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
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            href="#seeMore{{ $mo->id }}" role="button">
                                                            <i class="fe fe-eye dropdown-item-icon"></i>
                                                            Voir plus d'informations
                                                        </a>
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            href="#editMoratoire{{ $mo->id }}" role="button">
                                                            <i class="fe fe-edit dropdown-item-icon"></i>
                                                            Modifier
                                                        </a>


                                                    </span>
                                                </span>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editMoratoire{{ $mo->id }}" aria-hidden="true"
                                            aria-labelledby="editMoratoire" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editMoratoireLabel">Modifier
                                                            le moratoire</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" method="POST"
                                                        action="{{ route('moratoire.update', $mo) }}"
                                                        enctype="multipart/form-data">
                                                        @method('PATCH')
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
                                                                        id="name" name="name"
                                                                        value="{{ $mo->name }}" required>
                                                                    <div class="invalid-feedback">Veuillez entrer le nom
                                                                        du moratoire</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="durée">Durée de la
                                                                        validité du moratoire
                                                                        en nombre de jours</label>
                                                                    <input type="date" class="form-control"
                                                                        placeholder="Entrez la durée de validité du moratoire"
                                                                        value="{{ \Carbon\Carbon::parse($mo->end_date)->format('Y-m-d') }}"
                                                                        id="durée" name="duree" required>
                                                                    <div class="invalid-feedback">Veuillez entrer la
                                                                        date de fin du moratoire</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="phone">Frais
                                                                        exigibles auxquels
                                                                        sera appliqué le moratoire</label>
                                                                    <select class="form-control" id="frais"
                                                                        name="scolarite" required>
                                                                        @foreach ($scolarites as $scolarite)
                                                                            <option value="{{ $scolarite->id }}">{{ $scolarite->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                    <div class="invalid-feedback">Veuillez selectionner
                                                                        les frais exigibles auxquels
                                                                        sera appliqué le moratoire</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Modifier</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="modal fade" id="seeMore{{ $mo->id }}" aria-hidden="true"
                                            aria-labelledby="seeMore" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="seeMoreLabel">Informations sur
                                                            le moratoire</h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" novalidate>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="name">Nom du
                                                                        moratoire : <label
                                                                            style="font-weight: bold; color: black;">Première
                                                                            tranche</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="phone">Frais
                                                                        exigibles concernés : <label
                                                                            style="font-weight: bold; color: black;">Inscription</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="poBox">Date
                                                                        d'expiration du délai de validité : <label
                                                                            style="font-weight: bold; color: black;">27/11/2024</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="masque">Nom de
                                                                        l'élève : <label
                                                                            style="font-weight: bold; color: black;">PAUMAIN
                                                                            BRICE</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="masque">Classe
                                                                        l'élève : <label
                                                                            style="font-weight: bold; color: black;">6eme</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label"
                                                                        for="masque">Image/document de la décision
                                                                        administrative :
                                                                        <a href="assets/images/blank_image.jpg"
                                                                            download="nom_fichier.jpg"
                                                                            style="margin-left: 6px; font-weight: bold;">
                                                                            <i class="bi bi-download"></i> Télécharger
                                                                        </a></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="modal-footer">
                                                        <!-- Bouton Fermer -->
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fermer</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts>
