<x-layouts>
<div class="container">
    <h1>Liste des Créneaux Horaires</h1>
    <a href="{{ route('timeslots.create') }}" class="btn btn-primary">Créer un Créneau Horaire</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Heure de Début</th>
                <th>Heure de Fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($timeslots as $timeslot)
                <tr>
                    <td>{{ $timeslot->id }}</td>
                    <td>{{ $timeslot->start_time }}</td>
                    <td>{{ $timeslot->end_time }}</td>
                    <td>
                        <a href="{{ route('timeslots.edit', $timeslot->id) }}" class="btn btn-warning">Éditer</a>
                        <form action="{{ route('timeslots.destroy', $timeslot->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="container">
    <h1>Créer un Créneau Horaire</h1>

    <form action="{{ route('timeslots.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="start_time" class="form-label">Heure de Début</label>
            <input type="time" name="start_time" id="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">Heure de Fin</label>
            <input type="time" name="end_time" id="end_time" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer le Créneau</button>
    </form>
</div>
</x-layouts>