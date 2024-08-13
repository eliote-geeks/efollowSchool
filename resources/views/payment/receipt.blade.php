<h1>Reçu de Paiement</h1>
<p><strong>Nom de l'Étudiant :</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
<p><strong>Matricule :</strong> {{ $student->matricular }}</p>
<p><strong>Date de Paiement :</strong> {{ \Carbon\Carbon::now()->format('d, M Y') }}</p>
<p><strong>Montant :</strong> {{ number_format($payment->amount) }} FCFA</p>
<p><strong>Tranche :</strong> {{ $payment->scolarite->name }}</p>
<p><strong>Total Payé :</strong> {{ number_format($totalPaymentsAmount) }} FCFA</p>
<p><strong>Balance Restante :</strong> {{ number_format($balance) }} FCFA</p>
<p>Merci pour votre paiement.</p>
