<x-guest-layout>

    <link rel="stylesheet" href="../assets/css/theme.min.css">
    <script src="../assets/js/vendors/darkMode.js"></script>
    <link href="../assets/fonts/feather/feather.css" rel="stylesheet" />
    <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/theme.min.css">
    <link rel="canonical" href="sign-in.html">

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>



        <main>
            <section class="container d-flex flex-column vh-100">
                <div class="row align-items-center justify-content-center g-0 h-lg-100 py-8">
                    <div class="col-lg-5 col-md-8 py-8 py-xl-0">
                        <!-- Card -->
                        <div class="card shadow">
                            <!-- Card body -->
                            <div class="card-body p-6">
                               <div class="mb-4 d-flex flex-column align-items-center">
                                    <a href="../index.html">
                                        <img src="assets/images/brand/logo/logo-icon.svg" class="mb-4" alt="logo-icon">
                                    </a>
                                    <h2 class="mb-1 fw-bold">BIENVENUE SUR EFOLLOW</h2>
                                 </div>
                                <!-- Form -->
                                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                                    @csrf
                                    <!-- Username -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Adresse email</label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="Entrez votre adresse email" :value="old('email')" required autofocus autocomplete="username">
                                        <div class="invalid-feedback">Veuillez entrer votre adresse email.</div>
                                    </div>
                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input type="password" id="password" class="form-control" name="password" placeholder="**************" required autocomplete="current-password">
                                        <div class="invalid-feedback">Veuillez entrer votre mot de passe</div>
                                    </div>
                                    <!-- Checkbox -->
                                    <div class="d-lg-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                            <label class="form-check-label" for="rememberme">Se souvenir de moi</label>
                                        </div>
                                        <!--    
                                            <div>
                                                <a href="forget-password.html">Mot de passe oublié?</a>
                                            </div>  
                                        -->
                                    </div>
                                    <div>
                                        <!-- Button -->
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Se connecter</button>
                                        </div>
                                        
                                        <div id="errorMessage" class="text-danger">
                                            <x-validation-errors class="mb-4" />
                                        </div>
                                        @if (session('status'))
                                             <p>
                                                <div id="errorMessage" class="text-danger">
                                                    {{ session('status') }}
                                                </div>
                                            </p>
                                        @endif 
                                    </div>
                                    <hr class="my-4">
                                    <div class="mt-4 text-center">
                                        powered by MN ELECTRONICS
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="position-absolute bottom-0 m-4">
                <div class="dropdown">
                    <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                        <i class="bi theme-icon-active"></i>
                        <span class="visually-hidden bs-theme-text">Toggle theme</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                                <i class="bi theme-icon bi-sun-fill"></i>
                                <span class="ms-2">Light</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                                <i class="bi theme-icon bi-moon-stars-fill"></i>
                                <span class="ms-2">Dark</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                                <i class="bi theme-icon bi-circle-half"></i>
                                <span class="ms-2">Auto</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </main>

        <script src="../assets/libs/%40popperjs/core/dist/umd/popper.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>

        <script src="../assets/js/theme.min.js"></script>
        <script src="../assets/js/vendors/validation.js"></script>

</x-guest-layout>
