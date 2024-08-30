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
                                    <a href="admin-dashboard.html">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">Gestion des Utilisateurs</li>
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
                            <h2 class="mb-1">Liste des utilisateurs</h2>
                            <a class="btn btn-primary rounded-pill ms-auto" data-bs-toggle="modal"
                                href="#addutilisateur" role="button">
                                <i class="fe fe-plus me-2"></i>
                                Créer un utilisateur
                            </a>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez visualiser, modifier ou supprimer des utilisateurs
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive"
                                style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom de l'utilisateur</th>
                                        <th>Role</th>
                                        <th scope="col">Adresse email</th>
                                        <th>Statut</th>
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr @if ($user->status == 0) class="disabled-row" @endif>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->status == 1 ? 'actif' : 'non Actif' }}</td>
                                            <td scope="col" class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-ghost btn-sm me-2 d-flex align-items-center"
                                                        data-bs-toggle="modal"
                                                        href="#editutilisateur{{ $user->id }}" role="button">
                                                        <i class="fe fe-edit me-1"></i>
                                                        Modifier l'utilisateur
                                                    </a>
                                                    <a class="btn btn-ghost btn-sm d-flex align-items-center"
                                                        data-bs-toggle="modal"
                                                        href="#deleteutilisateur{{ $user->id }}" role="button">
                                                        <i class="fe fe-trash me-1"></i>
                                                        Changer le statut de l'utilisateur
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editutilisateur{{ $user->id }}"
                                            aria-hidden="true" aria-labelledby="editutilisateur" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editutilisateurLabel">Modifier
                                                            les informations du utilisateur
                                                            <b>{{ $user->name }}</b>
                                                        </h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" method="POST"
                                                        action="{{ route('user.update', $user) }}"
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
                                                                    <label class="form-label" for="schoolName">Nom
                                                                        complet
                                                                        du utilisateur</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le nom complet du utilisateur"
                                                                        id="name" name="name"
                                                                        value="{{ $user->name }}" required>
                                                                    <div class="invalid-feedback">Veuillez entrer le nom
                                                                        complet
                                                                        du utilisateur</div>
                                                                </div>

                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="schoolName">Role
                                                                        de l' utilisateur</label>
                                                                    <select name="role" id=""
                                                                        class="form-control">
                                                                        <option>{{ $user->role }}
                                                                        </option>
                                                                        <option>Administrateur</option>
                                                                        <option>Informaticien
                                                                        </option>
                                                                        <option>Intendant</option>
                                                                        <option>Superviseur</option>
                                                                        <option>Controlleur</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">Veuillez entrer le
                                                                        role

                                                                        de l' utilisateur</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="schoolName">Adresse
                                                                        e-mail
                                                                        du utilisateur</label>
                                                                    <input type="email" class="form-control"
                                                                        placeholder="Entrez l'adresse e-mail du utilisateur"
                                                                        id="email" name="email"
                                                                        value="{{ $user->email }}" required>
                                                                    <div class="invalid-feedback">Veuillez entrer
                                                                        l'Adresse e-mail
                                                                        du utilisateur</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="schoolName">Mot de
                                                                        passe
                                                                        du utilisateur</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Entrez le mot de passe du utilisateur"
                                                                        id="password" name="password">
                                                                    <div class="invalid-feedback">Veuillez entrer le
                                                                        mot
                                                                        de passe
                                                                        du utilisateur</div>
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

                                        <div class="modal fade" id="deleteutilisateur{{ $user->id }}"
                                            aria-hidden="true" aria-labelledby="deleteutilisateur" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="deleteutilisateurLabel">Cahnger
                                                            statut
                                                            l'utilisateur <b>{{ $user->name }}</b></h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    {{-- <form method="post" class="needs-validation" novalidate> --}}
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <h2>Voulez-vous vraiment changer le statut de cet
                                                                utilisateur?</h2>
                                                        </div>
                                                    </div>
                                                    {{-- </form> --}}
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annuler</button>

                                                        <a class="btn btn-danger"
                                                            href="{{ route('user.delete', $user) }}">Appliquer</a>

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



    <div class="modal fade" id="addutilisateur" aria-hidden="true" aria-labelledby="addutilisateur" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addutilisateurLabel">Créer un utilisateur</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" class="needs-validation" method="POST" action="{{ route('user.store') }}"
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
                                    du utilisateur</label>
                                <input type="text" class="form-control"
                                    placeholder="Entrez le nom complet du utilisateur" id="name" name="name"
                                    required>
                                <div class="invalid-feedback">Veuillez entrer le nom complet
                                    du utilisateur</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="schoolName">Adresse e-mail
                                    du utilisateur</label>
                                <input type="email" class="form-control"
                                    placeholder="Entrez l'adresse e-mail du utilisateur" id="email"
                                    name="email" required>
                                <div class="invalid-feedback">Veuillez entrer l'Adresse e-mail
                                    du utilisateur</div>
                            </div>
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="schoolName">Role
                                    de l' utilisateur</label>
                                <select name="role" id="" class="form-control">
                                    <option value="">Selectionner le role
                                    </option>
                                    <option>Administrateur</option>
                                    <option>Informaticien
                                    </option>
                                    <option>Intendant</option>
                                    <option>Superviseur</option>
                                    <option>Controlleur</option>
                                </select>
                                <div class="invalid-feedback">Veuillez entrer le
                                    role

                                    de l' utilisateur</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="schoolName">Mot de passe
                                    du utilisateur</label>
                                <input type="password" class="form-control"
                                    placeholder="Entrez le mot de passe du utilisateur" id="password"
                                    name="password" required>
                                <div class="invalid-feedback">Veuillez entrer le mot de passe
                                    du utilisateur</div>
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
