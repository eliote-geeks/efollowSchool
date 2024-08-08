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
                    <div class="d-flex align-items-center">
                        <h2 class="mb-1">Liste des classes</h2>
                        <a class="btn btn-primary rounded-pill ms-auto" data-bs-toggle="modal" href="#addClassroom" role="button">
                            <i class="fas fa-plus me-2"></i>
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
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive" style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom de la classe</th>
                                        <th>Niveau</th>
                                        <th>Professeur principal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>6EME A</td>
                                        <td>6EME</td>
                                        <td>PAULAIN BRICE</td>
                                        <td scope="col" class="text-center">
                                            <span class="dropdown dropstart">
                                                <a
                                                    class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                    href="#"
                                                    role="button"
                                                    id="courseDropdown2"
                                                    data-bs-toggle="dropdown"
                                                    data-bs-offset="-20,20"
                                                    aria-expanded="false">
                                                    <i class="fe fe-more-vertical"></i>
                                                </a>
                                                <span class="dropdown-menu" aria-labelledby="courseDropdown2">
                                                    <span class="dropdown-header">Action</span>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#deleteClassroom" role="button">
                                                        <i class="fe fe-trash dropdown-item-icon"></i>
                                                        Supprimer
                                                    </a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#editSchoolYear" role="button">
                                                        <i class="fe fe-edit dropdown-item-icon"></i>
                                                        Modifier
                                                    </a>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editSchoolYear" aria-hidden="true" aria-labelledby="editSchoolYear" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h3 class="modal-title" id="editSchoolYearLabel">Modifier la classe</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" class="needs-validation" novalidate>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-10">
                                                            <label class="form-label" for="class">Nom de la classe</label>
                                                            <input type="text" class="form-control" placeholder="Entrez le nom de la classe" value="6EME A" id="className" name="className" required>
                                                            <div class="invalid-feedback">Veuillez entrer le nom de la classe</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-10">
                                                            <label class="form-label" for="level">Niveau</label>
                                                            <select class="form-control" id="level" name="level" required>
                                                                <option>6eme</option>
                                                                <option>5eme</option>
                                                                <option>4eme</option>
                                                            </select>
                                                            <div class="invalid-feedback">Veuillez selectionner le niveau de la classe</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-10">
                                                            <label class="form-label" for="classe">Professeur principal</label>
                                                            <select class="form-control" id="level" name="level" required>
                                                                <option>BRICE PAULAIN</option>
                                                                <option>PAULAIN BRICE</option>
                                                                <option>PAUBRI LAINCE</option>
                                                            </select>
                                                            <div class="invalid-feedback">Veuillez selectionner le professeur principal de la classe</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="deleteClassroom" aria-hidden="true" aria-labelledby="deleteClassroom" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h3 class="modal-title" id="deleteClassroomLabel">Supprimer la classe</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" class="needs-validation" novalidate>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <h2>Voulez-vous vraiment supprimer cette classe?</h2>
                                                    </div>
                                                </div>
                                                </form>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-danger">supprimer</button>
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

    <div class="modal fade" id="addClassroom" aria-hidden="true" aria-labelledby="addClassroom" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addClassroomLabel">Créer une classe</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="row">
                            <!-- input -->
                            <div class="mb-5 col-md-10">
                                    <label class="form-label" for="class">Nom de la classe</label>
                                    <input type="text" class="form-control" placeholder="Entrez le nom de la classe" id="className" name="className" required>
                                    <div class="invalid-feedback">Veuillez entrer le nom de la classe</div>
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-10">
                                    <label class="form-label" for="level">Niveau</label>
                                    <select class="form-control" id="level" name="level" required>
                                        <option value="">Selectionnez le niveau de la classe</option>
                                        <option>6eme</option>
                                        <option>5eme</option>
                                        <option>4eme</option>
                                    </select>
                                    <div class="invalid-feedback">Veuillez selectionner le niveau de la classe</div>
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-10">
                                    <label class="form-label" for="classe">Professeur principal</label>
                                    <select class="form-control" id="level" name="level" required>
                                        <option value="">Selectionnez le professeur principal de la classe</option>
                                        <option>BRICE PAULAIN</option>
                                        <option>PAULAIN BRICE</option>
                                        <option>PAUBRI LAINCE</option>
                                    </select>
                                    <div class="invalid-feedback">Veuillez selectionner le professeur principal de la classe</div>
                                </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </div>
        </div>
    </div>

</x-layouts>