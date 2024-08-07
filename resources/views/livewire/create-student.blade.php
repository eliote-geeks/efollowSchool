<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Créer un élève</h1>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-12">
            <!-- card -->
            <form class="needs-validation" novalidate>
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h2 class="mb-4 text-secondary">Remplir le formulaire</h2>

                        <!-- row -->
                        <div class="row gx-3">

                            <!-- input -->
                            <div class="col-md-12 col-12 mb-4 position-relative">
                                <h5 class="mb-2">Photo de l'élève</h5>
                                <label for="img" class="img-thumbnail position-relative"
                                    style="height: 100px; width: 100px; cursor: pointer;">
                                    <img id="StudentImage" src="assets/images/blank_image.jpg" class=" w-100 h-100">
                                    <input
                                        class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100"
                                        type="file" accept="image/*" id="img" name="img"
                                        onchange="previewImage(this)" />
                                </label>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="firstName">Nom de l'élève</label>
                                <input type="text" class="form-control" placeholder="Entrez le nom de l'élève"
                                    id="firstName" name="firstName" required>
                                <div class="invalid-feedback">Veuillez entrer le nom de l'élève</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="lastName">Prénom de l'élève</label>
                                <input type="text" class="form-control" placeholder="Entrez le prénom de l'élève"
                                    id="lastName" name="lastName" required>
                                <div class="invalid-feedback">Veuillez entrer le prénom de l'élève</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="birthday">Date de naissance</label>
                                <input type="date" class="form-control" placeholder="Entrez le prénom de l'élève"
                                    id="birthday" name="birthday" required>
                                <div class="invalid-feedback">Veuillez entrer la date de naissance de l'élève</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="birthPlace">Lieu de naissance</label>
                                <input type="text" class="form-control"
                                    placeholder="Entrez le lieu de naissance de l'élève" id="birthPlace"
                                    name="birthPlace" required>
                                <div class="invalid-feedback">Veuillez entrer le lieu de naissance de l'élève</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="matricule">Matricule de l'élève</label>
                                <input type="number" class="form-control" placeholder="Entrez le matricule de l'élève"
                                    id="matricule" name="matricule" required>
                                <div class="invalid-feedback">Veuillez entrer le matricule de l'élève</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="classe">Classe de l'élève</label>
                                <select class="form-control" id="classe" name="classe" required>
                                    <option value="">Selectionnez la classe de l'élève</option>
                                    <option>6eme</option>
                                    <option>5eme</option>
                                    <option>4eme</option>
                                </select>
                                <div class="invalid-feedback">Veuillez selectionner la classe de l'élève</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="FatherName">Nom complet du père</label>
                                <input type="text" class="form-control" placeholder="Entrez le nom complet du père"
                                    id="FatherName" name="FatherName" required>
                                <div class="invalid-feedback">Veuillez entrer le nom complet du père</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="fatherPhone">Numero de téléphone du père</label>
                                <input type="number" class="form-control"
                                    placeholder="Entrez le numero de téléphone du père" id="fatherPhone"
                                    name="fatherPhone" required>
                                <div class="invalid-feedback">Veuillez entrer le numero de téléphone du père</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="motherName">Nom complet de la mère</label>
                                <input type="text" class="form-control"
                                    placeholder="Entrez le nom complet du père" id="motherName" name="motherName"
                                    required>
                                <div class="invalid-feedback">Veuillez entrer le nom complet de la mère</div>
                            </div>
                            <!-- input -->
                            <div class="mb-5 col-md-6">
                                <label class="form-label" for="motherPhone">Numero de téléphone de la mère</label>
                                <input type="number" class="form-control"
                                    placeholder="Entrez le numero de téléphone du père" id="motherPhone"
                                    name="motherPhone" required>
                                <div class="invalid-feedback">Veuillez entrer le numero de téléphone de la mère
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="student-card">
                <div class="row text-warning">
                    <div class="col-6 text-start">
                        <p class="mb-0 text-center">République du Cameroun</p>
                        <p class="mb-0 text-center">Paix-Travail-Patrie</p>
                        <p class="mb-0 text-center">Ministère de l'Enseignement Secondaire</p>
                        <p class="mb-0 text-center">BP: 845</p>
                        <p class="mb-0 text-center">TEL: 223 43 67 64</p>
                    </div>
                    <div class="col-6 text-end">
                        <p class="mb-0 text-center">Republic of Cameroon</p>
                        <p class="mb-0 text-center">Peace-Work-Fatherland</p>
                        <p class="mb-0 text-center">Ministry of Secondary Education</p>
                        <p class="mb-0 text-center">PO BOX: 845</p>
                        <p class="mb-0 text-center">Ph: 223 43 67 64</p>
                    </div>
                </div>
                <div class="row my-5 student-card-infos">
                    <div class="col-6">
                        <p class="mb-0"><span class="me-5 text-primary">Nom :</span>John Doe</p>
                        <p class="mb-0"><span class="me-4 text-primary">Prénom :</span>Jane Doe</p>
                        <p class="mb-0"><span class="me-4 text-primary">Né(e) le :</span>01/01/2005</p>
                        <p class="mb-0"><span class="me-3 text-primary">Matricule :</span>12345678</p>
                        <p class="mb-0"><span class="me-5 text-primary">Classe :</span>Terminale</p>
                    </div>
                    <div class="col-6 text-end">
                        <img src="assets/images/blank_image.jpg" class="student-photo">
                    </div>
                </div>
                <div class="logo"></div>
                <h4 class="text-center text-success" style="font-weight: bold;">Lycée Bilingue de Yaoundé</h4>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="offset-xl-4 col-xl-6 col-12">
            <!-- card -->
            <div class="card mb-4">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex justify-content-start">
                        <!-- buttons -->
                        <button class="btn btn-primary" type="submit">Suivant</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

