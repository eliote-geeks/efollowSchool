<x-layouts>
    <div class="container">
        <h1 class="text-center my-4">Emploi du Temps 2024-2025</h1>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createScheduleModal">
                <i class="fe fe-plus"></i> Ajouter un emploi du temps
            </button>
        </div>

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
                        <td class="align-middle">{{ $timeSlot->start_time }} - {{ $timeSlot->end_time }}</td>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <td class="align-middle">
                                @php
                                    $schedule = $schedules->where('time_slot_id', $timeSlot->id)
                                        ->where('day_of_week', $day)
                                        ->first();
                                @endphp

                                @if ($schedule)
                                    <div>
                                        <strong>{{ $schedule->classe->name }}</strong><br>
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
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal pour la création -->
        <div class="modal fade" id="createScheduleModal" tabindex="-1" aria-labelledby="createScheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="createScheduleModalLabel">Créer un Emploi du Temps</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('schedules.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="class_id" class="form-label">Classe</label>
                                <select name="class_id" class="form-control" required>
                                    @foreach ($classes as $classe)
                                        <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="subject_id" class="form-label">Matière</label>
                                {{-- <select name="subject_id" class="form-control" required>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select> --}}
                            </div>

                            <div class="form-group mb-3">
                                <label for="time_slot_id" class="form-label">Horaire</label>
                                <select name="time_slot_id" class="form-control" required>
                                    @foreach ($timeSlots as $timeSlot)
                                        <option value="{{ $timeSlot->id }}">{{ $timeSlot->start_time }} - {{ $timeSlot->end_time }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="day_of_week" class="form-label">Jour de la Semaine</label>
                                <select name="day_of_week" class="form-control" required>
                                    <option value="Monday">Lundi</option>
                                    <option value="Tuesday">Mardi</option>
                                    <option value="Wednesday">Mercredi</option>
                                    <option value="Thursday">Jeudi</option>
                                    <option value="Friday">Vendredi</option>
                                    <option value="Saturday">Samedi</option>
                                    <option value="Sunday">Dimanche</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Créer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals pour l'édition -->
        @foreach ($schedules as $schedule)
            <div class="modal fade" id="editScheduleModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="editScheduleModalLabel{{ $schedule->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="editScheduleModalLabel{{ $schedule->id }}">Modifier l'Emploi du Temps</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="class_id" class="form-label">Classe</label>
                                    <select name="class_id" class="form-control" required>
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id }}" @if($classe->id == $schedule->class_id) selected @endif>{{ $classe->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="subject_id" class="form-label">Matière</label>
                                    {{-- <select name="subject_id" class="form-control" required>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" @if($subject->id == $schedule->subject_id) selected @endif>{{ $subject->name }}</option>
                                        @endforeach
                                    </select> --}}
                                </div>

                                <div class="form-group mb-3">
                                    <label for="time_slot_id" class="form-label">Horaire</label>
                                    <select name="time_slot_id" class="form-control" required>
                                        @foreach ($timeSlots as $timeSlot)
                                            <option value="{{ $timeSlot->id }}" @if($timeSlot->id == $schedule->time_slot_id) selected @endif>{{ $timeSlot->start_time }} - {{ $timeSlot->end_time }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="day_of_week" class="form-label">Jour de la Semaine</label>
                                    <select name="day_of_week" class="form-control" required>
                                        <option value="Monday" @if($schedule->day_of_week == 'Monday') selected @endif>Lundi</option>
                                        <option value="Tuesday" @if($schedule->day_of_week == 'Tuesday') selected @endif>Mardi</option>
                                        <option value="Wednesday" @if($schedule->day_of_week == 'Wednesday') selected @endif>Mercredi</option>
                                        <option value="Thursday" @if($schedule->day_of_week == 'Thursday') selected @endif>Jeudi</option>
                                        <option value="Friday" @if($schedule->day_of_week == 'Friday') selected @endif>Vendredi</option>
                                        <option value="Saturday" @if($schedule->day_of_week == 'Saturday') selected @endif>Samedi</option>
                                        <option value="Sunday" @if($schedule->day_of_week == 'Sunday') selected @endif>Dimanche</option>
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
