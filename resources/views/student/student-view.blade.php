<base href="/" />
<x-layouts>
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
                                <li class="breadcrumb-item active" aria-current="page">Informations sur l'élève</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations sur l'élève -->
        <div class="row">
            <div class="col-md-12 col-12 mb-5">
                <div class="card">
                    <!-- Header de la carte -->
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2 class="mb-1">Informations sur {{ $student->first_name . ' ' . $student->last_name }}
                            </h2>
                            @if ($student->status == 1)
                                <a class="btn btn-secondary rounded-pill ms-auto" data-bs-toggle="modal"
                                    href="#desactivate" role="button">Désactiver le compte de l'élève</a>
                            @else
                                <a class="btn btn-success rounded-pill ms-auto" href="{{ route('addStudentCard', $student) }}" >Activer le compte de l'élève</a>
                            @endif
                            <a href="javascript:void(0);" onclick="printPage()" class="btn btn-primary rounded-pill ms-auto">Imprimer</a>

                        </div>
                    </div>

                    <!-- Contenu de la carte -->
                    <div class="card-body">
                        <!-- Informations générales sur l'élève -->
                        <div class="d-flex align-items-center mb-4">
                            <div class="position-relative">
                                <label for="img" class="img-thumbnail position-relative"
                                    style="height: 150px; width: 150px; cursor: pointer;">
                                    <img id="studentImage" src="{{ $student->user->profile_photo_url }}"
                                        class=" w-100 h-100">
                                </label>
                            </div>
                            <div class="ms-4" style=" font-weight: bold;">
                                <h2 class="mb-0 text-warning fs-2">
                                    {{ $student->first_name . ' ' . $student->last_name }}</h2>
                                <p class="mb-1 fs-3" style="color: black;">{{ $student->matricular }}</p>
                                <span class="text-primary lh-1 d-flex align-baseline fs-4">
                                    {{ $student->studentClasse->classe->niveau->name }} -
                                    {{ $student->studentClasse->classe->name }}
                                </span>
                            </div>
                        </div>

                        <!-- Détails de l'élève -->
                        <div class="border-top row mt-3 border-bottom mb-3 g-0 mb-7">
                            <div class="col">
                                <div class="pe-1 ps-2 py-3 fs-4">
                                    <h5 class="mb-4">Date de naissance:
                                        {{ \Carbon\Carbon::parse($student->date_birth)->format('d, M Y') }}</h5>
                                    <span>Lieu de naissance: {{ $student->place_birth }}</span>
                                </div>
                            </div>
                            <div class="col border-start">
                                <div class="pe-1 ps-3 py-3 fs-4">
                                    <h5 class="mb-4">Nom du père: {{ $student->name_father }}</h5>
                                    <span>Téléphone du père: {{ $student->phone_father }}</span>
                                </div>
                            </div>
                            <div class="col border-start">
                                <div class="pe-1 ps-3 py-3 fs-4">
                                    <h5 class="mb-4">Nom de la mère: {{ $student->name_mother }}</h5>
                                    <span>Téléphone de la mère: {{ $student->phone_mother }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Détails sur la scolarité -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div id="basic" class="mb-1">
                                    <h2 class="fw-semibold">Détails sur la scolarité par année scolaire:</h2>
                                </div>
                            </div>
                        </div>

                        <!-- Périodes d'absences -->
                        <div class="table-responsive">
                            <table class="table table-hover table-lg fs-4">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Frais Scolaire (montant)</th>
                                        <th>Montant Reglé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $schoolInformationId = \App\Models\SchoolInformation::where(
                                            'status',
                                            1,
                                        )->first()->id;
                                    @endphp
                                    @foreach (\App\Models\Scolarite::where('school_information_id', $schoolInformationId)->get() as $s)
                                        <tr>
                                            <td>{{ $s->name }}({{ number_format($s->amount) }}
                                                FCFA)</td>
                                            <td>{{ number_format(
                                                \App\Models\Payment::where([
                                                    'student_id' => $student->id,
                                                    'scolarite_id' => $s->id,
                                                    'school_information_id' => $schoolInformationId,
                                                ])->sum('amount'),
                                            ) }}
                                                FCFA</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>

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

    </section>

    <!-- Modal Désactivation -->
    <div class="modal fade" id="desactivate" aria-hidden="true" aria-labelledby="desactivate" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="activatesLabel">Désactiver le compte de l'élève</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <div class="row">
                            <h2>Voulez-vous vraiment désactiver le compte de
                                {{ $student->first_name . ' ' . $student->last_name }}?</h2>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a href='{{ route('changeStudentStatus', $student) }}' class="btn btn-danger">désactiver</a>
                </div>
            </div>
        </div>
    </div>

</x-layouts>
