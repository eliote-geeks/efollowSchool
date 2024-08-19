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
    <div class="container">
        <h5 class="text-center my-4">Emploi du Temps  ({{ $classe->niveau->name }}) {{ $classe->name }} {{ \Carbon\Carbon::parse($schoolInformation->start)->format('Y').'-'.\Carbon\Carbon::parse($schoolInformation->end)->format('Y') }}</h5>
      

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Emploi du Temps -->
        <table class="table table-hover text-center">
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
                        <td class="align-middle">{{ \Carbon\Carbon::parse($timeSlot->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($timeSlot->end_time)->format('H:i') }}</td>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <td class="align-middle">
                                @php
                                    $schedule = $schedules
                                        ->where('time_slot_id', $timeSlot->id)
                                        ->where('day_of_week', $day)
                                        ->first();
                                @endphp

                                @if ($schedule)
                                    <div>
                                        <strong>{{ Str::limit($schedule->teacher->user->name,5) }}</strong><br>
                                        <span class="text-muted">{{ $schedule->subject }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#editScheduleModal{{ $schedule->id }}">
                                            <i class="fe fe-edit"></i>
                                        </button>
                                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fe fe-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#addScheduleModal{{ $timeSlot->id }}{{ $day }}">
                                        <i class="fe fe-plus"></i>
                                    </button>

                                    <!-- Modal pour ajouter un emploi du temps -->
                                    <div class="modal fade" id="addScheduleModal{{ $timeSlot->id }}{{ $day }}"
                                        tabindex="-1"
                                        aria-labelledby="addScheduleModalLabel{{ $timeSlot->id }}{{ $day }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="addScheduleModalLabel{{ $timeSlot->id }}{{ $day }}">
                                                        Ajouter un Emploi du Temps pour {{ $day }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('schedules.store') }}" method="POST" autocomplete="off">
                                                        @csrf
                                                        <input type="hidden" name="time_slot_id"
                                                            value="{{ $timeSlot->id }}">
                                                        <input type="hidden" name="day_of_week"
                                                            value="{{ $day }}">
                                                        <input type="hidden" name="class_id"
                                                            value="{{ $classe->id }}">

                                                        <div class="form-group">
                                                            <label for="subject">code Matière</label>
                                                            <input type="text" name="subject" class="form-control"
                                                                required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="time_slot_id"
                                                                class="form-label">Enseignant</label>
                                                            <select name="teacher" class="form-control" required>
                                                                @foreach ($teachers as $teacher)
                                                                    <option value="{{ $teacher->id }}">
                                                                        {{ $teacher->user->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary mt-3">Ajouter</button>
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



        <!-- Modals pour l'édition -->
        @foreach ($schedules as $schedule)
            <div class="modal fade" id="editScheduleModal{{ $schedule->id }}" tabindex="-1"
                aria-labelledby="editScheduleModalLabel{{ $schedule->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="editScheduleModalLabel{{ $schedule->id }}">Modifier l'Emploi
                                du Temps</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="class_id" value="{{ $classe->id }}">
                                <div class="form-group mb-3">
                                    <label for="subject" class="form-label">code Matière</label>
                                    <input type="text" name="subject" value="{{ $schedule->subject }}" class="form-control" id="">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="time_slot_id" class="form-label">Horaire</label>
                                    <select name="time_slot_id" class="form-control" required>
                                        @foreach ($timeSlots as $timeSlot)
                                            <option value="{{ $timeSlot->id }}"
                                                @if ($timeSlot->id == $schedule->time_slot_id) selected @endif>
                                                {{ $timeSlot->start_time }} - {{ $timeSlot->end_time }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="time_slot_id" class="form-label">Enseignant</label>
                                    <select name="teacher" class="form-control" required>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                @if ($teacher->id == $schedule->teacher_id) selected @endif>
                                                {{ $schedule->teacher->user->name }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="day_of_week" class="form-label">Jour de la Semaine</label>
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

                                <button type="submit" class="btn btn-warning">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layouts>
