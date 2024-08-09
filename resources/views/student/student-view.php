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

                                <li class="breadcrumb-item active" aria-current="page">Informations sur l'élève</li>
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
                            <h2 class="mb-1">Informations sur NOM_DE_L'ELEVE</h2>
                            <a class="btn btn-secondary rounded-pill ms-auto" data-bs-toggle="modal" href="#desactivate" role="button">
                                Désactiver le compte de l'élève
                            </a>
                        <!--    <a class="btn btn-success rounded-pill ms-auto" data-bs-toggle="modal" href="#addClassroom" role="button">
                                Activer le compte de l'élève
                            </a>    -->
                        </div>
                    </div>
                    <!-- table  -->
                    <div class="card-body">

                        <div class="d-flex align-items-center">
                            <div class="position-relative">
                                <label for="img" class="img-thumbnail position-relative" style="height: 150px; width: 150px; cursor: pointer;">
                                    <img id="studentImage" src="blank_image.jpg" class=" w-100 h-100">
                                </label>
                            </div>
                            <div class="ms-4" style=" font-weight: bold;">
                                <h2 class="mb-0 text-warning fs-2">PAULAIN BRICE</h2>
                                <p class="mb-1 fs-3" style="color: black;">MATRICULE_ELEVE</p>
                                <span class="text-primary lh-1 d-flex align-baseline fs-4">
                                    6EME A
                                </span>
                            </div>
                        </div>
                        <div class="border-top row mt-3 border-bottom mb-3 g-0 mb-7">
                            <div class="col">
                                <div class="pe-1 ps-2 py-3 fs-4">
                                    <h5 class="mb-4">Date de naissance: DATE_DE_NAISSANCE</h5>
                                    <span>Lieu de naissance: LIEU_DE_NAISSANCE</span>
                                </div>
                            </div>
                            <div class="col border-start">
                                <div class="pe-1 ps-3 py-3 fs-4">
                                    <h5 class="mb-4">Nom du père: NOM_DU_PERE</h5>
                                    <span>Téléphone du père: +237 678 987 056</span>
                                </div>
                            </div>
                            <div class="col border-start">
                                <div class="pe-1 ps-3 py-3 fs-4">
                                    <h5 class="mb-4">Nom de la mère: NOM_DE_LA_MERE</h5>
                                    <span>Téléphone de la mère: +237 678 987 056</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div id="basic" class="mb-1">
                                    <h2 class="fw-semibold">Détails sur la scolarité par année scolaire:</h2>
                                </div>
                                <div class="mb-8">
                                    <ul class="nav nav-line-bottom mb-3" id="pills-tab-basic" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active fs-4" id="pills-dropdown-basic-design-tab" data-bs-toggle="pill" href="#pills-dropdown-basic-design" 
                                            role="tab" aria-controls="pills-dropdown-basic-design" aria-selected="true">2024-2025</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-4" id="pills-dropdown-basic-html-tab" data-bs-toggle="pill" href="#pills-dropdown-basic-html" 
                                            role="tab" aria-controls="pills-dropdown-basic-html" aria-selected="false">2025-2026</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent-basic">
                                        <div class="tab-pane tab-example-design fade show fs-4 active" id="pills-dropdown-basic-design" role="tabpanel" aria-labelledby="pills-dropdown-basic-design-tab">
                                            Informations 2024-2025
                                        </div>
                                        <div class="tab-pane tab-example-html fade fs-4 " id="pills-dropdown-basic-html" role="tabpanel" aria-labelledby="pills-dropdown-basic-html-tab">
                                            Informations 2025-2026
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                
            </div>

        </div>

    </section>   
        
    <div class="modal fade" id="desactivate" aria-hidden="true" aria-labelledby="desactivate" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="activatesLabel">Désactiver le compte de l'élève</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="row">
                            <h2>Voulez-vous vraiment désactiver le compte de NOM_DE_L'ELEVE?</h2>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">désactiver</button>
                </div>
            </div>
        </div>
    </div>


</x-layouts>
