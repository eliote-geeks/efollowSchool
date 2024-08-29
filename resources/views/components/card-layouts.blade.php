<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EffollowSchool</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon/favicon.ico" />
    <script src="assets/js/vendors/darkMode.js"></script>
    <link href="assets/fonts/feather/feather.css" rel="stylesheet" />
    <link href="assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/theme.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="canonical" href="add-customer.html">
    <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" />
    <style>
        .menu-icon {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #333;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1000;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .menu-item {
            background-color: #f8f8f8;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 5px;
            font-weight: bold;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .menu-item i {
            color: black;
            opacity: 0.7;
        }
    </style>
    @livewireStyles
</head>

<body>

    <div id="db-wrappe">
        <main id="page-conten">
            <div class="header">
                <nav class="navbar-default navbar navbar-expand-lg">
                    <div class="ms-lg-3 d-none d-md-none d-lg-block navbar-icon">
                        <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center" type="button"
                            data-bs-toggle="modal" data-bs-target="#menuModal">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </button>
                    </div>
                    <!--Navbar nav -->
                    <div class="ms-auto d-flex">
                        <div class="dropdown">
                            <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center"
                                type="button" aria-expanded="false" data-bs-toggle="dropdown"
                                aria-label="Toggle theme (auto)">
                                <i class="bi theme-icon-active"></i>
                                <span class="visually-hidden bs-theme-text">Toggle theme</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="light" aria-pressed="false">
                                        <i class="bi theme-icon bi-sun-fill"></i>
                                        <span class="ms-2">Light</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="dark" aria-pressed="false">
                                        <i class="bi theme-icon bi-moon-stars-fill"></i>
                                        <span class="ms-2">Dark</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center active"
                                        data-bs-theme-value="auto" aria-pressed="true">
                                        <i class="bi theme-icon bi-circle-half"></i>
                                        <span class="ms-2">Auto</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <ul class="navbar-nav navbar-right-wrap ms-2 d-flex nav-top-wrap">
                            <li class="dropdown stopevent">
                                <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary"
                                    href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fe fe-bell"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg"
                                    aria-labelledby="dropdownNotification">
                                    <div>
                                        <div
                                            class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
                                            <span class="h4 mb-0">Notifications</span>
                                            <a href="# ">
                                                <span class="align-middle">
                                                    <i class="fe fe-settings me-1"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <!-- List group -->
                                        <ul class="list-group list-group-flush" data-simplebar
                                            style="max-height: 300px;">
                                            <li class="list-group-item bg-light">
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="text-body" href="#">
                                                            <div class="d-flex">
                                                                <img src="../../../assets/images/avatar/avatar-1.jpg"
                                                                    alt="" class="avatar-md rounded-circle" />
                                                                <div class="ms-3">
                                                                    <h5 class="fw-bold mb-1">Kristin Watson:</h5>
                                                                    <p class="mb-3">Krisitn Watsan like your comment
                                                                        on course Javascript Introduction!</p>
                                                                    <span class="fs-6">
                                                                        <span>
                                                                            <span
                                                                                class="fe fe-thumbs-up text-success me-1"></span>
                                                                            2 hours ago,
                                                                        </span>
                                                                        <span class="ms-1">2:19 PM</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-auto text-center me-2">
                                                        <a href="#" class="badge-dot bg-info"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Mark as read"></a>
                                                        <div>
                                                            <a href="#" class="bg-transparent"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Remove">
                                                                <i class="fe fe-x"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="text-body" href="#">
                                                            <div class="d-flex">
                                                                <img src="../../../assets/images/avatar/avatar-2.jpg"
                                                                    alt="" class="avatar-md rounded-circle" />
                                                                <div class="ms-3">
                                                                    <h5 class="fw-bold mb-1">Brooklyn Simmons</h5>
                                                                    <p class="mb-3">Just launched a new Courses React
                                                                        for Beginner.</p>
                                                                    <span class="fs-6">
                                                                        <span>
                                                                            <span
                                                                                class="fe fe-thumbs-up text-success me-1"></span>
                                                                            Oct 9,
                                                                        </span>
                                                                        <span class="ms-1">1:20 PM</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-auto text-center me-2">
                                                        <a href="#" class="badge-dot bg-secondary"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Mark as unread"></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="text-body" href="#">
                                                            <div class="d-flex">
                                                                <img src="../../../assets/images/avatar/avatar-3.jpg"
                                                                    alt="" class="avatar-md rounded-circle" />
                                                                <div class="ms-3">
                                                                    <h5 class="fw-bold mb-1">Jenny Wilson</h5>
                                                                    <p class="mb-3">Krisitn Watsan like your comment
                                                                        on course Javascript Introduction!</p>
                                                                    <span class="fs-6">
                                                                        <span>
                                                                            <span
                                                                                class="fe fe-thumbs-up text-info me-1"></span>
                                                                            Oct 9,
                                                                        </span>
                                                                        <span class="ms-1">1:56 PM</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-auto text-center me-2">
                                                        <a href="#" class="badge-dot bg-secondary"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Mark as unread"></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="text-body" href="#">
                                                            <div class="d-flex">
                                                                <img src="../../../assets/images/avatar/avatar-4.jpg"
                                                                    alt="" class="avatar-md rounded-circle" />
                                                                <div class="ms-3">
                                                                    <h5 class="fw-bold mb-1">Sina Ray</h5>
                                                                    <p class="mb-3">You earn new certificate for
                                                                        complete the Javascript Beginner course.</p>
                                                                    <span class="fs-6">
                                                                        <span>
                                                                            <span
                                                                                class="fe fe-award text-warning me-1"></span>
                                                                            Oct 9,
                                                                        </span>
                                                                        <span class="ms-1">1:56 PM</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-auto text-center me-2">
                                                        <a href="#" class="badge-dot bg-secondary"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Mark as unread"></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="border-top px-3 pt-3 pb-0">
                                            <a href="../../notification-history.html"
                                                class="text-link fw-semibold">See all Notifications</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- List -->
                            <li class="dropdown ms-2">
                                <a class="rounded-circle" href="#" role="button" id="dropdownUser"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md avatar-indicators avatar-online">
                                        <img alt="avatar" src="{{ auth()->user()->profile_photo_url }}"
                                            class="rounded-circle" />
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <div class="dropdown-item">
                                        <div class="d-flex">
                                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                                <img alt="avatar" src="{{ auth()->user()->profile_photo_url }}"
                                                    class="rounded-circle" />
                                            </div>
                                            <div class="ms-3 lh-1">
                                                <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                                                <p class="mb-0">{{ auth()->user()->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <ul class="list-unstyled">

                                        <li>
                                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                                <i class="fe fe-user me-2"></i>
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                                <i class="fe fe-settings me-2"></i>
                                                Profile
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="dropdown-divider"></div>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="dropdown-item" href="javascript:;"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fe fe-power me-2"></i>
                                                Déconnexion
                                            </a>
                                            <!-- Vue Blade -->
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>

                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <!-- Affichage des messages de session -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @elseif(session('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @elseif(session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif

            {{ $slot }}

        </main>
    </div>



    <!-- Menu -->
    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary" id="menuModalLabel">Menu</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="{{ route('dashboard') }}">
                        <div class="menu-grid">
                            <div class="menu-item">
                                <i class="bi bi-speedometer icon fs-1"></i>
                                <div class="text-secondary">Dashboard</div>

                            </div>
                    </a>
                    <a href="{{ route('schoolInformation.index') }}">
                        <div class="menu-item">
                            <i class="bi bi-building icon fs-1"></i>
                            <div class="text-secondary">Gestion de l'établissement</div>
                        </div>
                    </a>
                    <a href="{{ route('niveau.index') }}">
                        <div class="menu-item">
                            <i class="bi bi-activity icon fs-1"></i>
                            <div class="text-secondary">Gestion des niveaux</div>
                        </div>
                    </a>
                    <a href="{{ route('searchByCard') }}">
                        <div class="menu-item">
                            <i class="bi bi-search icon fs-1"></i>
                            <div class="text-secondary">Rechercher par carte un élève</div>
                        </div>
                    </a>

                    <a href="{{ route('searchByname') }}">
                        <div class="menu-item">
                            <i class="bi bi-search icon fs-1"></i>
                            <div class="text-secondary">Rechercher un élève</div>
                        </div>
                    </a>
                    <a href="{{ route('payment.index') }}">
                        <div class="menu-item">
                            <i class="bi bi-coin icon fs-1"></i>
                            <div class="text-secondary">Gestion des paiement</div>
                        </div>
                    </a>

                    <a href="{{ route('getRemise') }}">
                        <div class="menu-item">
                            <i class="bi bi-coin icon fs-1"></i>
                            <div class="text-secondary">Gestion des reductions</div>
                        </div>
                    </a>
                    <a href="{{ route('controlPayment') }}">
                        <div class="menu-item">
                            <i class="bi bi-calendar-check icon fs-1"></i>
                            <div class="text-secondary">Controle Scolarite</div>
                        </div>
                    </a>
                    <a href="{{ route('scolarite.index') }}">
                        <div class="menu-item">
                            <i class="bi bi-cash-coin icon fs-1"></i>
                            <div class="text-secondary">Frais de scolarité</div>
                        </div>
                    </a>

                    <a href="{{ route('moratoire.index') }}">
                        <div class="menu-item">
                            <i class="bi bi-pause-circle icon fs-1"></i>
                            <div class="text-secondary">Gestion des moratoires</div>
                        </div>
                    </a>
                    <div class="menu-item">
                        <i class="bi bi-person icon fs-1"></i>
                        <div class="text-secondary">Gestion des utilisateurs</div>
                    </div>

                    </a>
                    <a href="javascript:;"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="menu-item">
                            <i class="fe fe-power me-2 icon fs-1"></i>
                            <div class="text-secondary">Deconnexion</div>
                        </div>
                    </a>
                    <!-- Vue Blade -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>


    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success') || session('error') || session('message') || session('warning'))
                var feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
                feedbackModal.show();
            @endif
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />

    <script src="assets/libs/%40popperjs/core/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="assets/js/vendors/validation.js"></script>
    <script src="assets/libs/flatpickr/dist/flatpickr.min.js"></script>
    <script src="assets/js/theme.min.js"></script>
    <script src="assets/js/vendors/jquery.min.js"></script>
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/js/vendors/datatables.js"></script>
    <script src="assets/libs/dropzone/dist/min/dropzone.min.js"></script>
    <script src="assets/js/vendors/dropzone.js"></script>
    <script src="assets/js/vendors/validation.js"></script>
    <script src="assets/js/vendors/validation.js"></script>
    <script src="assets/js/otherFunction.js"></script>
    <script src="assets/js/uploadImagesFunctions.js"></script>


</body>

</html>
