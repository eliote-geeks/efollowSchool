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
                            <h2 class="mb-1">Liste des séquences</h2>
                            <a class="btn btn-primary rounded-pill ms-auto" data-bs-toggle="modal" 
                                href="#addSequence" role="button">
                                <i class="fe fe-plus me-2"></i>
                                Créer une séquence
                            </a>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez visualiser, modifier ou supprimer des séquences
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive"
                                style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom de la sequence</th>
                                        <th>Date de début</th>
                                        <th scope="col">Date de fin</th>
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sequence 1</td>
                                        <td>12/08/2024</td>
                                        <td>01/02/2025</td>
                                        <td scope="col" class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-ghost btn-sm me-2 d-flex align-items-center" 
                                                data-bs-toggle="modal" href="#editSequence" role="button">
                                                <i class="fe fe-edit me-1"></i>
                                                    Modifier la séquence
                                                </a>
                                                <a class="btn btn-ghost btn-sm d-flex align-items-center" 
                                                data-bs-toggle="modal" href="#deleteSequence" role="button">
                                                <i class="fe fe-trash me-1"></i>
                                                    Supprimer la séquence
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editSequence" aria-hidden="true"
                                        aria-labelledby="editSequence" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="editSequenceLabel">Modifier
                                                        la sequence <b>NOM_SEQUENCE</b></h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="post" class="needs-validation" method="POST"
                                                    action="#" enctype="multipart/form-data">
                                                    
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
                                                                de la sequence</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Entrez le nom de la sequence"
                                                                    id="name" name="name" value=""
                                                                    required>
                                                                <div class="invalid-feedback">Veuillez entrer le nom 
                                                                de la sequence</div>
                                                            </div>
                                                            <!-- input -->
                                                            <div class="mb-5 col-md-6">
                                                                <label class="form-label" for="schoolName">Date de début
                                                                de la séquence</label>
                                                                <input type="date" class="form-control"
                                                                    id="startDate" name="startDate" value=""
                                                                    required>
                                                                <div class="invalid-feedback">Veuillez entrer la date 
                                                                de début la séquence</div>
                                                            </div>
                                                            <!-- input -->
                                                            <div class="mb-5 col-md-6">
                                                                <label class="form-label" for="schoolName">Date de fin
                                                                de la séquence</label>
                                                                <input type="date" class="form-control"
                                                                    id="endDate" name="endDate" value=""
                                                                    required>
                                                                <div class="invalid-feedback">Veuillez entrer la date 
                                                                de fin la séquence</div>
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

                                    <div class="modal fade" id="deleteSequence" aria-hidden="true"
                                        aria-labelledby="deleteProfesseur" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="deleteSequenceLabel">Supprimer 
                                                    la sequence <b>NOM_SEQUENCE</b></h3>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                {{-- <form method="post" class="needs-validation" novalidate> --}}
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <h2>Voulez-vous vraiment supprimer cette séquence?</h2>
                                                    </div>
                                                </div>
                                                {{-- </form> --}}
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annuler</button>
                                                    
                                                        <a href="#" 
                                                            class="btn btn-danger">supprimer</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="modal fade" id="addSequence" aria-hidden="true"
        aria-labelledby="addSequence" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addSequenceLabel">Créer une séquence</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="post" class="needs-validation" method="POST"
                    action="#" enctype="multipart/form-data">
                    
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
                                de la sequence</label>
                                <input type="text" class="form-control"
                                    placeholder="Entrez le nom de la sequence"
                                    id="name" name="name"
                                    required>
                                <div class="invalid-feedback">Veuillez entrer le nom 
                                de la sequence</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="schoolName">Date de début
                                de la séquence</label>
                                <input type="date" class="form-control"
                                    id="startDate" name="startDate"
                                    required>
                                <div class="invalid-feedback">Veuillez entrer la date 
                                de début la séquence</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="schoolName">Date de fin
                                de la séquence</label>
                                <input type="date" class="form-control"
                                    id="endDate" name="endDate"
                                    required>
                                <div class="invalid-feedback">Veuillez entrer la date 
                                de fin la séquence</div>
                            </div>
                        </div>
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

</x-layouts>
