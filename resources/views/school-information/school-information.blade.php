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
                        <a class="btn btn-primary rounded-pill ms-auto" data-bs-toggle="modal" href="#addSchoolYear" role="button">
                            <i class="fas fa-plus me-2"></i>
                            Créer une année scolaire
                        </a>
                    </div>
                        <p class="mb-0">
                        Sur cette page vous pouvez créer; visualiser ou modifier des années scolaires
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive" style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom de l'école</th>
                                        <th scope="col">Numéro de téléphone</th>
                                        <th>Masque du matricule</th>
                                        <th>Début de l'année scolaire</th>
                                        <th>Fin de l'année scolaire</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Collège Fapo</td>
                                        <td>+237 657 876 435</td>
                                        <td>CFP</td>
                                        <td>03 Septembre 2024</td>
                                        <td>26 Mai 2023</td>
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
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#seeMore" role="button">
                                                        <i class="fe fe-eye dropdown-item-icon"></i>
                                                        Voir plus d'informations
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
                                                <h3 class="modal-title" id="editSchoolYearLabel">Modifier l'année scolaire</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" class="needs-validation" novalidate>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <label class="form-label" for="schoolName">Nom de l'établissement</label>
                                                            <input type="text" class="form-control" placeholder="Entrez le nom de l'établissement" id="schoolName" name="schoolName" required>
                                                            <div class="invalid-feedback">Veuillez entrer le nom de l'établissement</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <label class="form-label" for="phone">Numero de téléphone de l'établissement</label>
                                                            <input type="number" class="form-control" placeholder="Entrez le numero de téléphone de l'établissement"  value="237658986345" id="phone" name="phone" required>
                                                            <div class="invalid-feedback">Veuillez entrer le numero de téléphone de l'établissement</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <label class="form-label" for="poBox">Boîte postale de l'établissement</label>
                                                            <input type="text" class="form-control" placeholder="Entrez la boîte postale de l'établissement"  value="BP-5624" id="poBox" name="poBox" required>
                                                            <div class="invalid-feedback">Veuillez entrer la boîte postale de l'établissement</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <label class="form-label" for="masque">Masque du matricule des élèves</label>
                                                            <input type="text" class="form-control" placeholder="Entrez le masque du matricule"  value="CFP-" id="masque" name="masque" required>
                                                            <div class="invalid-feedback">Veuillez entrer le masque du matricule</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="startDate">Début de l'année scolaire</label>
                                                            <input type="date" class="form-control"  value="2024-09-03" id="startDate" name="startDate" required>
                                                            <div class="invalid-feedback">Veuillez entrer la date de début de l'année scolaire</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="endDate">Fin de l'année scolaire</label>
                                                            <input type="date" class="form-control"  value="2025-05-26" id="endDate" name="endDate" required>
                                                            <div class="invalid-feedback">Veuillez entrer la date de la fin de l'année scolaire</div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="col-md-12 mb-4">
                                                            <div>
                                                                <!-- logo -->
                                                                <h5 class="mb-3">Choisissez le logo de l'établissement</h5>
                                                                <label for="img" class="img-thumbnail position-relative" style="height: 80px; width: 80px; cursor: pointer;">
                                                                    <img id="logoEdit" src="assets/images/blank_image.jpg" class=" w-100 h-100">
                                                                    <input class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100" type="file" accept="image/*" id="logoEdit" name="logoEdit" onchange="previewLogoEdit(this)" />
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Imprimer les cartes des élèves à partir de l'application</label>
                                                            </div>
                                                        </div>

                                                        <div class="print">
                                                            <div class="col-md-12 mb-4">
                                                                <div>
                                                                    <!-- logo -->
                                                                    <h5 class="mb-3">Choisissez la face recto de la carte</h5>
                                                                    <label for="img" class="img-thumbnail position-relative" style="height: 250px; width: 410px; cursor: pointer;">
                                                                        <img id="rectoEdit" src="assets/images/backgroundCard.png" class=" w-100 h-100">
                                                                        <input class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100" type="file" accept="image/*"  id="cardRecto" name="cardRecto" onchange="previewRectoEdit(this)" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-4">
                                                                <div>
                                                                    <!-- logo -->
                                                                    <h5 class="mb-3">Choisissez la face verso de la carte</h5>
                                                                    <label for="img" class="img-thumbnail position-relative" style="height: 250px; width: 410px; cursor: pointer;">
                                                                        <img id="versoEdit" src="assets/images/backgroundCard.png" class=" w-100 h-100">
                                                                        <input class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100" type="file" accept="image/*" id="cardVerso" name="cardVerso" onchange="previewVersoEdit(this)" />
                                                                    </label>
                                                                </div>
                                                            </div>
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


                                    <div class="modal fade" id="seeMore" aria-hidden="true" aria-labelledby="seeMore" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h3 class="modal-title" id="seeMoreLabel">Informations sur l'année scolaire</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" class="needs-validation" novalidate>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <label class="form-label" for="schoolName">Nom de l'établissement :  <label style="font-weight: bold; color: black;">Collège FAPO</label></label>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <label class="form-label" for="phone">Numero de téléphone de l'établissement :  <label style="font-weight: bold; color: black;">+237 652 786 654</label></label>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <label class="form-label" for="poBox">Boîte postale de l'établissement :  <label style="font-weight: bold; color: black;">BP-5435</label></label>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <label class="form-label" for="masque">Masque du matricule des élèves :  <label style="font-weight: bold; color: black;">CFP-</label></label>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <label class="form-label" for="startDate">Début de l'année scolaire :  <label style="font-weight: bold; color: black;">03 Septembre 2024</label></label>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-12">
                                                            <label class="form-label" for="endDate">Fin de l'année scolaire :  <label style="font-weight: bold; color: black;">26 Mai 2025</label></label>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="col-md-12 mb-4">
                                                            <div>
                                                                <!-- logo -->
                                                                <h5 class="mb-3">Logo de l'établissement :</h5>
                                                                <label for="img" class="img-thumbnail position-relative" style="height: 80px; width: 80px; cursor: pointer;" id="cardVerso" name="cardVerso">
                                                                    <img src="assets/images/blank_image.jpg" class=" w-100 h-100">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="print">
                                                            <div class="col-md-12 mb-4">
                                                                <div>
                                                                    <!-- logo -->
                                                                    <h5 class="mb-3">Face recto des cartes des élèves :</h5>
                                                                    <label for="img" class="img-thumbnail position-relative" style="height: 250px; width: 410px; cursor: pointer;">
                                                                        <img src="assets/images/backgroundCard.png" class=" w-100 h-100">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-4">
                                                                <div>
                                                                    <!-- logo -->
                                                                    <h5 class="mb-3">Face verso des cartes des élèves :</h5>
                                                                    <label for="img" class="img-thumbnail position-relative" style="height: 250px; width: 410px; cursor: pointer;">
                                                                        <img src="assets/images/backgroundCard.png" class=" w-100 h-100">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
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

    <div class="modal fade" id="addSchoolYear" aria-hidden="true" aria-labelledby="addSchoolYear" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addSchoolYearLabel">Créer une année scolaire</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="row">
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="schoolName">Nom de l'établissement</label>
                                <input type="text" class="form-control" placeholder="Entrez le nom de l'établissement" id="schoolName" name="schoolName" required>
                                <div class="invalid-feedback">Veuillez entrer le nom de l'établissement</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                            <label class="form-label" for="phone">Numero de téléphone de l'établissement</label>
                            <input type="number" class="form-control" placeholder="Entrez le numero de téléphone de l'établissement" id="phone" name="phone" required>
                            <div class="invalid-feedback">Veuillez entrer le numero de téléphone de l'établissement</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="poBox">Boîte postale de l'établissement</label>
                                <input type="text" class="form-control" placeholder="Entrez la boîte postale de l'établissement" id="poBox" name="poBox" required>
                                <div class="invalid-feedback">Veuillez entrer le nom de l'établissement</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                                <label class="form-label" for="masque">Masque du matricule des élèves</label>
                                <input type="text" class="form-control" placeholder="Entrez le masque du matricule" id="masque" name="masque" required>
                                <div class="invalid-feedback">Veuillez entrer le masque du matricule</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="startDate">Début de l'année scolaire</label>
                                <input type="date" class="form-control" id="startDate" name="startDate" required>
                                <div class="invalid-feedback">Veuillez entrer la date de début de l'année scolaire</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="endDate">Fin de l'année scolaire</label>
                                <input type="date" class="form-control" id="endDate" name="endDate" required>
                                <div class="invalid-feedback">Veuillez entrer la date de la fin de l'année scolaire</div>
                            </div>
                            <!-- input -->
                            <div class="col-md-12 mb-4">
                                <div>
                                    <!-- logo -->
                                    <h5 class="mb-3">Choisissez le logo de l'établissement</h5>
                                    <label for="img" class="img-thumbnail position-relative" style="height: 80px; width: 80px; cursor: pointer;">
                                        <img id="logoCreate" src="assets/images/blank_image.jpg" class=" w-100 h-100">
                                        <input class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100" type="file" accept="image/*" id="img" name="img" onchange="previewLogoCreate(this)" />
                                    </label>
                                </div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Imprimer les cartes des élèves à partir de l'application</label>
                            </div>
                            </div>

                            <div class="print">
                                <div class="col-md-12 mb-4">
                                    <div>
                                        <!-- logo -->
                                        <h5 class="mb-3">Choisissez le modèle de la face recto de la carte</h5>
                                        <label for="img" class="img-thumbnail position-relative" style="height: 250px; width: 410px; cursor: pointer;">
                                        <img id="rectoCreate" src="assets/images/backgroundCard.png" class=" w-100 h-100">
                                        <input class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100" type="file" accept="image/*" id="img" name="img" onchange="previewRectoCreate(this)" />
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div>
                                        <!-- logo -->
                                        <h5 class="mb-3">Choisissez le modèle de la face verso de la carte</h5>
                                        <label for="img" class="img-thumbnail position-relative" style="height: 250px; width: 410px; cursor: pointer;">
                                        <img id="versoCreate" src="assets/images/backgroundCard.png" class=" w-100 h-100">
                                        <input class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100" type="file" accept="image/*" id="img" name="img" onchange="previewVersoCreate(this)" />
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

</x-layouts>