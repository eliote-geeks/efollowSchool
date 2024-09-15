<base href="/">
<x-layouts>
    <style>
        .disabled-row {
            background-color: #f5f5f5;
            /* Change background color */
            color: #a9a9a9;
            /* Gray out text */
            /* pointer-events: none; */
            /* Disable any interaction */
            opacity: 0.6;
            /* Make it look "disabled" */
        }
    </style>

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
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">Gestion des années scolaires</li>
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
                            <h2 class="mb-1">Liste des années scolaires</h2>
                            <a class="btn btn-primary rounded-pill ms-auto" data-bs-toggle="modal" href="#addSchoolYear"
                                role="button">
                                <i class="fe fe-plus me-2"></i>
                                Créer une année scolaire
                            </a>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez créer, visualiser ou modifier des années scolaires
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive"
                                style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom de l'école</th>
                                        <th scope="col">Numéro de téléphone</th>
                                        <th>Masque du matricule</th>
                                        <th>Début de l'année scolaire</th>
                                        <th>Fin de l'année scolaire</th>
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schoolInformations as $school)
                                        <tr @if ($school->status == 0) class="disabled-row" @endif>
                                            <td>{{ $school->name }}</td>
                                            <td>{{ $school->tel_school }}</td>
                                            <td>{{ $school->matricular . '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($school->start)->format('d, M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($school->end)->format('d, M Y') }}</td>
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
                                                            href="#seeMore{{ $school->id }}" role="button">
                                                            <i class="fe fe-eye dropdown-item-icon"></i>
                                                            Voir plus d'informations
                                                        </a>
                                                            <!-- Vérification de l'année scolaire pour afficher le bouton Modifier -->
                                                        @if (\Carbon\Carbon::parse($school->end)->format('Y') > date('Y'))
                                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                            href="#editSchoolYear{{ $school->id }}" role="button">
                                                            <i class="fe fe-edit dropdown-item-icon"></i>
                                                            Modifier
                                                        </a>
                                                        @endif
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editSchoolYear{{ $school->id }}"
                                            aria-hidden="true" aria-labelledby="editSchoolYear" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editSchoolYearLabel">Modifier
                                                            l'année scolaire</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" method="POST"
                                                        action="{{ route('schoolInformation.update', $school) }}"
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
                                                                    <label class="form-label" for="schoolName">Nom de
                                                                        l'établissement</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le nom de l'établissement"
                                                                        id="schoolName" name="name"
                                                                        value="{{ $school->name }}" required>
                                                                    <div class="invalid-feedback">Veuillez entrer le nom
                                                                        de l'établissement</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="phone">Numero de
                                                                        téléphone de l'établissement</label>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Entrez le numero de téléphone de l'établissement"
                                                                        value="{{ $school->tel_school }}"
                                                                        id="phone" name="tel_school" required>
                                                                    <div class="invalid-feedback">Veuillez entrer le
                                                                        numero de téléphone de l'établissement</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="poBox">Boîte
                                                                        postale de l'établissement</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez la boîte postale de l'établissement"
                                                                        value="{{ $school->poBox }}" id="poBox"
                                                                        name="poBox" required>
                                                                    <div class="invalid-feedback">Veuillez entrer la
                                                                        boîte postale de l'établissement</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="masque">Masque du
                                                                        matricule des élèves</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le masque du matricule"
                                                                        value="{{ $school->matricular }}"
                                                                        id="masque" name="matricular" required>
                                                                    <div class="invalid-feedback">Veuillez entrer le
                                                                        masque du matricule</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-6">
                                                                    <label class="form-label" for="startDate">Début de
                                                                        l'année scolaire</label>
                                                                    <input type="date" class="form-control"
                                                                        value="{{ \Carbon\Carbon::parse($school->start)->format('Y-m-d') }}" id="startDate"
                                                                        name="start">
                                                                    <div class="invalid-feedback">Veuillez entrer la
                                                                        date de début de l'année scolaire</div>
                                                                    <small>Actuel:
                                                                        {{ \Carbon\Carbon::parse($school->start)->format('d, M Y') }}</small>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-6">
                                                                    <label class="form-label" for="endDate">Fin de
                                                                        l'année scolaire</label>
                                                                    <input type="date" class="form-control"
                                                                        value="{{ \Carbon\Carbon::parse($school->end)->format('Y-m-d') }}" id="end"
                                                                        name="end">
                                                                    <div class="invalid-feedback">Veuillez entrer la
                                                                        date de la fin de l'année scolaire</div>
                                                                    <small>Actuel:
                                                                        {{ \Carbon\Carbon::parse($school->end)->format('d, M Y') }}</small>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="col-md-12 mb-4">
                                                                    <div>
                                                                        <!-- logo -->
                                                                        <h5 class="mb-3">Choisissez le logo de
                                                                            l'établissement</h5>
                                                                        <label for="img"
                                                                            class="img-thumbnail position-relative"
                                                                            style="height: 80px; width: 80px; cursor: pointer;">
                                                                            <img id="logoEdit"
                                                                                src="{{ $school->logo }}"
                                                                                class=" w-100 h-100">
                                                                            <input
                                                                                class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100"
                                                                                type="file" accept="image/*"
                                                                                id="logoEdit" name="logo"
                                                                                onchange="previewLogoEdit(this)" />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input"
                                                                            name="fillPath" type="checkbox"
                                                                            role="switch"
                                                                            id="flexSwitchCheckDefault" @if ($school->fillPath == 1)
                                                                                checked
                                                                            @endif>
                                                                        <label class="form-check-label"
                                                                            for="flexSwitchCheckDefault">Imprimer les
                                                                            cartes des élèves à partir de
                                                                            l'application</label>
                                                                    </div>
                                                                </div>

                                                                <div class="print">
                                                                    <div class="col-md-12 mb-4">
                                                                        <div>
                                                                            <!-- logo -->
                                                                            <h5 class="mb-3">Choisissez la face recto
                                                                                de la carte</h5>
                                                                            <label for="img"
                                                                                class="img-thumbnail position-relative"
                                                                                style="height: 250px; width: 410px; cursor: pointer;">
                                                                                <img id="rectoEdit"
                                                                                    src="{{ $school->recto_path }}"
                                                                                    class=" w-100 h-100">
                                                                                <input
                                                                                    class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100"
                                                                                    type="file" accept="image/*"
                                                                                    id="cardRecto" name="recto_path"
                                                                                    onchange="previewRectoEdit(this)" />
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 mb-4">
                                                                        <div>
                                                                            <!-- logo -->
                                                                            <h5 class="mb-3">Choisissez la face verso
                                                                                de la carte</h5>
                                                                            <label for="img"
                                                                                class="img-thumbnail position-relative"
                                                                                style="height: 250px; width: 410px; cursor: pointer;">
                                                                                <img id="versoEdit"
                                                                                    src="{{ $school->verso_path }}"
                                                                                    class=" w-100 h-100">
                                                                                <input
                                                                                    class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100"
                                                                                    type="file" accept="image/*"
                                                                                    id="cardVerso" name="verso_path"
                                                                                    onchange="previewVersoEdit(this)" />
                                                                            </label>
                                                                        </div>
                                                                    </div>
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


                                        <div class="modal fade" id="seeMore{{ $school->id }}" aria-hidden="true"
                                            aria-labelledby="seeMore" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="seeMoreLabel">Informations sur
                                                            l'année scolaire</h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" novalidate>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="schoolName">Nom de
                                                                        l'établissement : <label
                                                                            style="font-weight: bold; color: black;">{{ $school->name }}</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="phone">Numero de
                                                                        téléphone de l'établissement : <label
                                                                            style="font-weight: bold; color: black;">{{ $school->tel_school }}</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="poBox">Boîte
                                                                        postale de l'établissement : <label
                                                                            style="font-weight: bold; color: black;">{{ $school->poBox }}</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="masque">Masque du
                                                                        matricule des élèves : <label
                                                                            style="font-weight: bold; color: black;">{{ $school->matricular }}-</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="startDate">Début de
                                                                        l'année scolaire : <label
                                                                            style="font-weight: bold; color: black;">{{ \Carbon\Carbon::parse($school->start)->format('d, M Y') }}</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="endDate">Fin de
                                                                        l'année scolaire : <label
                                                                            style="font-weight: bold; color: black;">{{ \Carbon\Carbon::parse($school->end)->format('d, M Y') }}</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="col-md-12 mb-4">
                                                                    <div>
                                                                        <!-- logo -->
                                                                        <h5 class="mb-3">Logo de l'établissement :
                                                                        </h5>
                                                                        <label for="img"
                                                                            class="img-thumbnail position-relative"
                                                                            style="height: 80px; width: 80px; cursor: pointer;"
                                                                            id="cardVerso" name="cardVerso">
                                                                            <img src="{{ $school->logo }}"
                                                                                class=" w-100 h-100">
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="print">
                                                                    <div class="col-md-12 mb-4">
                                                                        <div>
                                                                            <!-- logo -->
                                                                            <h5 class="mb-3">Face recto des cartes
                                                                                des élèves :</h5>
                                                                            <label for="img"
                                                                                class="img-thumbnail position-relative"
                                                                                style="height: 250px; width: 410px; cursor: pointer;">
                                                                                <img src="{{ $school->recto_path }}"
                                                                                    class=" w-100 h-100">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 mb-4">
                                                                        <div>
                                                                            <!-- logo -->
                                                                            <h5 class="mb-3">Face verso des cartes
                                                                                des élèves :</h5>
                                                                            <label for="img"
                                                                                class="img-thumbnail position-relative"
                                                                                style="height: 250px; width: 410px; cursor: pointer;">
                                                                                <img src="{{ $school->verso_path }}"
                                                                                    class=" w-100 h-100">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="modal-footer">
                                                        <!-- Bouton Fermer -->
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fermer</button>

                                                        <!-- Formulaire pour désactiver/activer -->
                                                        <form
                                                            action="{{ route('schoolInformation.destroy', $school) }}"
                                                            method="post" class="d-inline-block">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn {{ $school->status == 1 ? 'btn-danger' : 'btn-success' }}">
                                                                <i class="fe fe-{{ $school->status == 1 ? '' : 'check' }}"></i>
                                                                {{ $school->status == 1 ? 'Désactiver' : 'Activer' }}
                                                            </button>
                                                        </form>
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

    <div class="modal fade" id="addSchoolYear" aria-hidden="true" aria-labelledby="addSchoolYear" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addSchoolYearLabel">Créer une année scolaire</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" class="needs-validation" method="POST"
                    action="{{ route('schoolInformation.store') }}" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="schoolName">Nom de l'établissement</label>
                                <input type="text" class="form-control"
                                    placeholder="Entrez le nom de l'établissement" id="schoolName" name="name"
                                    required>
                                <div class="invalid-feedback">Veuillez entrer le nom de l'établissement</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="phone">Numero de téléphone de
                                    l'établissement</label>
                                <input type="number" class="form-control"
                                    placeholder="Entrez le numero de téléphone de l'établissement" id="phone"
                                    name="tel_school" required>
                                <div class="invalid-feedback">Veuillez entrer le numero de téléphone de l'établissement
                                </div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="poBox">Boîte postale de l'établissement</label>
                                <input type="text" class="form-control"
                                    placeholder="Entrez la boîte postale de l'établissement" id="poBox"
                                    name="poBox" required>
                                <div class="invalid-feedback">Veuillez entrer le nom de l'établissement</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="masque">Masque du matricule des élèves (au maximum 4 caractèreS)</label>
                                <input type="text" class="form-control"
                                    placeholder="Entrez le masque du matricule" id="masque" name="matricular"  maxlength="4"
                                    required>
                                <div class="invalid-feedback">Veuillez entrer le masque du matricule</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="startDate">Début de l'année scolaire</label>
                                <input type="date" class="form-control" id="startDate" name="start" required>
                                <div class="invalid-feedback">Veuillez entrer la date de début de l'année scolaire
                                </div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="endDate">Fin de l'année scolaire</label>
                                <input type="date" class="form-control" id="endDate" name="end" required>
                                <div class="invalid-feedback">Veuillez entrer la date de la fin de l'année scolaire
                                </div>
                            </div>
                            <!-- input -->
                            <div class="col-md-12 mb-4">
                                <div>
                                    <!-- logo -->
                                    <h5 class="mb-3">Choisissez le logo de l'établissement</h5>
                                    <label for="img" class="img-thumbnail position-relative"
                                        style="height: 80px; width: 80px; cursor: pointer;">
                                        <img id="logoCreate" src="assets/images/blank_image.jpg"
                                            class=" w-100 h-100">
                                        <input
                                            class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100"
                                            type="file" accept="image/*" id="img" name="logo"
                                            onchange="previewLogoCreate(this)" />
                                    </label>
                                </div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" name="fillPath">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Imprimer les cartes
                                        des élèves à partir de l'application</label>
                                </div>
                            </div>

                            <div class="print">
                                <div class="col-md-12 mb-4">
                                    <div>
                                        <!-- logo -->
                                        <h5 class="mb-3">Choisissez le modèle de la face recto de la carte</h5>
                                        <label for="img" class="img-thumbnail position-relative"
                                            style="height: 250px; width: 410px; cursor: pointer;">
                                            <img id="rectoCreate" src="assets/images/backgroundCard.png"
                                                class=" w-100 h-100">
                                            <input
                                                class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100"
                                                type="file" accept="image/*" id="img" name="recto_path"
                                                onchange="previewRectoCreate(this)" />
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div>
                                        <!-- logo -->
                                        <h5 class="mb-3">Choisissez le modèle de la face verso de la carte</h5>
                                        <label for="img" class="img-thumbnail position-relative"
                                            style="height: 250px; width: 410px; cursor: pointer;">
                                            <img id="versoCreate" src="assets/images/backgroundCard.png"
                                                class=" w-100 h-100">
                                            <input
                                                class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100"
                                                type="file" accept="image/*" id="img" name="verso_path"
                                                onchange="previewVersoCreate(this)" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.disabled-row').querySelectorAll('input, button').forEach(function(element) {
            element.disabled = true;
        });
    </script>

</x-layouts>
