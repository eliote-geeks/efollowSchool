<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

 <style>

.student-card {
  background-image: url('assets/images/background-studentCard.jpeg');
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
  background-image: url('assets/images/logo-studentCard.jpg');
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
  opacity: 0.8;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: -1;
}

.student-card-infos {
  font-size: 16px;
}

.text-warning {
  color: #ffc107 !important;
}

.text-primary {
  color: #007bff !important;
}

.text-success {
  color: #28a745 !important;
}

.text-center {
  text-align: center !important;
}

.text-start {
  text-align: start !important;
}

.text-end {
  text-align: end !important;
}

.mb-0 {
  margin-bottom: 0 !important;
}

.mb-2 {
  margin-bottom: 0.5rem !important;
}

.mb-3 {
  margin-bottom: 1rem !important;
}

.mb-5 {
  margin-bottom: 3rem !important;
}

.me-3 {
  margin-right: 1rem !important;
}

.me-4 {
  margin-right: 1.5rem !important;
}

.me-5 {
  margin-right: 3rem !important;
}

.p-4 {
  padding: 1.5rem !important;
}

.container-fluid {
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}

.col-12 {
  flex: 0 0 100%;
  max-width: 100%;
}

.col-6 {
  flex: 0 0 50%;
  max-width: 50%;
}

.col-md-8 {
  flex: 0 0 66.666667%;
  max-width: 66.666667%;
}

.col-lg-12 {
  flex: 0 0 100%;
  max-width: 100%;
}

.col-md-12 {
  flex: 0 0 100%;
  max-width: 100%;
}

@media (min-width: 768px) {
  .col-md-8 {
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
  }
}

@media (min-width: 992px) {
  .col-lg-12 {
    flex: 0 0 100%;
    max-width: 100%;
  }
}

 </style>

                <section>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="student-card">
                                <div class="row text-warning">
                                    <div class="col-6 text-start">
                                        <p class="mb-0 text-center">République du Cameroun</p>
                                        <p class="mb-0 text-center">Paix-Travail-Patrie</p>
                                        <p class="mb-0 text-center">Ministère de l'Enseignement Secondaire</p>
                                        <p class="mb-0 text-center">BP: 845</p>
                                        <p class="mb-0 text-center">TEL: 223 43 67 64</p>
                                        </div>
                                        <div class="col-6 text-end">
                                        <p class="mb-0 text-center">Republic of Cameroon</p>
                                        <p class="mb-0 text-center">Peace-Work-Fatherland</p>
                                        <p class="mb-0 text-center">Ministry of Secondary Education</p>
                                        <p class="mb-0 text-center">PO BOX: 845</p>
                                        <p class="mb-0 text-center">Ph: 223 43 67 64</p>
                                    </div>
                                </div>
                                <div class="row my-5 student-card-infos">
                                    <div class="col-6">
                                        <p class="mb-0"><span class="me-5 text-primary">Nom :</span>John Doe</p>
                                        <p class="mb-0"><span class="me-4 text-primary">Prénom :</span>Jane Doe</p>
                                        <p class="mb-0"><span class="me-4 text-primary">Né(e) le :</span>01/01/2005</p>
                                        <p class="mb-0"><span class="me-3 text-primary">Matricule :</span>12345678</p>
                                        <p class="mb-0"><span class="me-5 text-primary">Classe :</span>Terminale</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <img src="assets/images/blank_image.jpg"  class="student-photo">
                                    </div>
                                </div>
                                <div class="logo"></div>
                                    <h4 class="text-center text-success" style="font-weight: bold;">Lycée Bilingue de Yaoundé</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
</body>
</html>