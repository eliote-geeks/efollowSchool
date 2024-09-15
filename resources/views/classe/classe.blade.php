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
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('niveau.index') }}">Niveaux</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Gestion des classes</li>
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
                        <div class="d-flex flex-column flex-sm-row align-items-center">
                            <h2 class="mb-1 me-auto">Liste des classes du niveau <b>{{ $niveau->name }}</b></h2>
                            <a class="btn btn-primary rounded-pill" data-bs-toggle="modal" href="#addClassroom" role="button">
                            <i class="fe fe-plus me-2"></i>
                            Créer une classe
                            </a>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez créer, visualiser ou modifier des classes
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive"
                                style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom de la classe</th>
                                        <th>Niveau</th>
                                        <th>Professeur principal</th>
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classes as $c)
                                        <tr>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->niveau->name }}</td>
                                            <td>{{ $c->prof_titulaire ? $c->prof_titulaire : '// ' }}</td>
                                            <td scope="col" class="text-center d-flex justify-content-center">
                                                <a href="{{ route('classe.show',$c) }}" class="btn btn-ghost btn-sm me-2 d-flex align-items-center" role="button">
                                                    <i class="fe fe-eye me-1"></i>
                                                    Liste des élèves
                                                </a>
                                                 <a class="btn btn-ghost btn-sm me-2 d-flex align-items-center" data-bs-toggle="modal" href="#editSchoolYear{{ $c->id }}" role="button">
                                                    <i class="fe fe-edit me-1"></i>
                                                    Modifier
                                                </a>
                                                <a class="btn btn-ghost btn-sm d-flex align-items-center" data-bs-toggle="modal" href="#deleteClassroom{{ $c->id }}" role="button">
                                                    <i class="fe fe-trash me-1"></i>
                                                    Supprimer
                                                </a>
                                            </td>
                                            {{-- </td> --}}
                                        </tr>

                                        <div class="modal fade" id="editSchoolYear{{ $c->id }}"
                                            aria-hidden="true" aria-labelledby="editSchoolYear" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editSchoolYearLabel">Modifier la
                                                            classe</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="{{ route('classe.update', $c) }}"
                                                        class="needs-validation" autocomplete="off">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-10">
                                                                    <label class="form-label" for="class">Nom de la
                                                                        classe</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le nom de la classe"
                                                                        value="{{ $c->name }}" id="className"
                                                                        name="name" required>
                                                                    <div class="invalid-feedback">Veuillez entrer le nom
                                                                        de la classe</div>
                                                                </div>

                                                                <input type="hidden" name="niveau" value="{{ $niveau->id }}">
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-10">
                                                                    <label class="form-label" for="class">Nom prof
                                                                        Titulaire</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le nom du prof titulaire"
                                                                        id="className" value="{{ $c->prof_titulaire  }}" name="prof_titulaire" >
                                                                    {{-- <div class="invalid-feedback">Veuillez entrer le nom du prof titulaire</div> --}}
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

                                        <div class="modal fade" id="deleteClassroom{{ $c->id }}"
                                            aria-hidden="true" aria-labelledby="deleteClassroom" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="deleteClassroomLabel">Supprimer la
                                                            classe</h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" novalidate>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <h2>Voulez-vous vraiment supprimer cette classe?</h2>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annuler</button>
                                                        <form method="POST"
                                                            action="{{ route('classe.destroy', $c) }}">
                                                            @csrf
                                                            @method('DELETE')
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

    <div class="modal fade" id="addClassroom" aria-hidden="true" aria-labelledby="addClassroom" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addClassroomLabel">Créer une classe</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" class="needs-validation" action="{{ route('classe.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- input -->
                            <div class="mb-5 col-md-10">
                                <label class="form-label" for="class">Nom de la classe</label>
                                <input type="text" class="form-control" placeholder="Entrez le nom de la classe"
                                    id="className" name="name" required>
                                @error('name')
                                    <div class="text-danger">Veuillez entrer le nom de la classe</div>
                                @enderror
                            </div>
                            <input type="hidden" name="niveau" value="{{ $niveau->id }}">
                            <!-- input -->
                            <div class="mb-5 col-md-10">
                                <label class="form-label" for="class">Nom prof Titulaire</label>
                                <input type="text" class="form-control"
                                    placeholder="Entrez le nom du prof titulaire" id="className"
                                    name="prof_titulaire" >
                                {{-- <div class="invalid-feedback">Veuillez entrer le nom du prof titulaire</div> --}}
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
