@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reçu de Paiement</h1>
    <p>Élève: {{ $payment->student->first_name }} {{ $payment->student->last_name }}</p>
    <p>Montant: {{ $payment->amount }} FCFA</p>
    <p>Date: {{ $payment->created_at->format('d/m/Y H:i') }}</p>
</div>
@endsection
