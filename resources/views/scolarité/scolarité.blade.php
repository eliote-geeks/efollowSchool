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

                                <li class="breadcrumb-item active" aria-current="page">Gestion des frais exigibles</li>
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
                        <h2 class="mb-1">Liste des frais exigibles</h2>
                        <a class="btn btn-primary rounded-pill ms-auto" data-bs-toggle="modal" href="#addCosts" role="button">
                            <i class="fas fa-plus me-2"></i>
                            Ajouter des frais exigibles
                        </a>
                    </div>
                        <p class="mb-0">
                        Sur cette page vous pouvez créer, modifier ou supprimer des informations relatives à la scolarité ou
                        <p> tout autre frais exigible</p>
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive" style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Tranche</th>
                                        <th>Montant</th>
                                        <th>Niveau</th>
                                        <th>Début du contrôle</th>
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Inscription</td>
                                        <td>1</td>
                                        <td>45000FCFA</td>
                                        <td>6EME</td>
                                        <td>25 Septembre 2024</td>
                                        <td scope="col" class="text-center d-flex justify-content-center">
                                            <a class="btn btn-ghost btn-sm rounded-circle me-2 d-flex align-items-center" data-bs-toggle="modal" href="#editCosts" role="button">
                                                <i class="fe fe-edit me-1"></i>
                                                Modifier
                                            </a>
                                            <a class="btn btn-ghost btn-sm rounded-circle d-flex align-items-center" data-bs-toggle="modal" href="#deleteCosts" role="button">
                                                <i class="fe fe-trash me-1"></i>
                                                Supprimer
                                            </a>
                                        </td>
                                    </tr>


                                    <div class="modal fade" id="editCosts" aria-hidden="true" aria-labelledby="editCosts" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h3 class="modal-title" id="editCostsLabel">Modifier les frais exigibles</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="#" class="needs-validation">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!-- input -->
                                                            <div class="mb-5 col-md-6">
                                                                <label class="form-label" for="costsName">Nom des frais</label>
                                                                <input type="text" class="form-control" placeholder="Entrez le nom des frais exigibles" value="" id="costsName" name="costsName" required>
                                                                <div class="invalid-feedback">Veuillez entrer le nom du frais exigible</div>
                                                            </div>
                                                            <!-- input -->
                                                            <div class="mb-5 col-md-6">
                                                                <label class="form-label" for="tranche">Tranche des frais</label>
                                                                <input type="number" class="form-control" placeholder="Entrez la tranche de paiement des frais" value="" id="tranche" name="tranche" required>
                                                                <div class="invalid-feedback">Veuillez entrer la tranche du paiement</div>
                                                            </div>
                                                            <!-- input -->
                                                            <div class="mb-5 col-md-6">
                                                                <label class="form-label" for="amount">Montant des frais en FCFA</label>
                                                                <input type="text" class="form-control" placeholder="Entrez le montant des frais exigibles" value="" id="amount" name="amount" onInput="formatAmountCosts(this)" onkeypress="return formatAmountCosts(this, event)" required>
                                                                <div class="invalid-feedback">Veuillez entrer le montant du paiement</div>
                                                            </div>
                                                            <!-- input -->
                                                            <div class="mb-5 col-md-6">
                                                            <label class="form-label" for="deadline">Date limite du paiment des frais</label>
                                                                <input type="date" class="form-control" value="" id="deadline" name="deadline" required>
                                                                <div class="invalid-feedback">Veuillez entrer la date limite du paiement des frais exigibles</div>
                                                            </div>
                                                            <!-- input -->
                                                            <div class="mb-5 col-md-6">
                                                                <label class="form-label" for="level">Niveau auquel seront appliqués les frais exigibles</label>
                                                                <select multiple class="form-control" id="level" name="level" required>
                                                                    <option value="5eme">5eme</option>
                                                                    <option value="4eme">4eme</option>
                                                                    <option value="3eme">3eme</option>
                                                                </select>
                                                                <div class="invalid-feedback">Veuillez selectionner le niveau auquel seront appliqués les frais</div>
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
                                    
                                    <div class="modal fade" id="deleteCosts" aria-hidden="true" aria-labelledby="deleteCosts" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="deleteCostsLabel">Supprimer les frais exigibles</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" class="needs-validation" novalidate>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <h2>Voulez-vous vraiment supprimer ces frais exigibles?</h2>
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
      
      
    <div class="modal fade" id="addCosts" aria-hidden="true" aria-labelledby="addCosts" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="addCostsLabel">Créer des frais exigibles</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="#" class="needs-validation">
                    <div class="modal-body">
                        <div class="row">
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="costsName">Nom des frais</label>
                                <input type="text" class="form-control" placeholder="Entrez le nom des frais exigibles" id="costsName" name="costsName" required>
                                <div class="invalid-feedback">Veuillez entrer le nom du frais exigible</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="tranche">Tranche des frais</label>
                                <input type="number" class="form-control" placeholder="Entrez la tranche de paiement des frais" id="tranche" name="tranche" required>
                                <div class="invalid-feedback">Veuillez entrer la tranche du paiement</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="amount">Montant des frais en FCFA</label>
                                <input type="text" class="form-control" placeholder="Entrez le montant des frais exigibles" id="amount" name="amount" onInput="formatAmountCosts(this)" onkeypress="return formatAmountCosts(this, event)" required>
                                <div class="invalid-feedback">Veuillez entrer le montant du paiement</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                            <label class="form-label" for="deadline">Date limite du paiment des frais</label>
                                <input type="date" class="form-control" id="deadline" name="deadline" required>
                                <div class="invalid-feedback">Veuillez entrer la date limite du paiement des frais exigibles</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="level">Niveau auquel seront appliqués les frais exigibles</label>
                                <select multiple class="form-control" id="level" name="level" required>
                                    <option value="5eme">5eme</option>
                                    <option value="4eme">4eme</option>
                                    <option value="3eme">3eme</option>
                                </select>
                                <div class="invalid-feedback">Veuillez selectionner le niveau auquel seront appliqués les frais</div>
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
