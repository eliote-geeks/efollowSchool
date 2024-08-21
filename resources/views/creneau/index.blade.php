<base href="/">
<x-layouts>
    <div class="container">
        <h5 class="text-center my-4">Liste des Créneaux Horaires ({{ $classe->niveau->name}}) {{  $classe->name }}</h5>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createTimeSlotModal">
                <i class="fe fe-plus"></i> Ajouter un créneau horaire
            </button>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- Table des créneaux horaires -->
        <table class="table table-hover text-center" id="dataTableBasic">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Heure de Début</th>
                    <th>Heure de Fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timeslots as $timeslot)
                    <tr>
                        <td class="align-middle">{{ $timeslot->id }}</td>
                        <td class="align-middle">{{ $timeslot->start_time }}</td>
                        <td class="align-middle">{{ $timeslot->end_time }}</td>
                        <td class="align-middle">
                            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                data-bs-target="#editTimeSlotModal{{ $timeslot->id }}">
                                <i class="fe fe-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteTimeSlotModal{{ $timeslot->id }}">
                                <i class="fe fe-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal pour la création -->
        <div class="modal fade" id="createTimeSlotModal" tabindex="-1" aria-labelledby="createTimeSlotModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="createTimeSlotModalLabel">Créer un Créneau Horaire</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('timeslots.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="classe_id" value="{{ $classe->id }}">
                            <div class="form-group mb-3">
                                <label for="start_time" class="form-label">Heure de Début</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="end_time" class="form-label">Heure de Fin</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Créer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals pour l'édition -->
        @foreach ($timeslots as $timeslot)
            <div class="modal fade" id="editTimeSlotModal{{ $timeslot->id }}" tabindex="-1"
                aria-labelledby="editTimeSlotModalLabel{{ $timeslot->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="editTimeSlotModalLabel{{ $timeslot->id }}">Éditer le Créneau
                                Horaire</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('timeslots.update', $timeslot) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="start_time" class="form-label">Heure de Début</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control"
                                        value="{{ $timeslot->start_time }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="end_time" class="form-label">Heure de Fin</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control"
                                        value="{{ $timeslot->end_time }}" required>
                                </div>

                                <button type="submit" class="btn btn-warning">Mettre à Jour</button>
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
    </div>
</x-layouts>
