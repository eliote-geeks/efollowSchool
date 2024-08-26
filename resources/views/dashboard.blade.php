<base href="/">
<x-layouts>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="d-flex">
            <!-- form -->
            <div class="input-group me-9  ">
                <form action="{{ route('changeSchoolInformationStatus') }}" method="POST">
                    @csrf
                    <select class="form-control" name="year" id="">

                        @foreach ($years as $y)
                            <option @if ($school->id == $y->id) selected @endif value="{{ $y->id }}">
                                {{ \Carbon\Carbon::parse($y->start)->format('Y') . '-' . \Carbon\Carbon::parse($y->end)->format('Y') }}
                            </option>
                        @endforeach
                    </select>
                    <!-- button -->
                    <button type="submit" class="btn btn-primary">Basculez</button>
                </form>
            </div>

        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>
    <div class="container-fluid">
        <!-- Header du tableau de bord -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
            </div>
        </div>

        <!-- Statistiques générales -->
        <div class="row">
            <!-- Total Students -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total des Étudiants</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStudents }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fe fe-user-graduate fe-2x text-gray-300"></i>
                            </div>
                            <a href="{{ route('exportStudentAll') }}">Exporter</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Payments -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total des Paiements</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPayments }} FCFA</div>
                            </div>
                            <div class="col-auto">
                                <i class="fe fe-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                            <a href="{{ route('exportPaymentAll') }}">Exporter</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Remises -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total des Remises</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRemises }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fe fe-percentage fa-2x text-gray-300"></i>
                            </div>
                            <a href="{{ route('exportRemiseAll') }}">Exporter</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Absences -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total des Absences</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAbsences }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fe fe-user-slash fa-2x text-gray-300"></i>
                            </div>
                            <a href="{{ route('exportAbsenceAll') }}">Exporter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques supplémentaires -->
        <div class="row">
            <!-- Total Presences -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total des Présences</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPresences }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fe fe-user-check fa-2x text-gray-300"></i>
                            </div>
                            <a href="{{ route('exportPresenceAll') }}">Exporter</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Moratoires -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Total des Moratoires</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMoratoires }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fe fe-clock fa-2x text-gray-300"></i>
                            </div>
                            <a href="{{ route('exportMoratoireAll') }}">Exporter</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Scolarites -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total des Scolarités</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalScolarites }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fe fe-school fa-2x text-gray-300"></i>
                            </div>
                            <a href="{{ route('exportScolariteAll') }}">Exporter</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paiements Mensuels -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Paiements ce Mois</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $monthlyPayments }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fe fe-calendar-alt fa-2x text-gray-300"></i>
                            </div>
                            <a href="{{ route('exportPaymentMonth') }}">Exporter</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container-fluid">
        <!-- Header du tableau de bord -->

        <!-- Section des graphiques -->
        <div class="row">
            <!-- Graphique des paiements mensuels -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Paiements Mensuels</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyPaymentsChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Absences Hebdomadaires</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="weeklyAbsencesChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Graphique des étudiants et des présences -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Étudiants et Présences</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="studentsPresencesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Graphique des remises et moratoires -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Remises et Moratoires</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="remisesMoratoiresChart"></canvas>
                    </div>
                </div>
            </div>




        </div>


    </div>

    <!-- Script pour Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Graphique des paiements mensuels
        const ctxMonthlyPayments = document.getElementById('monthlyPaymentsChart').getContext('2d');
        new Chart(ctxMonthlyPayments, {
            type: 'bar',
            data: {
                labels: ['Paiements Mensuels'],
                datasets: [{
                    label: 'Montant en FCFA',
                    data: [{{ $monthlyPayments }}],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Graphique des étudiants et des présences
        const ctxStudentsPresences = document.getElementById('studentsPresencesChart').getContext('2d');
        new Chart(ctxStudentsPresences, {
            type: 'doughnut',
            data: {
                labels: ['Étudiants', 'Présences'],
                datasets: [{
                    data: [{{ $totalStudents }}, {{ $totalPresences }}],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });

        // Graphique des absences hebdomadaires
        const ctxWeeklyAbsences = document.getElementById('weeklyAbsencesChart').getContext('2d');

        // Utilisation des données PHP dans le script JavaScript
        const absenceData = @json($absenceDataW); // Insère les données JSON encodées

        new Chart(ctxWeeklyAbsences, {
            type: 'line',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                    label: 'Absences',
                    data: absenceData, // Utilise les données d'absences
                    fill: false,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    tension: 0.1
                }]
            }
        });

        // Graphique des remises et moratoires
        const ctxRemisesMoratoires = document.getElementById('remisesMoratoiresChart').getContext('2d');
        new Chart(ctxRemisesMoratoires, {
            type: 'pie',
            data: {
                labels: ['Remises', 'Moratoires'],
                datasets: [{
                    data: [{{ $totalRemises }}, {{ $totalMoratoires }}],
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>

</x-layouts>
