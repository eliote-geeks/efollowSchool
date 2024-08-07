<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <style>

        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    padding: 20px;
}

.text-start {
  text-align: start !important;
  justify-content: center;
  text-align: center;
}

.text-end {
  text-align: end !important;
}

.text-center {
  text-align: center !important;
}


.page-header {
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.page-header h1 {
    margin: 0;
    font-weight: bold;
    font-size: 24px;
}

.breadcrumb {
    margin: 10px 0;
}

.breadcrumb ol {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}

.breadcrumb li {
    margin-right: 10px;
}

.breadcrumb a {
    text-decoration: none;
    color: #007bff;
}

.breadcrumb li.active {
    color: #6c757d;
}

.card-container {
    display: flex;
    justify-content: center;
}

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
    width: 100%;
    max-width: 800px;
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

.card-header {
    margin-bottom: 20px;
}

.text-warning {
    color: #ffc107;
    display: flex;
    justify-content: space-between;
}

.text-start,
.text-end {
    width: 45%;
}

.student-card-infos {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.info-left {
    font-size: 16px;
    width: 45%;
}

.info-right {
    width: 45%;
    text-align: right;
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
}

.text-success {
    color: #28a745;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
}

.text-center-content {
    display: inline-block; /* Ensures that the content is only as wide as necessary */
    text-align: center;
}

.info-left {
    display: flex;
    flex-direction: column;
}

.info-left p {
    display: flex;
    align-items: center; /* Vertically center-aligns the text within each paragraph */
    margin: 0;
    font-size: 18px;
    margin-bottom: 10px; 
}

.label {
    display: inline-block;
    width: 150px; /* Adjust width as needed to ensure alignment */
    font-weight: bold;
}

.value {
    margin-left: 10px; /* Adjust this value to control the space between the label and the value */
}


    </style>
    
</head>
<body>
    <section class="container">

        <div class="card-container">
            <div class="student-card">
                <div class="card-header">
                    <div class="text-warning">
                        <div class="text-start">
                         <div class="text-center-content">
                            <p>République du Cameroun</p>
                            <p>Paix-Travail-Patrie</p>
                            <p>Ministère de l'Enseignement Secondaire</p>
                            <p>BP: 845</p>
                            <p>TEL: 223 43 67 64</p>
                        </div>
                        </div>
                        <div class="text-end">
                         <div class="text-center-content">
                            <p>Republic of Cameroon</p>
                            <p>Peace-Work-Fatherland</p>
                            <p>Ministry of Secondary Education</p>
                            <p>PO BOX: 845</p>
                            <p>Ph: 223 43 67 64</p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="student-card-infos">
                    <div class="info-left">
                        <p><span class="label">Nom :</span> <span class="value">John Doe</span></p>
                        <p><span class="label">Prénom :</span> <span class="value">Jane Doe</span></p>
                        <p><span class="label">Né(e) le :</span> <span class="value">01/01/2005</span></p>
                        <p><span class="label">Matricule :</span> <span class="value">12345678</span></p>
                        <p><span class="label">Classe :</span> <span class="value">Terminale</span></p>
                    </div>
                    <div class="info-right">
                        <img src="assets/images/blank_image.jpg" class="student-photo" alt="Student Photo">
                    </div>
                </div>
                <div class="logo"></div>
                <h2 class="text-center text-success">Lycée Bilingue de Yaoundé</h2>
            </div>
        </div>
    </section>
</body>
</html>
