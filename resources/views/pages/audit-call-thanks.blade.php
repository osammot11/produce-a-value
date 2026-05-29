@extends('layouts.app')

@section('title', 'Call prenotata | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell call-thanks">
                <p class="kicker kicker-large">Call prenotata</p>
                <h1 class="heading-hero">Ci vediamo in call.</h1>
                <p class="copy-light copy-hero">
                    Ti abbiamo inviato conferma e link via email. Porta numeri, dubbi e priorità: useremo il RADAR per
                    capire la prossima mossa più sensata.
                </p>
                <div class="actions">
                    <a href="{{ route('work') }}" class="button mobile-fullwidth">Vedi il work</a>
                    <a href="{{ route('home') }}" class="button-secondary mobile-fullwidth">Torna alla home</a>
                </div>
            </div>
        </section>
    </main>
@endsection
