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
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">Gestion des réductions</li>
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
                            <h2 class="mb-1">Liste des professeurs</h2>
                            <a class="btn btn-primary rounded-pill ms-auto" data-bs-toggle="modal" href="#addProfesseur"
                                role="button">
                                <i class="fe fe-plus me-2"></i>
                                Créer un professeur
                            </a>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez visualiser, modifier ou supprimer des professeurs
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive"
                                style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom du professeur</th>
                                        <th>Matricule</th>
                                        <th scope="col">Adresse email</th>
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->user->name }}</td>
                                            <td>{{ $teacher->matricular }}</td>
                                            <td>{{ $teacher->user->email }}</td>
                                            <td scope="col" class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-ghost btn-sm me-2 d-flex align-items-center"
                                                        data-bs-toggle="modal" href="#editProfesseur{{ $teacher->id }}"
                                                        role="button">
                                                        <i class="fe fe-edit me-1"></i>
                                                        Modifier le professeur
                                                    </a>
                                                    <a class="btn btn-ghost btn-sm d-flex align-items-center"
                                                        data-bs-toggle="modal"
                                                        href="#deleteProfesseur{{ $teacher->id }}" role="button">
                                                        <i class="fe fe-trash me-1"></i>
                                                        Supprimer le professeur
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editProfesseur{{ $teacher->id }}"
                                            aria-hidden="true" aria-labelledby="editProfesseur" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editProfesseurLabel">Modifier
                                                            les informations du professeur
                                                            <b>{{ $teacher->user->name }}</b></h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" method="POST"
                                                        action="{{ route('teacher.update', $teacher) }}"
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
                                                                    <label class="form-label" for="schoolName">Nom
                                                                        complet
                                                                        du professeur</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le nom complet du professeur"
                                                                        id="name" name="name"
                                                                        value="{{ $teacher->user->name }}" required>
                                                                    <div class="invalid-feedback">Veuillez entrer le nom
                                                                        complet
                                                                        du professeur</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="schoolName">Adresse
                                                                        e-mail
                                                                        du professeur</label>
                                                                    <input type="email" class="form-control"
                                                                        placeholder="Entrez l'adresse e-mail du professeur"
                                                                        id="email" name="email"
                                                                        value="{{ $teacher->user->email }}" required>
                                                                    <div class="invalid-feedback">Veuillez entrer
                                                                        l'Adresse e-mail
                                                                        du professeur</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="schoolName">Mot de
                                                                        passe
                                                                        du professeur</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Entrez le mot de passe du professeur"
                                                                        id="password" name="password">
                                                                    <div class="invalid-feedback">Veuillez entrer le mot
                                                                        de passe
                                                                        du professeur</div>
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

                                        <div class="modal fade" id="deleteProfesseur{{ $teacher->id }}"
                                            aria-hidden="true" aria-labelledby="deleteProfesseur" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="deleteProfesseurLabel">Supprimer
                                                            le professeur <b>{{ $teacher->user->name }}</b></h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    {{-- <form method="post" class="needs-validation" novalidate> --}}
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <h2>Voulez-vous vraiment supprimer ce professeur?</h2>
                                                        </div>
                                                    </div>
                                                    {{-- </form> --}}
                                                    <div class="modal-footer">
                                                        <form action="{{ route('teacher.destroy',$teacher) }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>

                                                            <button type="submit" class="btn btn-danger">supprimer</button>
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



    <div class="modal fade" id="addProfesseur" aria-hidden="true" aria-labelledby="addProfesseur" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addProfesseurLabel">Créer un professeur</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" class="needs-validation" method="POST" action="{{ route('teacher.store') }}"
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
                                <label class="form-label" for="schoolName">Nom complet
                                    du professeur</label>
                                <input type="text" class="form-control"
                                    placeholder="Entrez le nom complet du professeur" id="name" name="name"
                                    required>
                                <div class="invalid-feedback">Veuillez entrer le nom complet
                                    du professeur</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="schoolName">Adresse e-mail
                                    du professeur</label>
                                <input type="email" class="form-control"
                                    placeholder="Entrez l'adresse e-mail du professeur" id="email" name="email"
                                    required>
                                <div class="invalid-feedback">Veuillez entrer l'Adresse e-mail
                                    du professeur</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="schoolName">Mot de passe
                                    du professeur</label>
                                <input type="password" class="form-control"
                                    placeholder="Entrez le mot de passe du professeur" id="password" name="password"
                                    required>
                                <div class="invalid-feedback">Veuillez entrer le mot de passe
                                    du professeur</div>
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

</x-layouts>
