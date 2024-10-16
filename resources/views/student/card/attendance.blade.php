<base href="/">
<x-card-layouts>

    <section class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-3 mb-3">
                    <div class="mb-2 mb-lg-0">
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ url()->previous() }}">retour</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Controle presence</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="offset-xl-2 col-xl-8 col-12">
                <!-- card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-1">Contrôler les présences pour le cours {{ $schedule->subject }}</h2>
                        <p class="teacher-info">Enseignant : {{ $schedule->teacher->user->name }}</p>
                        <p class="class-info">Classe : {{ $schedule->classe->name }} ({{ $schedule->classe->niveau->name }})</p>
                        <p class="day-info">Jour de la semaine : {{ $schedule->day_of_week }}</p>
                        <p class="date-info">Date du jour : {{ \Carbon\Carbon::parse(now())->format('d, M Y') }}</p>
                    </div>

                    <!-- table  -->
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="attente shadow-sm text-center">
                            <div class="spinner-grow text-primary mb-3" role="status">
                                <span class="visually-hidden">Chargement...</span>
                            </div>
                            <form action="{{ route('scheduleCard', $schedule) }}" method="POST">
                                @csrf
                                <input type="text" class="visually-hidden" placeholder="Password" name="id_card_smart" autocomplete="off" autofocus>
                                @error('id_card_smart')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </form>
                            <h1 class="mb-3">Veuillez passer la carte sur le lecteur</h1>
                            <p class="text-muted">Le système est en attente de votre carte.</p>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmCloseModal">Fermer la liste d'appel</button>
                    </div>
                </div>

                <!-- Modal de confirmation -->
                <div class="modal fade" id="confirmCloseModal" tabindex="-1" aria-labelledby="confirmCloseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmCloseModalLabel">Confirmation de Fermeture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir fermer la liste d'appel ? Cette action est irréversible.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <a href="{{ route('endListCardschedule', $schedule) }}" class="btn btn-danger">Fermer</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

</x-card-layouts>
