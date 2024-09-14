<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            border: 1px solid black;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
        }

        .right {
            text-align: right;
        }

        .details {
            margin-bottom: 30px;
        }

        .details p {
            margin: 5px 0;
            font-size: 14px;
        }

        .details strong {
            display: inline-block;
            width: 150px;
        }

        .signature-section {
            margin-top: 40px;
        }

        .signature-section p {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .signature-section .signature-line {
            margin-top: 20px;
            border-top: 1px solid black;
            width: 200px;
        }
    </style>
</head>

<body>
@php
    $schoolInformation = \App\Models\SchoolInformation::where('status',1)->first();
@endphp
    <div class="container">
        <div class="header">
            <h1>{{ $schoolInformation->name }}</h1>
            <p>{{ $schoolInformation->tel_school }}</p>
            <p>{{ $schoolInformation->poBox }}</p>
        </div>

        <div class="details">
            <p><strong>Reçu de :</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
            <p><strong>Matricule :</strong> {{ $student->matricular }}</p>
            <p><strong>Date de Paiement :</strong> {{ \Carbon\Carbon::now()->format('d, M Y') }}</p>
            <p><strong>Montant :</strong> {{ number_format($payment->amount) }} FCFA</p>
            <p><strong>Total Payé :</strong> {{ number_format($totalPaymentsAmount) }} FCFA</p>
            <p><strong>Balance Restante :</strong> {{ number_format($balance) }} FCFA</p>
            <p>Merci pour votre paiement.</p>
        </div>

        <div class="right">
            <p><strong>Date :</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        </div>

        <div class="signature-section">
            <p><strong>Signature :</strong></p>
            <div class="signature-line"></div>
        </div>
    </div>
</body>

</html>
