<base href="/">
<x-layouts>

                 <section class="container-fluid p-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <!-- Page header -->
                            <div class="border-bottom pb-3 mb-3">
                                <div class="mb-2 mb-lg-0">
                                    <h1 class="mb-0 h2 fw-bold">Importer des élèves</h1>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="offset-xl-2 col-xl-8 col-12">
                            <!-- card -->
                            <form class="needs-validation" novalidate>
                                <div class="card mb-4">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h2 class="mb text-secondary">Sélectionnez un fichier excel</h2>
                                            <a href="{{ route('exportModel') }}" class="btn btn-primary rounded-pill">Télécharger le modèle</a>
                                        </div>
                                        <div class="row gx-3">
                                            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <!-- input -->
                                                <div class="mb-5 col-md-12">
                                                    <input type="file" class="form-control" id="importStudents" name="importStudents" accept=".xlsx, .xls" required>
                                                    <div class="invalid-feedback">Veuillez entrer le nom de l'élève</div>
                                                </div>
                                                <!-- input -->
                                                <div class="col-12">
                                                    <button class="btn btn-primary" type="submit">Importer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

            

</x-layouts>