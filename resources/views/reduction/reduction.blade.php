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
                            <h2 class="mb-1">Liste des réductions</h2>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez visualiser ou modifier des réductions
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive"
                                style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nom de l'élève</th>
                                        <th>Classe de l'élève</th>
                                        <th scope="col">Montant de la réduction</th>
                                        <th>Frais exigibles concernés</th>
                                        <th>Statut</th>
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($remises as $remise)
                                        <tr>
                                            <td>{{ $remise->student->first_name . ' ' . $remise->student->last_name }}</td>
                                            <td>{{ $remise->student->studentClasse->classe->niveau->name . ' ' . $remise->student->studentClasse->classe->name }}
                                            </td>
                                            <td>{{ number_format($remise->rest) }}FCFA</td>
                                            <td>{{ $remise->scolarite->name }}</td>
                                            <td>
                                                @if ($remise->status == 0)
                                                    <a href="{{ route('statusRemise',$remise) }}" class="btn btn-primary">Appliquer la réduction</a>
                                                @else
                                                    <a href="{{ route('statusRemise',$remise) }}" class="btn btn-danger">Retirer la réduction</a>
                                                @endif

                                            </td>
                                            <td scope="col" class="text-center">
                                                <span class="dropdown dropstart">
                                                    <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                        href="#" role="button" id="courseDropdown2"
                                                        data-bs-toggle="dropdown" data-bs-offset="-20,20"
                                                        aria-expanded="false">
                                                        <i class="fe fe-list fs-3"></i>
                                                    </a>
                                                    <span class="dropdown-menu" aria-labelledby="courseDropdown2">
                                                        <span class="dropdown-header">Action</span>
                                                        {{-- <a class="dropdown-item" data-bs-toggle="modal" href="#seeMore{{ $remise->id }}"
                                                            role="button">
                                                            <i class="fe fe-eye dropdown-item-icon"></i>
                                                            Voir plus d'informations
                                                        </a> --}}
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            href="#editReduction{{ $remise->id }}" role="button">
                                                            <i class="fe fe-edit dropdown-item-icon"></i>
                                                            Modifier
                                                        </a>
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            href="#deleteReduction{{ $remise->id }}" role="button">
                                                            <i class="fe fe-trash dropdown-item-icon"></i>
                                                            Supprimer
                                                        </a>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editReduction{{ $remise->id }}" aria-hidden="true"
                                            aria-labelledby="editReduction" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editReductionLabel">Modifier
                                                            la réduction de l'élève <b>{{{ $remise->student->name }}}</b></h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" method="POST"
                                                        action="{{ route('remiseEdit',$remise) }}" enctype="multipart/form-data">
                                                        
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
                                                                    <label class="form-label" for="schoolName">Montant
                                                                        de la réduction en FCFA</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le montant de la réduction"
                                                                        id="amount" name="amount" value="{{ $remise->rest }}"
                                                                        onInput="formatAmountCosts(this)"
                                                                        onkeypress="return formatAmountCosts(this, event)"
                                                                        required>
                                                                    <div class="invalid-feedback">Veuillez entrer le
                                                                        montant de la réduction</div>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="phone">Frais
                                                                        exigibles auxquels
                                                                        sera appliqué le moratoire</label>
                                                                    <select class="form-control" id="frais"
                                                                        name="scolarite" required>
                                                                        @foreach ($scolarites as $scolarite)
                                                                        <option
                                                                            @if ($scolarite->id == $remise->scolarite_id) selected @endif
                                                                            value="{{ $scolarite->id }}">
                                                                            {{ $scolarite->name }}</option>
                                                                    @endforeach
                                                                    </select>
                                                                    <div class="invalid-feedback">Veuillez selectionner
                                                                        les frais exigibles auxquels
                                                                        sera appliqué le moratoire</div>
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

                                        <div class="modal fade" id="deleteReduction{{ $remise->id }}" aria-hidden="true"
                                            aria-labelledby="deleteReduction" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="deleteReductionLabel">Supprimer la
                                                            réduction de l'élève <b>{{ $remise->student->first_name }}</b></h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    {{-- <form method="post" class="needs-validation" novalidate> --}}
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <h2>Voulez-vous vraiment supprimer cette réduction?</h2>
                                                        </div>
                                                    </div>
                                                    {{-- </form> --}}
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annuler</button>
                                                        
                                                            <a href="{{ route('delRemise',$remise) }}" 
                                                                class="btn btn-danger">supprimer</a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- <div class="modal fade" id="seeMore{{ $remise->id }}" aria-hidden="true"
                                            aria-labelledby="seeMore" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="seeMoreLabel">Informations sur
                                                            la remise</h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" novalidate>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="masque">Nom de
                                                                        l'élève : <label
                                                                            style="font-weight: bold; color: black;">PAUMAIN
                                                                            BRICE</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="masque">Classe
                                                                        l'élève : <label
                                                                            style="font-weight: bold; color: black;">6eme</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="phone">Montant
                                                                        de la réduction : <label
                                                                            style="font-weight: bold; color: black;">35000FCFA</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="phone">Frais
                                                                        exigibles concernés : <label
                                                                            style="font-weight: bold; color: black;">Inscription</label></label>
                                                                </div>
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label"
                                                                        for="masque">Image/document de la décision
                                                                        administrative :
                                                                        <a href="assets/images/blank_image.jpg"
                                                                            download="nom_fichier.jpg"
                                                                            style="margin-left: 6px; font-weight: bold;">
                                                                            <i class="bi bi-download"></i> Télécharger
                                                                        </a></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="modal-footer">
                                                        <!-- Bouton Fermer -->
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fermer</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div> --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts>
