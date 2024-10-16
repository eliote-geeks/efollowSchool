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
                                    <a href="{{ route('niveau.index') }}">Niveaux</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('niveau.show',$classe->niveau) }}">Classes</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Gestion des élèves de la
                                    <b>{{ $classe->name }} </b>
                                </li>
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
                        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                            <h2 class="mb-1">Liste des élèves de la <b>{{ $classe->name }}</b></h2>
                            <div class="ms-auto mt-3 mt-md-0">
                                {{-- <a class="btn btn-primary rounded-pill me-2 mb-2 mb-md-0" data-bs-toggle="modal"
                                    href="#addSchoolYear" role="button" wire:click="backClass">
                                    <i class="fe fe-arrow-left me-2"></i>
                                    Retour
                                </a> --}}
                                <a class="btn btn-primary rounded-pill me-2 mb-2 mb-md-0"
                                    href="{{ route('createStudentClass', $classe) }}" role="button">
                                    <i class="fe fe-user-plus me-2"></i>
                                    Créer un élève
                                </a>

                                <a class="btn btn-primary rounded-pill me-2 mb-2 mb-md-0"
                                    href="{{ route('creneauClass', $classe) }}" role="button">
                                    <i class="fe fe-time me-2"></i>
                                    Créer un Creneau
                                </a>

                                <a class="btn btn-primary rounded-pill me-2 mb-2 mb-md-0"
                                    href="{{ route('scheduleCLass', $classe) }}" role="button">
                                    <i class="fe fe-calendar me-2"></i>
                                    Créer un emploi de temps
                                </a>

                                <a class="btn btn-success rounded-pill"
                                    href="{{ route('showImportForm', $classe->id) }}" role="button">
                                    <i class="fe fe-upload me-2"></i>
                                    Importer des élèves
                                </a>
                            </div>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez créer, visualiser ou modifier des élèves
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive"
                                style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom complet de l'élève</th>
                                        <th scope="col">Date de naissance</th>
                                        <th scope="col">Matricule</th>
                                        <th>Classe</th>
                                        <th>Sexe</th>
                                        {{-- <th>Remise</th> --}}
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        @if ($student->student->status != 2)
                                            <tr>
                                                <td>{{ $student->student->first_name . ' ' . $student->student->last_name }}
                                                    @if ($student->student->status == 0)
                                                        <span class="d-inline-block" tabindex="0"
                                                            data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                            data-bs-content="Cet élève est désactivé, veuillez lui attribuer une carte pour l'activer."
                                                            style="cursor:pointer;">
                                                            <i class="bi bi-exclamation text-danger"
                                                                style="font-size: 40px;"></i>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($student->student->date_birth)->format('d, M Y') }}
                                                </td>
                                                <td>{{ $student->student->matricular }}</td>
                                                <td><b>{{ $student->classe->niveau->name }}&nbsp;{{ $student->classe->name }}
                                                </td>
                                                <td>{{ $student->student->sexe }}</td>
                                                {{-- <td>{{ number_format($student->discount) }} FCFA</td> --}}
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
                                                                href="{{ route('student.show', $student) }}"
                                                                role="button">
                                                                <i class="fe fe-eye dropdown-item-icon"></i>
                                                                Voir plus d'informations
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('addStudentCard', $student) }}"
                                                                role="button">
                                                                <i class="fe fe-plus dropdown-item-icon"></i>
                                                                Attribuer une carte
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('print.card', [$student, $student->schoolInformation]) }}"
                                                                role="button">
                                                                <i class="fe fe-credit-card dropdown-item-icon"></i>
                                                                Imprimer Carte
                                                            </a>
                                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                                href="#editStudent{{ $student->student->id }}"
                                                                role="button">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Modifier
                                                            </a>
                                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                                href="#deleteStudent{{ $student->student->id }}"
                                                                role="button">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Supprimer
                                                            </a>
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editStudent{{ $student->student->id }}"
                                                aria-hidden="true" aria-labelledby="editStudent" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="editStudentLabel">Modifier les
                                                                informations de l'élève</h3>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post"
                                                            action="{{ route('student.update', $student->student) }}"
                                                            class="needs-validation" enctype="multipart/form-data">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <!-- input -->
                                                                    <div
                                                                        class="col-md-12 col-12 mb-4 position-relative">
                                                                        <h5 class="mb-2">Photo de l'élève</h5>
                                                                        <label for="img"
                                                                            class="img-thumbnail position-relative"
                                                                            style="height: 100px; width: 100px; cursor: pointer;">
                                                                            <img id="editStudentImage"
                                                                                src="{{ $student->student->user->profile_photo_url }}"
                                                                                class=" w-100 h-100">
                                                                            <input
                                                                                class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100"
                                                                                type="file" accept="image/*"
                                                                                id="img" name="avatar"
                                                                                onchange="previewEditStudentImage(this)" />
                                                                        </label>
                                                                        <p class="mb-0">Cliquez sur l'image ci-dessus
                                                                        </p>
                                                                        <p>pour la modifier</p>
                                                                    </div>
                                                                    <!-- input -->
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label" for="firstName">Nom
                                                                            de
                                                                            l'élève</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Entrez le nom de l'élève"
                                                                            value="{{ $student->student->first_name }}"
                                                                            id="firstName" name="first" required>
                                                                        <div class="invalid-feedback">Veuillez entrer
                                                                            le nom de l'élève</div>
                                                                    </div>
                                                                    <!-- input -->
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label"
                                                                            for="lastName">Prénom de l'élève</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Entrez le prénom de l'élève"
                                                                            value="{{ $student->student->last_name }}"
                                                                            id="lastName" name="last" required>
                                                                        <div class="invalid-feedback">Veuillez entrer
                                                                            le prénom de l'élève</div>
                                                                    </div>
                                                                    <!-- input -->
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label" for="birthday">Date
                                                                            de naissance</label>
                                                                        <input type="date" class="form-control"
                                                                            placeholder="Entrez le prénom de l'élève"
                                                                            value="{{ \Carbon\Carbon::parse($student->student->date_birth)->format('Y-m-d') }}"
                                                                            id="birthday" name="date_birth" required>
                                                                        <div class="invalid-feedback">Veuillez entrer
                                                                            la date de naissance de l'élève</div>
                                                                        <small>Actuel:
                                                                            {{ \Carbon\Carbon::parse($student->student->date_birth)->format('d, M Y') }}</small>
                                                                    </div>
                                                                    <!-- input -->
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label"
                                                                            for="birthPlace">Lieu de naissance</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Entrez le lieu de naissance de l'élève"
                                                                            value="{{ $student->student->place_birth }}"
                                                                            id="birthPlace" name="place_birth"
                                                                            required>
                                                                        <div class="invalid-feedback">Veuillez entrer
                                                                            le lieu de naissance de l'élève</div>
                                                                    </div>
                                                                    <!-- input -->
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label"
                                                                            for="matricule">Matricule de
                                                                            l'élève</label>
                                                                        <input readonly type="text"
                                                                            class="form-control"
                                                                            placeholder="Entrez le matricule de l'élève"
                                                                            value="{{ $student->student->matricular }}"
                                                                            id="matricule" name="matricular" required>
                                                                        <div class="invalid-feedback">Veuillez entrer
                                                                            le matricule de l'élève</div>
                                                                    </div>
                                                                    <!-- input -->
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label"
                                                                            for="classe">Classe de l'élève</label>
                                                                        <select class="form-control" id="classe"
                                                                            name="classe" required>
                                                                            @foreach ($classes as $c)
                                                                                <option value="{{ $c->id }}"
                                                                                    @if ($c->id == $student->classe->id) selected @endif>
                                                                                    ({{ $c->niveau->name }})
                                                                                    &nbsp;
                                                                                    {{ $c->name }}</option>
                                                                            @endforeach


                                                                        </select>
                                                                        <div class="invalid-feedback">Veuillez
                                                                            selectionner la classe de l'élève</div>
                                                                    </div>
                                                                    <!-- input -->
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label" for="fatherName">Nom
                                                                            complet du père ou tuteur</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Entrez le nom complet du  ou tuteur"
                                                                            id="fatherName"
                                                                            value="{{ $student->student->name_father }}"
                                                                            name="name_father" required>
                                                                        <div class="invalid-feedback">Veuillez entrer
                                                                            le nom complet du père ou tuteur</div>
                                                                    </div>
                                                                    <!-- input -->
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label"
                                                                            for="fatherPhone">Numero de téléphone du
                                                                            père ou tuteur</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Entrez le numero de téléphone du père ou tuteur"
                                                                            value="{{ $student->student->phone_father }}"
                                                                            id="fatherPhone" name="phone_father"
                                                                            required>
                                                                        <div class="invalid-feedback">Veuillez entrer
                                                                            le numero de téléphone du père ou tuteur
                                                                        </div>
                                                                    </div>
                                                                    <!-- input -->
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label" for="motherName">Nom
                                                                            complet de la mère ou tutrice</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Entrez le nom complet de la mère ou tutrice"
                                                                            id="motherName"
                                                                            value="{{ $student->student->name_mother }}"
                                                                            name="name_mother" required>
                                                                        <div class="invalid-feedback">Veuillez entrer
                                                                            le nom complet de la mère ou tutrice</div>
                                                                    </div>
                                                                    <!-- input -->
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label"
                                                                            for="motherPhone">Numero de téléphone de la
                                                                            mère ou tutrice</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Entrez le numero de téléphone du mère ou tutrice"
                                                                            value="{{ $student->student->phone_mother }}"
                                                                            id="motherPhone" name="phone_mother"
                                                                            required>
                                                                        <div class="invalid-feedback">Veuillez entrer
                                                                            le numero de téléphone de la mère ou tutrice
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label"
                                                                            for="motherPhone">Sexe</label>
                                                                        <select class="form-control" name='sexe'
                                                                            required>
                                                                            <option>{{ $student->student->sexe }}
                                                                            </option>
                                                                            @if ($student->student->sexe == 'Masculin')
                                                                                <option value="Feminin">Feminin
                                                                                </option>
                                                                            @else
                                                                                <option value="Masculin">Masculin
                                                                                </option>
                                                                            @endif
                                                                        </select>
                                                                    </div>

                                                                    {{-- <div class="mb-5 col-md-6">
                                                                        <label class="form-label"
                                                                            for="motherPhone">Remise</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Entrez le pourcentage de remise de la pension"
                                                                            value="{{ $student->student->discount }}"
                                                                            id="motherPhone" name="discount">
                                                                         <div class="invalid-feedback">Veuillez entrer
                                                                            le sexe</div> 
                                                                    </div> --}}

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

                                            <div class="modal fade" id="deleteStudent{{ $student->student->id }}"
                                                aria-hidden="true" aria-labelledby="deleteStudent" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="deleteStudentLabel">Supprimer
                                                                l'élève</h3>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post" class="needs-validation" novalidate>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <h2>Voulez-vous vraiment supprimer l'élève: <b>
                                                                            {{ $student->student->first_name . ' ' . $student->student->last_name }}
                                                                        </b>?</h2>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                            <form
                                                                action="{{ route('student.destroy', $student->student) }}"
                                                                method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-danger">supprimer</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>
    <script>
        document.querySelector('.disabled-row').querySelectorAll('input, button').forEach(function(element) {
            element.disabled = true;
        });
    </script>
</x-layouts>
