<base href="/">
<x-layouts>
 <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->

            <div class="container mt-5">
                <form action="{{ route('presence.generateReport') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Cours :</label>
                        <select class="form-control" name="course">
                            <option value="">Selectionnez un Cours</option>
                            @foreach ($courses as $c)
                                <option value="{{ $c->subject }}">{{ $c->subject }}</option>
                            @endforeach
                        </select>
                        @error('course')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="period">Période <span class="text-danger">*</span>:</label>
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
                        <div class="form-group">
                            <label for="start_date">Date de début :</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                            @error('start_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_date">Date de fin :</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                            @error('end_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Générer le Rapport</button>
                </form>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-0 me-3" style="font-weight: bold; color: gray;">Historique des présences:
                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm"
                                    id="myTable">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">Nom de l'étudiant</th>
                                            <th scope="col">Jour</th>
                                            <th scope="col">Cours</th>
                                            <th scope="col">Heure de debut</th>
                                            <th scope="col">Heure de fin</th>
                                            {{-- <th scope="col">Nom du professeur</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presences as $p)
                                            <tr>
                                                <td><a
                                                        href="">{{ $p->student->first_name.' '.$p->student->last_name }}</a>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($p->schedule->date)->format('d, M Y') }}</td>
                                                <td>{{ $p->program->course->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($p->schedule->timeSlot->start_Hour)->format('H:i') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($p->schedule->timeSlot->end_Hour)->format('H:i') }}
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
