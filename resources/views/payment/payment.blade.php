<base href="/">
<x-layouts>
<div class="alert alert-info">
    <h4>Status du Paiement</h4>
    <p>{{ $status }}</p>
</div>
<div class="alert alert-info">
    <h4>Totale à payer: </h4>
    <p>{{ number_format($totalScolariteAmount) }} FCFA</p>
</div>
<div class="alert alert-info">
    <h4>Reste à payer Totale</h4>
    <p>{{ number_format($balance) }} FCFA</p>
</div>
<div class="alert alert-info">
    <h4>Solde Total Payé</h4>
    <p>{{ number_format($totalPaymentsAmount) }} FCFA</p>
</div>
<div class="alert alert-info">
    <h4>Informations de l'Étudiant</h4>
    <p><strong>Nom Complet:</strong> {{ $student->first_name.' '.$student->last_name }}</p>
    <p><strong>Matricule:</strong> {{ $student->matricular }}</p>
    <p><strong>Date de Naissance:</strong> {{ \Carbon\Carbon::parse($student->date_birth)->format('d, M Y') }}</p>
    <p><strong>Lieu de Naissance:</strong> {{ $student->place_birth }}</p>
</div>

<form action="{{ route('payment.store') }}" method="POST" class="mt-4">
    @csrf

    <input type="hidden" name="student" value="{{ $student->id }}">
    <input type="hidden" name="totalPaymentsAmount" value="{{ $totalPaymentsAmount }}">

    <div class="mb-3">
        <label for="scolarite_id" class="form-label">Tranche</label>
        <select name="scolarite" id="scolarite_id" class="form-control">
            @foreach ($scolarites as $scolarite)
                @if ($scolarite->amount > $totalPaymentsAmount)
                    <option value="{{ $scolarite->id }}">{{ $scolarite->name }} - {{ number_format($scolarite->amount) }} FCFA</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="amount" class="form-label">Montant</label>
        <input type="number" name="amount" id="amount" class="form-control" step="0.01" placeholder="Entrez le montant à payer" required>
    </div>

    <button type="submit" class="btn btn-success btn-block">Effectuer le Paiement</button>
    <a href="{{ route('searchByname') }}" class="btn btn-info">retour </a>
</form>
</x-layouts>