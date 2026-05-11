@extends('layouts.app')

@section('title', 'Audit richiesto | Produce a Value')

@section('content')
    <main class="page-brutal">
        <section class="page-hero-brutal">
            <div class="page-hero-brutal-main">
                <p class="page-brutal-kicker">Audit richiesto</p>
                <h1 class="page-brutal-title">Dati ricevuti. Ora guardiamo dove perde il funnel.</h1>
                <p class="page-brutal-text">
                    La richiesta è stata salvata. Se c'è fit, ti ricontatteremo per trasformare i dati in una
                    direzione operativa chiara.
                </p>
                <div class="actions">
                    <a href="{{ route('work') }}" class="button">Vedi il work</a>
                    <a href="{{ route('risorsa') }}" class="button-secondary">Scarica risorsa</a>
                </div>
            </div>

            <aside class="page-hero-brutal-side">
                <span>Next</span>
                <strong>Analysis before action.</strong>
            </aside>
        </section>
    </main>
@endsection
