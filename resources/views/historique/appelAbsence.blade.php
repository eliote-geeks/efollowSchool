<base href="/">
<x-layouts>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <!-- Formulaire de sélection -->
            <div class="card mt-5">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Générer un Rapport d'Absence</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="course" class="form-label">Cours :</label>
                            <select class="form-control" name="course" id="course">
                                <option value="">Sélectionnez un Cours</option>
                                @foreach ($courses as $c)
                                    <option value="{{ $c->subject }}">{{ $c->subject }}</option>
                                @endforeach
                            </select>
                            @error('course')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="period" class="form-label">Période <span class="text-danger">*</span>:</label>
                            <select name="period" id="period" class="form-control" required>
                                <option value="week">Cette Semaine</option>
                                <option value="month">Ce Mois</option>
                                <option value="custom">Personnalisée</option>
                            </select>
                            @error('period')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div id="custom-period" class="form-group" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="start_date" class="form-label">Date de début :</label>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                                @error('start_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="end_date" class="form-label">Date de fin :</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                                @error('end_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Générer le Rapport</button>
                    </form>
                </div>
            </div>

            <!-- Tableau des présences -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <h4 class="mb-0">Historique des absences</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTableBasic">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">Nom de l'étudiant</th>
                                            <th scope="col">Jour</th>
                                            <th scope="col">Cours</th>
                                            <th scope="col">Heure de début</th>
                                            <th scope="col">Heure de fin</th>
                                            <th scope="col">Nom du professeur</th>
                                            <th>Total Heure</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presences as $p)
                                            <tr>
                                                <td>{{ $p->student->first_name.' '.$p->student->last_name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($p->date)->format('d, M Y') }}</td>
                                                <td>{{ $p->schedule->subject }}</td>
                                                <td>{{ \Carbon\Carbon::parse($p->schedule->timeSlot->start_time)->format('H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($p->schedule->timeSlot->end_time)->format('H:i') }}</td>
                                                <td>{{ $p->schedule->teacher->user->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($p->schedule->timeSlot->start_time)->diffInHours(\Carbon\Carbon::parse($p->schedule->timeSlot->end_time)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Content body end
    ***********************************-->

    <script>
        document.getElementById('period').addEventListener('change', function() {
            if (this.value === 'custom') {
                document.getElementById('custom-period').style.display = 'block';
            } else {
                document.getElementById('custom-period').style.display = 'none';
            }
        });
    </script>
</x-layouts>
