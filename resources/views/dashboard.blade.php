<base href="/">
<x-layouts>

    <section class="container-fluid p-4">
        <div class="row">
            <!-- basic table -->
            <div class="col-md-12 col-12 mb-5">
                <div class="card">
                    <!-- table  -->
                    <div class="card-body">

                        <div class="row">

                            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                                <h2 class="mb-5 me-auto">Tableau de bord année scolaire:
                                    ({{ \Carbon\Carbon::parse($school->start)->format('Y') . '-' . \Carbon\Carbon::parse($school->end)->format('Y') }})
                                </h2>
                                <div class="ms-auto">
                                    <a class="btn btn-primary rounded-pill ms-auto mt-3 mt-md-0" data-bs-toggle="modal"
                                        href="#otherYear" role="button">
                                        <i class="fe fe-calendar me-2"></i>
                                        Basculer vers une autre année scolaire
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase text-primary fw-semibold ls-md">Total des élèves</span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1"> {{ $totalStudents }}</h2>
                        <span class="text-success fw-semibold">
                            <i class="bi bi-download me-2"></i><a href="{{ route('exportStudentAll') }}"
                                class="text-success">Exporter</a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase text-primary fw-semibold ls-md">Total des paiements</span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1"> {{ $totalPayments }}</h2>
                        <span class="text-success fw-semibold">
                            <i class="bi bi-download me-2"></i><a href="{{ route('exportPaymentAll') }}"
                                class="text-success">Exporter</a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase text-primary fw-semibold ls-md">Total des remises</span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">{{ $totalRemises }}</h2>
                        <span class="text-success fw-semibold">
                            <i class="bi bi-download me-2"></i><a href="{{ route('exportRemiseAll') }}"
                                class="text-success">Exporter</a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase text-primary fw-semibold ls-md">Total des moratoires</span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">{{ $totalMoratoires }}</h2>
                        <span class="text-success fw-semibold">
                            <i class="bi bi-download me-2"></i><a href="{{ route('exportMoratoireAll') }}"
                                class="text-success">Exporter</a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase text-primary fw-semibold ls-md">Total des frais
                                    exigibles</span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">{{ $totalScolarites }}</h2>
                        <span class="text-success fw-semibold">
                            <i class="bi bi-download me-2"></i><a href="{{ route('exportScolariteAll') }}"
                                class="text-success">Exporter</a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase text-primary fw-semibold ls-md">Paiements de ce mois</span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">{{ $monthlyPayments }}</h2>
                        <span class="text-success fw-semibold">
                            <i class="bi bi-download me-2"></i><a href="{{ route('exportPaymentMonth') }}"
                                class="text-success">Exporter</a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase text-primary fw-semibold ls-md">Total des absences</span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">{{ $totalAbsences }}</h2>
                        <span class="text-success fw-semibold">
                            <i class="bi bi-download me-2"></i><a href="{{ route('exportAbsenceAll') }}"
                                class="text-success">Exporter</a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="text-uppercase text-primary fw-semibold ls-md">Total des présences</span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">{{ $totalPresences }}</h2>
                        <span class="text-success fw-semibold">
                            <i class="bi bi-download me-2"></i><a href="{{ route('exportPresenceAll') }}"
                                class="text-success">Exporter</a>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="container-fluid">
        <!-- Header du tableau de bord -->

        <!-- Section des graphiques -->
        <div class="row">
            <!-- Graphique des paiements mensuels -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Paiements Mensuels</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyPaymentsChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Absences Hebdomadaires</h4>
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
                        <h4 class="m-0 font-weight-bold text-primary">Étudiants et Présences</h4>
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
                        <h4 class="m-0 font-weight-bold text-primary">Remises et Moratoires</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="remisesMoratoiresChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Absences Hebdomadaires</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="classesAbsencesChart"></canvas>
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

        const ctxClassesAbsences = document.getElementById('classesAbsencesChart').getContext('2d');

        // Utilisation des données PHP dans le script JavaScript
        const classes = @json($classes); // Insère les noms des classes
        const absenceCounts = @json($absenceCounts); // Insère les totaux d'absences

        new Chart(ctxClassesAbsences, {
            type: 'bar',
            data: {
                labels: classes, // Utilise les noms des classes comme labels
                datasets: [{
                    label: 'Total Absences',
                    data: absenceCounts, // Utilise les totaux d'absences comme données
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
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
    </script>

    <div class="modal fade" id="otherYear" aria-hidden="true" aria-labelledby="otherYear" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="otherYearLabel">Basculer vers une autre année scolaire</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('changeSchoolInformationStatus') }}" class="needs-validation">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- input -->
                            <div class="mb-5 col-md-10">
                                <label class="form-label" for="levelName">Selectionnez une année scolaire</label>
                                <select class="form-control" name="year" id="">
                                    @foreach ($years as $y)
                                        <option @if ($school->id == $y->id) selected @endif
                                            value="{{ $y->id }}">
                                            {{ \Carbon\Carbon::parse($y->start)->format('Y') . '-' . \Carbon\Carbon::parse($y->end)->format('Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Basculer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


</x-layouts>
