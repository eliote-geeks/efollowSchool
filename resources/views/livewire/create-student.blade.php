<section class="container-fluid p-4">
    <style>
        .student-card {
            background-image: url({!! $schoolInformation->recto_path !!});
            z-index: -1;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            font-weight: bold;
        }

        .student-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            opacity: 0.8;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            z-index: -1;
        }

        .student-photo {
            width: 130px;
            height: 130px;
            object-fit: cover;
        }

        .logo {
            width: 180px;
            height: 180px;
            background-image: url({!! $schoolInformation->logo !!});
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            opacity: 0.4;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .student-card-infos {

            font-size: 16px;

        }

        <style>@media print {
            body * {
                visibility: hidden;
            }

            #studentCard,
            #studentCard * {
                visibility: visible;
            }

            #studentCard {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Créer un élève pour la classe : {{ $this->classe->name }}</b></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="offset-xl-1 col-xl-10 col-12">

            @if ($this->step == 0)
                <!-- card -->
                <form class="needs-validation" novalidate>

                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <h2 class="mb-1 text-secondary" style="font-weight: bold;">Remplir le formulaire</h2>
                                <a class="btn btn-primary rounded-pill ms-auto" data-bs-toggle="modal"
                                    href="#addSchoolYear" role="button" wire:click="backClasse">
                                    <i class="fe fe-arrow-left me-2  ms-auto"></i>
                                    Retour
                                </a>
                            </div>

                            <!-- row -->
                            <div class="row gx-3">
                                <!-- input -->
                                <div class="col-md-12 col-12 mb-4 position-relative">
                                    <h5 class="mb-2">Photo de l'élève</h5>
                                    <label for="img" class="img-thumbnail position-relative"
                                        style="height: 100px; width: 100px; cursor: pointer;">
                                        <img id="StudentImage"
                                            src="{{ $avatar ? $avatar->temporaryUrl() : 'assets/images/blank_image.jpg' }}"
                                            class=" w-100 h-100">
                                        <input
                                            class="form-control border-0 opacity-0 position-absolute top-0 left-0 w-100 h-100"
                                            type="file" accept="image/*" id="img" wire:model='avatar' />
                                    </label>
                                    <p class="mb-0">Cliquez sur la zone ci-dessus</p>
                                    <p>pour enregistrer l'image de l'élève</p>
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-6">
                                    <label class="form-label" for="firstName">Nom de l'élève</label>
                                    <input type="text" class="form-control" placeholder="Entrez le nom de l'élève"
                                        id="firstName" wire:model.live='first_name' required>
                                    @error('first_name')
                                        <div class="text-danger">Veuillez entrer le nom de l'élève</div>
                                    @enderror
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-6">
                                    <label class="form-label" for="lastName">Prénom de l'élève</label>
                                    <input type="text" class="form-control" placeholder="Entrez le prénom de l'élève"
                                        id="lastName" wire:model.live='last_name' required>
                                    @error('last_name')
                                        <div class="text-danger">Veuillez entrer le prénom de l'élève</div>
                                    @enderror
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-6">
                                    <label class="form-label" for="birthday">Date de naissance</label>
                                    <input type="date" class="form-control" placeholder="Entrez le prénom de l'élève"
                                        id="birthday" wire:model.live='date_birth' required>
                                    @error('date_birth')
                                        <div class="text-danger">Veuillez entrer la date de naissance de l'élève</div>
                                    @enderror
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-6">
                                    <label class="form-label" for="birthPlace">Lieu de naissance</label>
                                    <input type="text" class="form-control"
                                        placeholder="Entrez le lieu de naissance de l'élève" id="birthPlace"
                                        wire:model.live='place_birth' required>
                                    @error('place_birth')
                                        <div class="text-danger">Veuillez entrer le lieu de naissance de l'élève</div>
                                    @enderror
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-12">
                                    <label class="form-label" for="matricule">Sexe de l'élève</label>
                                    <select class="form-control" wire:model.live='sexe' required>
                                        <option value="">Sélectionnez le sexe de l'élève</option>
                                        <option value="Masculin">Masculin</option>
                                        <option value="Feminin">Feminin</option>
                                    </select>
                                    @error('sexe')
                                        <div class="text-danger">Veuillez entrer le sexe de l'élève</div>
                                    @enderror
                                </div>

                                <!-- input -->
                                {{-- <div class="mb-5 col-md-6">
                                    <label class="form-label" for="matricule">Montant de la remise de la pension</label>
                                    <input type="text" class="form-control" placeholder="montant en fcfa"
                                        wire:model.live='discount' >
                                    
                                </div> --}}

                                <!-- input -->
                                {{-- <div class="mb-5 col-md-6">
                                    <label class="form-label" for="classe">Classe de l'élève</label>
                                    <select class="form-control" id="classe" wire:model.live='classe' required>
                                        <option value="">Selectionnez la classe de l'élève</option>
                                        @foreach ($classes as $cl)
                                            <option value="{{ $cl->id }}">{{ $cl->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('classe')
                                        <div class="text-danger">Veuillez selectionner la classe de l'élève</div>
                                    @enderror
                                </div> --}}
                                <!-- input -->
                                <div class="mb-5 col-md-6">
                                    <label class="form-label" for="FatherName">Nom complet du père ou tuteur</label>
                                    <input type="text" class="form-control"
                                        placeholder="Entrez le nom complet du père ou tuteur" id="FatherName"
                                        wire:model.live='name_father' required>
                                    @error('name_father')
                                        <div class="text-danger">Veuillez entrer le nom complet du père ou tuteur</div>
                                    @enderror
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-6">
                                    <label class="form-label" for="fatherPhone">Numero de téléphone du père ou tuteur</label>
                                    <input type="string" class="form-control"
                                        placeholder="Entrez le numero de téléphone du père ou tuteur" id="fatherPhone"
                                        wire:model.live='phone_father' required>
                                    @error('phone_father')
                                        <div class="text-danger">Veuillez entrer le numero de téléphone du père ou tuteur</div>
                                    @enderror
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-6">
                                    <label class="form-label" for="motherName">Nom complet de la mère ou tutrice</label>
                                    <input type="text" class="form-control"
                                        placeholder="Entrez le nom complet de la mère ou tutrice" id="motherName"
                                        wire:model.live='name_mother' required>
                                    @error('name_mother')
                                        <div class="text-danger">Veuillez entrer le nom complet de la mère ou tutrice</div>
                                    @enderror
                                </div>
                                <!-- input -->
                                <div class="mb-5 col-md-6">
                                    <label class="form-label" for="motherPhone">Numero de téléphone de la mère ou tutrice</label>
                                    <input type="string" class="form-control"
                                        placeholder="Entrez le numero de téléphone de la mère ou tutrice" id="motherPhone"
                                        wire:model.live='phone_mother' required>
                                    @error('phone_mother')
                                        <div class="text-danger">Veuillez entrer le numero de téléphone de la mère ou tutrice
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <!-- buttons -->
                                    <button  wire:confirm="Vous etes sur le point de creer un élève avez-vous correctement rempli les informations de cet elève ?" wire:loading.attr='disabled' wire:click='save' class="btn btn-primary"
                                        type="button">Suivant</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            @endif
        </div>
    </div>

    @if ($this->step == 1)
        <div class="col-md-12 col-12 mb-5">
            <div class="card none">
                <!-- card header  -->
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mb-1">Visualiser la carte de <b>{{ $student->first_name }} </b></h3>
                    </div>
                </div>
            </div>
            <!-- table  -->
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="student-card mb-3">
                                <div class="row text-warning mb-6">
                                    <div class="col-6 text-start">
                                        <p class="mb-0 text-center">République du Cameroun</p>
                                        <p class="mb-0 text-center">Paix-Travail-Patrie</p>
                                        <p class="mb-0 text-center">Ministère de l'Enseignement Secondaire</p>
                                        <p class="mb-0 text-center">BP: {{ $schoolInformation->poBox }}</p>
                                        <p class="mb-0 text-center">TEL: {{ $schoolInformation->tel_school }}</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="mb-0 text-center">Republic of Cameroon</p>
                                        <p class="mb-0 text-center">Peace-Work-Fatherland</p>
                                        <p class="mb-0 text-center">Ministry of Secondary Education</p>
                                        <p class="mb-0 text-center">PO BOX: {{ $schoolInformation->poBox }}</p>
                                        <p class="mb-0 text-center">Ph: {{ $schoolInformation->tel_school }}</p>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-6 mb-0">
                                                <p class="text-primary" style="margin-bottom: 1px;">Nom (Name) :</p>
                                                <p class="text-primary" style="margin-bottom: 1px;">Prénom (FirstName)
                                                    :</p>
                                                <p class="text-primary" style="margin-bottom: 1px;">Né(e) le (Born at)
                                                    :</p>
                                                <p class="text-primary" style="margin-bottom: 1px;">Matricule
                                                    (Identifiant):</p>
                                                <p class="text-primary" style="margin-bottom: 1px;">Classe (Class):
                                                </p>
                                                <p class="text-primary" style="margin-bottom: 1px;">Sexe (sex):</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="ms-" style="margin-bottom: 1px;">
                                                    {{ $student->first_name }}</p>
                                                <p class="ms-" style="margin-bottom: 1px;">
                                                    {{ $student->last_name }}</p>
                                                <p class="ms-" style="margin-bottom: 1px;">
                                                    {{ \Carbon\Carbon::parse($student->date_birth)->format('d, M Y') }}
                                                </p>
                                                <p class="ms-" style="margin-bottom: 1px;">
                                                    {{ $student->matricular }}</p>
                                                <p class="ms-" style="margin-bottom: 1px;">
                                                    {{ $student->studentClasse->classe->name }}</p>
                                                <p class="ms-" style="margin-bottom: 1px;">Masculin</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-end">
                                        <img src="{{ $student->user->profile_photo_url }}" alt="Photo de l'étudiant"
                                            class="student-photo">
                                    </div>
                                    <div class="mb-3"></div>
                                    <h4 class="text-center text-success" style="font-weight: bold;">Lycée Bilingue de
                                        Yaoundé</h4>
                                </div>
                                <div class="logo"></div>
                            </div>
                            <button class="btn btn-primary me-2" wire:click='dec(1)' type="button">Imprimer</button>
                            <button class="btn btn-danger" wire:click='dec(0)' type="button"
                                wire:loading.attr='disabled'>Ignorer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    @endif

    </div>

    </div>

    <script>
        function printStudentCard() {
            var printContents = document.getElementById('studentCard').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

</section>
