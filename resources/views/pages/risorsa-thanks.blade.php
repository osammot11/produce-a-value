@extends('layouts.app')

@section('title', 'Risorsa richiesta | Produce a Value')

@section('content')
    <main class="page-brutal">
        <section class="page-hero-brutal">
            <div class="page-hero-brutal-main">
                <p class="page-brutal-kicker">Risorsa richiesta</p>
                <h1 class="page-brutal-title">Checklist richiesta. Ora il passo serio è l'audit.</h1>
                <p class="page-brutal-text">
                    Abbiamo registrato la richiesta. Se vuoi una diagnosi costruita sui tuoi numeri reali,
                    compila l'audit e facci vedere dove il funnel perde forza.
                </p>
                <div class="hero-brutal-actions">
                    <a href="{{ route('audit') }}" class="brutal-button hero-brutal-cta-primary">Richiedi audit</a>
                    <a href="{{ route('servizi') }}" class="hero-brutal-cta-secondary">Vedi servizi</a>
                </div>
            </div>

            <aside class="page-hero-brutal-side page-hero-brutal-side-yellow">
                <span>Next</span>
                <strong>From checklist to action.</strong>
            </aside>
        </section>
    </main>
@endsection
