<base href="/">
<x-layouts>

    <!-- Container fluid -->
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

                                <li class="breadcrumb-item active" aria-current="page">Gestion des niveaux</li>
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
                            <h2 class="mb-1">Liste des niveaux</h2>
                            <a class="btn btn-primary rounded-pill ms-auto" data-bs-toggle="modal" href="#addLevel"
                                role="button">
                                <i class="fas fa-plus me-2"></i>
                                Créer un niveau
                            </a>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez créer, visualiser ou modifier des niveaux
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive"
                                style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom du niveau</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($niveaux as $n)
                                        <tr>
                                            <td>{{ $n->name }}</td>

                                            <td scope="col" class="text-center">
                                                <span class="dropdown dropstart">
                                                    <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                        href="#" role="button" id="courseDropdown2"
                                                        data-bs-toggle="dropdown" data-bs-offset="-20,20"
                                                        aria-expanded="false">
                                                        <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <span class="dropdown-menu" aria-labelledby="courseDropdown2">
                                                        <span class="dropdown-header">Action</span>
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            href="#deleteLevel{{ $n->id }}" role="button">
                                                            <i class="fe fe-trash dropdown-item-icon"></i>
                                                            Supprimer
                                                        </a>
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            href="#editLevel{{ $n->id }}" role="button">
                                                            <i class="fe fe-edit dropdown-item-icon"></i>
                                                            Modifier
                                                        </a>
                                                    </span>
                                                </span>
                                            </td>



                                        </tr>
                                        <div class="modal fade" id="editLevel{{ $n->id }}" aria-hidden="true"
                                            aria-labelledby="editLevel" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editLevelLabel">Modifier le
                                                            niveau</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation"
                                                        action="{{ route('niveau.update', $n) }}" autocomplete="off">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-10">
                                                                    <label class="form-label" for="firstName">Nom du
                                                                        niveau</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le nom du niveau"
                                                                        value="{{ $n->name }}" id="levelName"
                                                                        name="name" required>
                                                                    <div class="invalid-feedback">Veuillez entrer le
                                                                        nom du niveau</div>
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
                                        <div class="modal fade" id="deleteLevel{{ $n->id }}" aria-hidden="true"
                                            aria-labelledby="deleteLevel" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="LevelLabel">Supprimer le niveau
                                                        </h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    {{-- <form method="post" class="needs-validation"> --}}
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <h2>Voulez-vous vraiment supprimer ce niveau?</h2>
                                                        </div>
                                                    </div>
                                                    {{-- </form> --}}
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annuler</button>
                                                        <form action="{{ route('niveau.destroy', $n) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger">supprimer</button>
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

    <div class="modal fade" id="addLevel" aria-hidden="true" aria-labelledby="addLevel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="LevelLabel">Créer une niveau</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('niveau.store') }}" class="needs-validation">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- input -->
                            <div class="mb-5 col-md-10">
                                <label class="form-label" for="levelName">Nom du niveau</label>
                                <input type="text" class="form-control" placeholder="Entrez le nom du niveau"
                                    id="levelName" name="name" required>
                                <div class="invalid-feedback">Veuillez entrer le nom du niveau</div>
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
