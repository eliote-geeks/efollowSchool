<base href="/">
<x-layouts>
    <!--**********************************
        Content body start
    ***********************************-->

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
                            <h2 class="mb-1">Gestion des absences</h2>
                            <div class="ms-auto">
                            </div>
                        </div>
                        <p class="mb-0">
                            Sur cette page vous pouvez consulter l'historique des absences ainsi que générer des rapports
                        </p>
                    </div>
                    <!-- table  -->
                    <div class="card-body">

                        <h3 class="mb-3 me-auto text-secondary">Générer un rapport d'absence</b></h3>

                        <div class="row col-lg-6 col-12 ms-3 mb-5">

                            <form action="{{ route('absence.generateReport',$classe) }}" method="POST">
                                @csrf
                                <!-- input -->
                                <div class="mb-5 col-md-12">                                    
                                    <label class="form-label" for="masque">Cours</label>
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
                                <!-- input -->
                                <div class="mb-5 col-md-12">
                                    <label class="form-label" for="amount">Elève</label>
                                    <select class="form-control" name="student" id="student">
                                        <option value="">Sélectionnez un Etudiant</option>
                                        @foreach ($students as $s)
                                            <option value="{{ $s->student->id }}">
                                                {{ $s->student->first_name . ' ' . $s->student->last_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('course')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-12">
                                    <label class="form-label" for="amount">Période:</label>
                                   <select name="period" id="period" class="form-control" required>
                                        <option value="week">Cette Semaine</option>
                                        <option value="month">Ce Mois</option>
                                        <option value="custom">Personnaliser</option>
                                    </select>
                                    @error('period')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- input -->
                                <div id="custom-period" class="form-group" style="display: none;">
                                    <div class="row">
                                        <div class="mb-5 col-md-6">
                                            <label class="form-label" for="amount">Date de début:</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control">
                                                @error('start_date')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                        </div>
                                        <div class="mb-5 col-md-6">
                                            <label class="form-label" for="amount">Date de fin:</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control">
                                                @error('end_date')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                              
                                <button type="submit" class="btn btn-primary confirm">
                                Générer le rapport</button>

                            </form>

                        </div>

                        <h3 class="mb-3 me-auto text-secondary">Historique des absences</b></h3>

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
                                        <th scope="col">Durée</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($presences as $p)
                                        <tr>
                                            <td>{{ $p->student->first_name . ' ' . $p->student->last_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->date)->format('d, M Y') }}</td>
                                            <td>{{ $p->schedule->subject }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->schedule->timeSlot->start_time)->format('H:i') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($p->schedule->timeSlot->end_time)->format('H:i') }}
                                            </td>
                                            <td>{{ $p->schedule->teacher->user->name }}</td>
                                            

                                            @php
                                            $start = \Carbon\Carbon::parse($p->schedule->timeSlot->start_time);
                                            $end = \Carbon\Carbon::parse($p->schedule->timeSlot->end_time);
                                        @endphp
                                        <td>{{ $start->diffInHours($end) < 1 ? $start->diffInMinutes($end) . ' m' : $start->diffInHours($end) . ' H' }}</td>
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
