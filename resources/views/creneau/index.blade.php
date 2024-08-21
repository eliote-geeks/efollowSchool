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

                                <li class="breadcrumb-item active" aria-current="page">Gestion des niveaux</li>
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
                        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                            <h2 class="mb-1">Liste des créneaux ({{ $classe->niveau->name}}) {{  $classe->name }}</h2>
                            <div class="ms-auto">
                                <a class="btn btn-primary rounded-pill ms-auto mt-3 mt-md-0" data-bs-toggle="modal" href="#createTimeSlotModal"
                                    role="button">
                                    <i class="fe fe-plus me-2"></i>
                                    Créer un créneau
                                </a>
                            </div>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez créer, visualiser supprimer ou modifier des créneaux horaires
                        </p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-card">

                            <!-- Table des créneaux horaires -->
                            <table class="table table-hover" id="dataTableBasic">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Heure de Début</th>
                                        <th>Heure de Fin</th>
                                        <th class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($timeslots as $timeslot)
                                        <tr>
                                            <td class="align-middle">{{ $timeslot->start_time }}</td>
                                            <td class="align-middle">{{ $timeslot->end_time }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-ghost btn-sm me-2 d-flex align-items-center" data-bs-toggle="modal"
                                                        data-bs-target="#editTimeSlotModal{{ $timeslot->id }}">
                                                        <i class="fe fe-edit me-1"></i>
                                                        Modifier le créneau
                                                    </button>
                                                    <button class="btn btn-ghost btn-sm d-flex align-items-center" data-bs-toggle="modal"
                                                        data-bs-target="#deleteTimeSlotModal{{ $timeslot->id }}">
                                                        <i class="fe fe-trash me-1"></i>
                                                        Supprimer le créneau
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

   

        <div class="modal fade" id="createTimeSlotModal" aria-hidden="true" aria-labelledby="createTimeSlotModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="createTimeSlotModalLabel">Créer un créneau horaire</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('timeslots.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="classe_id" value="{{ $classe->id }}">
                        <div class="modal-body">
                            <div class="row">
                                <!-- input -->
                                <div class="mb-5 col-md-10">
                                    <label for="start_time" class="form-label">Heure de Début</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control" required>
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-10">
                                    <label for="end_time" class="form-label">Heure de Fin</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control" required>
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


        <!-- Modals pour l'édition -->
        @foreach ($timeslots as $timeslot)

             <div class="modal fade" id="deleteTimeSlotModal{{ $timeslot->id }}" aria-hidden="true"
                aria-labelledby="deleteTimeSlotModal{{ $timeslot->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="deleteTimeSlotModal{{ $timeslot->id }}Label">Supprimer le créneau
                            </h3>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        {{-- <form method="post" class="needs-validation"> --}}
                        <div class="modal-body">
                            <div class="row">
                                <h2>Voulez-vous vraiment supprimer ce créneau?</h2>
                            </div>
                        </div>
                        {{-- </form> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Annuler</button>
                            <form action="{{ route('timeslots.destroy', $timeslot) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-danger">supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal pour la suppression -->
            <div class="modal fade" id="deleteTimeSlotModal{{ $timeslot->id }}" tabindex="-1"
                aria-labelledby="deleteTimeSlotModalLabel{{ $timeslot->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteTimeSlotModalLabel{{ $timeslot->id }}">Supprimer le
                                Créneau Horaire</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Êtes-vous sûr de vouloir supprimer ce créneau horaire?</p>
                            <form action="{{ route('timeslots.destroy', $timeslot) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Annuler</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</x-layouts>
