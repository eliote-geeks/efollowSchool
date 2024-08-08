<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Étudiant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        @media print {
            .print-button {
                display: none;
            }

            .page {
                width: 85.6mm; /* Dimension pour carte ID (86mm x 54mm) */
                height: 54mm; /* Dimension pour carte ID (86mm x 54mm) */
                margin: 0;
                padding: 0;
                box-shadow: none;
                border: none;
                page-break-after: always;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
            @page {
                size: 85.6mm 54mm;
                margin: 0;
            }
        }

        .print-button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin: 20px;
        }

        .container {
            padding: 20px;
        }

        .card-container {
            display: flex;
            justify-content: center;
            margin: 0 auto;
            width: 85.6mm; /* Dimension pour carte ID (86mm x 54mm) */
            height: 54mm; /* Dimension pour carte ID (86mm x 54mm) */
        }

        .student-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .card-header {
            margin-bottom: 10px;
        }

        .text-warning {
            color: #ffc107;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }

        .text-center-content {
            text-align: center;
        }

        .info-left {
            font-size: 12px;
            width: 45%;
            display: flex;
            flex-direction: column;
        }

        .info-left p {
            margin: 0;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }

        .value {
            margin-left: 5px;
        }

        .info-right {
            width: 45%;
            text-align: right;
        }

        .student-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .logo {
            width: 120px;
            height: 120px;
            background-image: url({!! $schoolInformation->logo !!});
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
            margin-top: 10px;
            font-size: 14px;
        }

    </style>
</head>

<body>
    <section class="container">
        <!-- Page unique : Recto -->
        <div class="card-container page">
            <div class="student-card">
                <div class="card-header">
                    <div class="text-warning text-center-content">
                        <p>République du Cameroun</p>
                        <p>Paix-Travail-Patrie</p>
                        <p>Ministère de l'Enseignement Secondaire</p>
                        <p>BP: {{ $schoolInformation->poBox }}</p>
                        <p>TEL: {{ $schoolInformation->tel_school }}</p>
                    </div>
                </div>
                <div class="student-card-infos">
                    <div class="info-left">
                        <p><span class="label">Nom :</span> <span class="value">{{ $student->first_name }}</span></p>
                        <p><span class="label">Prénom :</span> <span class="value">{{ $student->last_name }}</span></p>
                        <p><span class="label">Né(e) le :</span> <span class="value">{{ \Carbon\Carbon::parse($student->date_birth)->format('d, M Y') }}</span></p>
                        <p><span class="label">Matricule :</span> <span class="value">{{ $student->matricular }}</span></p>
                        <p><span class="label">Classe :</span> <span class="value">{{ $student->studentClasse->classe->name }}</span></p>
                    </div>
                    <div class="info-right">
                        <img src="{{ $student->user->profile_photo_url }}" class="student-photo" alt="Student Photo">
                    </div>
                </div>
                <div class="logo"></div>
                <h2 class="text-center text-success">{{ $schoolInformation->tel_school }}</h2>
            </div>
        </div>
        <button class="print-button" type="button" onclick="window.print()">Imprimer</button>
    </section>
</body>

</html>
