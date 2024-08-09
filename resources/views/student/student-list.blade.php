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

                                <li class="breadcrumb-item active" aria-current="page">Gestion des élèves</li>
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
                        <h2 class="mb-1">Liste des élèves</h2>
                        <a class="btn btn-primary rounded-pill ms-auto" data-bs-toggle="modal" href="#addSchoolYear" role="button">
                            <i class="fas fa-plus me-2"></i>
                            Créer un élève
                        </a>
                    </div>
                        <p class="mb-0">
                        Sur cette page vous pouvez créer, visualiser ou modifier des élèves
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive" style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom complet de l'élève</th>
                                        <th scope="col">Matricule</th>
                                        <th>Classe</th>
                                        <th>Nom du père</th>
                                        <th>Numero du père</th>
                                        <th>Nom de la mère</th>
                                        <th>Numero de la mère</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>PAULAIN BRICE</td>
                                        <td>TRYTSHJKPOS</td>
                                        <td>6EME A</td>
                                        <td>BRICE PAULAIN</td>
                                        <td>+237 657 876 435</td>
                                        <td>BRICE PAULAIN</td>
                                        <td>+237 657 876 435</td>
                                        <td scope="col">
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
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#" role="button">
                                                        <i class="fe fe-eye dropdown-item-icon"></i>
                                                        Voir plus d'informations
                                                    </a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#editStudent" role="button">
                                                        <i class="fe fe-edit dropdown-item-icon"></i>
                                                        Modifier
                                                    </a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#deleteStudent" role="button">
                                                        <i class="fe fe-trash dropdown-item-icon"></i>
                                                        Supprimer
                                                    </a>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>


                                    <div class="modal fade" id="editStudent" aria-hidden="true" aria-labelledby="editStudent" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h3 class="modal-title" id="editStudentLabel">Modifier les informations de l'élève</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="#" class="needs-validation">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- input -->
                                                        <div class="col-md-12 col-12 mb-4 position-relative">
                                                        <h5 class="mb-2">Photo de l'élève</h5>
                                                            <label for="img" class="img-thumbnail position-relative" style="height: 100px; width: 100px; cursor: pointer;">
                                                                <img id="editStudentImage" src="assets/images/blank_image.jpg" class=" w-100 h-100">
                                                                <input class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100" type="file" accept="image/*" id="img" name="img" onchange="previewEditStudentImage(this)" />
                                                            </label>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="firstName">Nom de l'élève</label>
                                                            <input type="text" class="form-control" placeholder="Entrez le nom de l'élève" value="" id="firstName" name="firstName" required>
                                                            <div class="invalid-feedback">Veuillez entrer le nom de l'élève</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="lastName">Prénom de l'élève</label>
                                                            <input type="text" class="form-control" placeholder="Entrez le prénom de l'élève" value="" id="lastName" name="lastName" required>
                                                            <div class="invalid-feedback">Veuillez entrer le prénom de l'élève</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                        <label class="form-label" for="birthday">Date de naissance</label>
                                                            <input type="date" class="form-control" placeholder="Entrez le prénom de l'élève" value="" id="birthday" name="birthday" required>
                                                            <div class="invalid-feedback">Veuillez entrer la date de naissance de l'élève</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="birthPlace">Lieu de naissance</label>
                                                            <input type="text" class="form-control" placeholder="Entrez le lieu de naissance de l'élève" value="" id="birthPlace" name="birthPlace" required>
                                                            <div class="invalid-feedback">Veuillez entrer le lieu de naissance de l'élève</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="matricule">Matricule de l'élève</label>
                                                            <input type="number" class="form-control" placeholder="Entrez le matricule de l'élève" value="" id="matricule" name="matricule" required>
                                                            <div class="invalid-feedback">Veuillez entrer le matricule de l'élève</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="classe">Classe de l'élève</label>
                                                            <select class="form-control" id="classe" name="classe" required>
                                                                <option>6eme</option>
                                                                <option>5eme</option>
                                                                <option>4eme</option>
                                                            </select>
                                                            <div class="invalid-feedback">Veuillez selectionner la classe de l'élève</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="fatherName">Nom complet du père</label>
                                                            <input type="text" class="form-control" placeholder="Entrez le nom complet du père" id="fatherName" value="" name="fatherName" required>
                                                            <div class="invalid-feedback">Veuillez entrer le nom complet du père</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="fatherPhone">Numero de téléphone du père</label>
                                                            <input type="number" class="form-control" placeholder="Entrez le numero de téléphone du père" value="" id="fatherPhone" name="fatherPhone" required>
                                                            <div class="invalid-feedback">Veuillez entrer le numero de téléphone du père</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="motherName">Nom complet de la mère</label>
                                                            <input type="text" class="form-control" placeholder="Entrez le nom complet de la mère" id="motherName" value="" name="motherName" required>
                                                            <div class="invalid-feedback">Veuillez entrer le nom complet de la mère</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="motherPhone">Numero de téléphone de la mère</label>
                                                            <input type="number" class="form-control" placeholder="Entrez le numero de téléphone du mère" value="" id="motherPhone" name="motherPhone" required>
                                                            <div class="invalid-feedback">Veuillez entrer le numero de téléphone de la mère</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="modal fade" id="deleteStudent" aria-hidden="true" aria-labelledby="deleteStudent" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h3 class="modal-title" id="deleteStudentLabel">Supprimer l'élève</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" class="needs-validation" novalidate>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <h2>Voulez-vous vraiment supprimer l'élève NOM_DE_L'ELEVE?</h2>
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

</x-layouts>
