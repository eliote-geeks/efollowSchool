<base href="/">
<x-layouts>
    <style>
        .table thead th {
            position: sticky;
            top: 0;
            background-color: white;
            /* Couleur de fond de l'en-tête */
            z-index: 1000;
            /* S'assure que l'en-tête reste au-dessus des autres éléments */
            box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
            /* Optionnel : ajout d'une ombre pour un meilleur effet visuel */
        }
    </style>

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
                                    <a href="javascript:;">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">Gestion des emplois de temps</li>
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
                            <h3 class="mb-1">Emploi du temps de ({{ $classe->niveau->name }}) {{ $classe->name }} de l'année
                                {{ \Carbon\Carbon::parse($schoolInformation->start)->format('Y') . '-' . \Carbon\Carbon::parse($schoolInformation->end)->format('Y') }}</h3>
                            <div class="ms-auto">
                                <a class="btn btn-primary rounded-pill ms-auto mt-3 mt-md-0" 
                                    href="{{ route('historiquePresence', $classe) }}" role="button">
                                    <i class="bi bi-person-check fs-4 me-2"></i>
                                    Historique des présences
                                </a>
                                <a class="btn btn-primary rounded-pill ms-auto mt-3 mt-md-0" 
                                    href="{{ route('historiqueAbsence', $classe) }}" role="button">
                                    <i class="bi bi-person-x fs-4 me-2"></i>
                                    Historique des absences
                                </a>
                            </div>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez personnaliser l'emploi du temps
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">

                        <!-- Emploi du Temps -->
                        <table class="table table-hover text-center mb-6">
                            <thead class="thead-light">
                                <tr>
                                    <th>Horaires</th>
                                    <th>Lundi</th>
                                    <th>Mardi</th>
                                    <th>Mercredi</th>
                                    <th>Jeudi</th>
                                    <th>Vendredi</th>
                                    <th>Samedi</th>
                                    <th>Dimanche</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timeSlots as $timeSlot)
                                    <tr>
                                        <td class="align-middle">{{ \Carbon\Carbon::parse($timeSlot->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($timeSlot->end_time)->format('H:i') }}</td>
                                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                            <td class="align-middle">
                                                @php
                                                    $schedule = $schedules
                                                        ->where('time_slot_id', $timeSlot->id)
                                                        ->where('day_of_week', $day)
                                                        ->first();
                                                @endphp

                                                @if ($schedule)

                                                    <div class="mb-1" style="text-align: right;">
                                                        <span class="dropdown dropstart">
                                                            <a class="btn-icon btn btn-ghost btn-sm"
                                                                href="#" role="button" id="courseDropdown2"
                                                                data-bs-toggle="dropdown" data-bs-offset="-20,20"
                                                                aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </a>
                                                            <span class="dropdown-menu" aria-labelledby="courseDropdown2">
                                                                <span class="dropdown-header">Action</span>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('attendanceStudent', $schedule) }}" role="button">
                                                                    <i class="fe fe-bell dropdown-item-icon"></i>
                                                                    Faire l'appel
                                                                </a>
                                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editScheduleModal{{ $schedule->id }}"
                                                                    role="button">
                                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                                    Modifier le cours
                                                                </a>
                                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteScheduleModal{{ $schedule->id }}"
                                                                    role="button">
                                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                                    Supprimer le cours
                                                                </a>
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div>
                                                        <small>{{ Str::limit($schedule->teacher->user->name, 10) }}</small><br>
                                                        <small class="text-muted">{{ $schedule->subject }}</small>
                                                    </div>
                                                    
                                                @else
                                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                                        data-bs-target="#addScheduleModal{{ $timeSlot->id }}{{ $day }}">
                                                        <i class="fe fe-plus"></i>
                                                    </button>

                                                    <!-- Modal pour ajouter un emploi du temps -->

                                                    <div class="modal fade" style="text-align: left;"
                                                        id="addScheduleModal{{ $timeSlot->id }}{{ $day }}" aria-hidden="true" 
                                                        aria-labelledby="addScheduleModal{{ $timeSlot->id }}{{ $day }}" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title" id="addScheduleModal{{ $timeSlot->id }}{{ $day }}Label">Programmer un cours pour {{ $day }}</h3>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <form action="{{ route('schedules.store') }}" method="POST"
                                                                        autocomplete="off">
                                                                        @csrf
                                                                        <input type="hidden" name="time_slot_id"
                                                                            value="{{ $timeSlot->id }}">
                                                                        <input type="hidden" name="day_of_week"
                                                                            value="{{ $day }}">
                                                                        <input type="hidden" name="class_id"
                                                                        value="{{ $classe->id }}">

                                                                        <div class="row">
                                                                            <!-- input -->
                                                                            <div class="mb-5 col-md-10">
                                                                                <label for="start_time" class="form-label">Code de la matière</label>
                                                                                <input type="text" name="subject"  class="form-control" required>
                                                                            </div>
                                                                            <!-- input -->
                                                                            <div class="mb-5 col-md-10">
                                                                                <label for="end_time" class="form-label">Professeur</label>
                                                                                <select name="teacher" class="form-control" required>
                                                                                    @foreach ($teachers as $teacher)
                                                                                        <option value="{{ $teacher->id }}">
                                                                                        {{ $teacher->user->name }} </option>
                                                                                    @endforeach
                                                                                </select>
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
                                                    </div>

                                                    
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-primary" onclick="printPage()">
                            <i class="bi bi-printer fs-4 me-2"></i>Imprimer
                        </button>

                        <script>
                            function printPage() {
                                // Sélection des éléments à masquer
                                const buttons = document.querySelectorAll('a, button');
            
                                // Masquer les boutons et liens
                                buttons.forEach(button => {
                                    button.style.display = 'none';
                                });
            
                                // Lancer l'impression
                                window.print();
            
                                // Réafficher les boutons après l'impression
                                buttons.forEach(button => {
                                    button.style.display = 'inline-block';
                                });
                            }
                        </script>
                        
                        @foreach ($schedules as $schedule)
                            
                            <!-- Modal pour l'édition -->
                            <div class="modal fade" style="text-align: left;"
                                id="editScheduleModal{{ $schedule->id }}" aria-hidden="true" 
                                aria-labelledby="editScheduleModal{{ $schedule->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="editScheduleModal{{ $schedule->id }}Label">
                                            Modifier l'emploi du temps</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" 
                                            aria-label="Close"></button>
                                        </div>

                                            <div class="modal-body">

                                                <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="class_id" value="{{ $classe->id }}">

                                                    <div class="row">
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-10">
                                                            <label for="start_time" class="form-label">Code de la matière</label>
                                                            <input type="text" name="subject"  value="{{ $schedule->subject }}"
                                                            class="form-control" required>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-10">
                                                            <label for="end_time" class="form-label">Horaire</label>
                                                            <select name="time_slot_id" class="form-control" required>
                                                                @foreach ($timeSlots as $timeSlot)
                                                                    <option value="{{ $timeSlot->id }}"
                                                                        @if ($timeSlot->id == $schedule->time_slot_id) selected @endif>
                                                                        {{ $timeSlot->start_time }} - {{ $timeSlot->end_time }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-10">
                                                            <label for="end_time" class="form-label">Professeur</label>
                                                            <select name="teacher" class="form-control" required>
                                                                @foreach ($teachers as $teacher)
                                                                    <option value="{{ $teacher->id }}"
                                                                        @if ($teacher->id == $schedule->teacher_id) selected @endif>
                                                                        {{ $schedule->teacher->user->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!-- input -->
                                                        <div class="mb-5 col-md-10">
                                                            <label for="end_time" class="form-label">Jour de la semaine</label>
                                                            <select name="day_of_week" class="form-control" required>
                                                                <option value="Monday" @if ($schedule->day_of_week == 'Monday') selected @endif>Lundi
                                                                </option>
                                                                <option value="Tuesday" @if ($schedule->day_of_week == 'Tuesday') selected @endif>Mardi
                                                                </option>
                                                                <option value="Wednesday" @if ($schedule->day_of_week == 'Wednesday') selected @endif>
                                                                    Mercredi</option>
                                                                <option value="Thursday" @if ($schedule->day_of_week == 'Thursday') selected @endif>
                                                                    Jeudi</option>
                                                                <option value="Friday" @if ($schedule->day_of_week == 'Friday') selected @endif>
                                                                    Vendredi</option>
                                                                <option value="Saturday" @if ($schedule->day_of_week == 'Saturday') selected @endif>
                                                                    Samedi</option>
                                                                <option value="Sunday" @if ($schedule->day_of_week == 'Sunday') selected @endif>
                                                                    Dimanche</option>
                                                            </select>
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

                            <!-- Modal pour la suppression -->
                            <div class="modal fade" id="deleteScheduleModal{{ $schedule->id }}" aria-hidden="true"
                                    aria-labelledby="deleteScheduleModal{{ $schedule->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="deleteScheduleModal{{ $schedule->id }}Label">Supprimer le créneau
                                            </h3>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        {{-- <form method="post" class="needs-validation"> --}}
                                        <div class="modal-body">
                                            <div class="row">
                                                <h2>Voulez-vous vraiment supprimer ce cours?</h2>
                                            </div>
                                        </div>
                                        {{-- </form> --}}
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger">supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                
                </div>

            </div>

        </div>

    </section>
</x-layouts>
