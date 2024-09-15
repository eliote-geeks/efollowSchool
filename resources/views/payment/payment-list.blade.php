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
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">Gestion des Paiements</li>
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
                            <h2 class="mb-1">Liste des Paiements</h2>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez visualiser ou modifier des Paiements
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">
                            <table id="dataTableBasic" class="table table-hover align-middle table-responsive"
                                style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <td>ID Paiement</td>
                                        <th scope="col">Nom de l'élève</th>
                                        <th>Classe de l'élève</th>
                                        <th scope="col">Montant</th>
                                        <th>Frais exigibles concernés</th>
                                        <th>Auteur</th>
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $pay)
                                        <tr>
                                            <td>{{ $pay->id }}</td>
                                            <td>{{ $pay->student->first_name . ' ' . $pay->student->last_name }}</td>
                                            <td>{{ $pay->student->studentClasse->classe->niveau->name . ' ' . $pay->student->studentClasse->classe->name }}
                                            </td>
                                            <td>{{ number_format($pay->amount) }}FCFA</td>
                                            <td>{{ $pay->scolarite->name }}</td>
                                            <td>
                                                {{ $pay->user->name }}

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
                                                        
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            href="#editReduction{{ $pay->id }}" role="button">
                                                            <i class="fe fe-edit dropdown-item-icon"></i>
                                                            Modifier
                                                        </a>
                                                        <a class="dropdown-item" 
                                                            href="{{ route('requetesShow',$pay) }}">
                                                            <i class="fe fe-eye dropdown-item-icon"></i>
                                                           Afficher les requetes de modification
                                                        </a>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editReduction{{ $pay->id }}" aria-hidden="true"
                                            aria-labelledby="editReduction" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editReductionLabel">Modifier
                                                            le paiement de l'élève <b>{{{ $pay->student->name }}}</b></h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" class="needs-validation" method="POST"
                                                        action="{{ route('payment.update',$pay) }}" enctype="multipart/form-data">
                                                        @method('PATCH')
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
                                                                <input type="hidden" name="student" value="{{ $pay->student->id }}">
                                                                <!-- input -->
                                                                <div class="mb-5 col-md-12">
                                                                    <label class="form-label" for="schoolName">Montant
                                                                        du payment modifié en FCFA</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Entrez le montant du payment modifié"
                                                                        id="amount" name="amount" 
                                                                        onInput="formatAmountCosts(this)"
                                                                        onkeypress="return formatAmountCosts(this, event)"
                                                                        required>
                                                                    <div class="invalid-feedback">Veuillez entrer le
                                                                        Montant du payment modifié en FCFA</div>
                                                                        <small>Ancien Montant: {{ number_format($pay->amount) }}FCFA</small>
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
                                                                            @if ($scolarite->id == $pay->scolarite_id) selected @endif
                                                                            value="{{ $scolarite->id }}">
                                                                            {{ $scolarite->name }}</option>
                                                                    @endforeach
                                                                    </select>
                                                                    <div class="invalid-feedback">Veuillez selectionner
                                                                        les frais exigibles auxquels
                                                                        sera appliqué le moratoire</div>
                                                                </div>

                                                                <!-- Textarea -->
 <div class="mb-3">
    <label for="textarea-input" class="form-label">Textarea</label>
    <textarea class="form-control" name="reason" placeholder="Reason de la modification" id="textarea-input" rows="5"></textarea>
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

                                        <div class="modal fade" id="deleteReduction{{ $pay->id }}" aria-hidden="true"
                                            aria-labelledby="deleteReduction" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="deleteReductionLabel">Supprimer la
                                                            réduction de l'élève <b>{{ $pay->student->first_name }}</b></h3>
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
                                                    {{-- <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annuler</button>
                                                        
                                                            <a href="{{ route('delRemise',$pay) }}" 
                                                                class="btn btn-danger">supprimer</a>
                                                        
                                                    </div> --}}
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

</x-layouts>
