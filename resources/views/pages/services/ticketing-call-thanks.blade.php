@extends('layouts.landing-page')

@section('title', 'Call prenotata | Produce a Value')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ticketing.css') }}">
@endpush

@section('content')
    <main class="ticketing-page">
        <section class="section hero">
            <div class="container">
                <p class="eyebrow">Call prenotata</p>
                <h1>Ci vediamo in call.</h1>
                <p class="subheadline">
                    Ti abbiamo inviato conferma e link via email. Porta numeri dell’ultima edizione, sistema attuale e
                    dubbi principali: useremo la call per capire se Marathon System è adatto al tuo evento.
                </p>
            </div>
        </section>
    </main>
@endsection
