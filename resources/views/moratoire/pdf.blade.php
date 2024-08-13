<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moratoire - {{ $moratoire->name }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .row {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #333;
        }
        .value {
            color: black;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 20px;
            text-transform: uppercase;
        }
        .download-link {
            color: #0056b3;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Moratoire</h1>
            <h2>{{ $moratoire->name }}</h2>
        </div>

        <div class="row">
            <label class="label">Nom du moratoire :</label>
            <span class="value">{{ $moratoire->name }}</span>
        </div>

        <div class="row">
            <label class="label">Frais exigibles concernés :</label>
            <span class="value">{{ $moratoire->scolarite->name }}</span>
        </div>

        <div class="row">
            <label class="label">Date d'expiration du délai de validité :</label>
            <span class="value">{{ \Carbon\Carbon::parse($moratoire->end_date)->format('d, M Y') }}</span>
        </div>

        <div class="row">
            <label class="label">Nom de l'élève :</label>
            <span class="value">{{ $moratoire->student->first_name . ' ' . $moratoire->student->last_name }}</span>
        </div>

        <div class="row">
            <label class="label">Classe de l'élève :</label>
            <span class="value">{{ $moratoire->student->studentClasse->classe->niveau->name . ' ' . $moratoire->student->studentClasse->classe->name }}</span>
        </div>

    </div>
</body>
</html>
