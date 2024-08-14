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

                                <li class="breadcrumb-item active" aria-current="page">Gestion des Requetes de paiements
                                </li>
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
                            <h2 class="mb-1">Liste des requetes de paiements pour le paiement {{ $payment->id }}</h2>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez visualiser
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
                                        <th scope="col">Ancien Montant</th>
                                        <th scope="col">Nouveau Montant</th>
                                        <th>Ancien Frais exigibles concernés</th>
                                        <th>Nouveau Frais exigibles concernés</th>
                                        <th>Reason</th>
                                        <th>Auteur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requetes as $req)
                                        <tr>
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ $req->student->first_name . ' ' . $req->student->last_name }}</td>
                                            <td>{{ $req->student->studentClasse->classe->niveau->name . ' ' . $req->student->studentClasse->classe->name }}
                                            </td>
                                            <td>{{ number_format($req->previousAmount) }}FCFA</td>
                                            <td>{{ number_format($req->newAmount) }}FCFA</td>
                                            <td>{{ \App\Models\Scolarite::find($req->previousScolarite)->name }}</td>
                                            <td>{{ \App\Models\Scolarite::find($req->newScolarite)->name }}</td>
                                            <td>{{ $req->reason }}</td>
                                            <td>{{ $req->user->name }}</td>
                                        </tr>
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
