<base href="/">
<x-layouts>

  <title>Carte d'étudiant</title>
  <script>
  // Fonction pour modifier les paramètres d'impression
  function modifierParametresImpression() {
    // Récupérer l'objet des paramètres d'impression
    var parametresImpression = window.print();
    

    // Activer l'option "Graphisme d'arrière-plan"
    parametresImpression.background = true;

    // Appliquer les nouveaux paramètres
    window.print(parametresImpression);
  }
</script>

    <style>

        @media print {
            .navbar-vertical, .none, .header {
                display: none;
            }

            body {
                background-color: white;
            }

        }
        .student-card {
        background-image:  url({!! $schoolInformation->recto_path !!});
        z-index: -1;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
        font-weight: 900;
        width: 86mm;
        height: 54mm;
        font-size: 7.1px;
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
        width: 70px;
        height: 70px;
        object-fit: cover;
        }

        .logo {
        width: 90px;
        height: 90px;
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
    </style>

     <section class="container-fluid p-4">
        <div class="row none">
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

                                <li class="breadcrumb-item active" aria-current="page">Imprimer la carte
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- basic table -->
            <div class="col-md-12 col-12 mb-5">
                <div class="card none">
                    <!-- card header  -->
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2 class="mb-1">Imprimer la carte</h2>
                        </div>
                    </div>
                </div>
                    <!-- table  -->
                    <div class="container my-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="student-card mb-3">
                                    <div class="row text-warning mb-4" style="font-size: 0.41rem;">
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
                                                <p class="text-primary" style="margin-bottom: 1px;">Prénom (FirstName) :</p>
                                                <p class="text-primary" style="margin-bottom: 1px;">Né(e) le (Born at) :</p>
                                                <p class="text-primary" style="margin-bottom: 1px;">Matricule (Identifiant):</p>
                                                <p class="text-primary" style="margin-bottom: 1px;">Classe (Class):</p>
                                                <p class="text-primary" style="margin-bottom: 1px;">Sexe (sex):</p>
                                                </div>
                                                <div class="col-6">
                                                <p class="ms-" style="margin-bottom: 1px;">{{ $student->first_name }}</p>
                                                <p class="ms-" style="margin-bottom: 1px;">{{ $student->last_name }}</p>
                                                <p class="ms-" style="margin-bottom: 1px;">{{ \Carbon\Carbon::parse($student->date_birth)->format('d, M Y') }}</p>
                                                <p class="ms-" style="margin-bottom: 1px;">{{ $student->matricular }}</p>
                                                <p class="ms-" style="margin-bottom: 1px;">{{ $student->studentClasse->classe->name }}</p>
                                                <p class="ms-" style="margin-bottom: 1px;">{{ $student->sexe }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-end">
                                            <img src="{{ $student->user->profile_photo_url }}" alt="Photo de l'étudiant" class="student-photo">
                                        </div>
                                        <div class="mb-3"></div>
                                        <h4 class="text-center text-success" style="font-weight: bold; font-size: 10px;">Lycée Bilingue de Yaoundé</h4>
                                    </div>
                                    <div class="logo"></div>
                                </div>
                                <button type="submit"
                                    class="btn btn-primary none" onclick="modifierParametresImpression()">Imprimer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</x-layouts>