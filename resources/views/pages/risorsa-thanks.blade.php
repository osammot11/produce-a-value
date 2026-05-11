@extends('layouts.app')

@section('title', 'Risorsa richiesta | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split split-hero">
                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">Risorsa richiesta</p>
                    <h1 class="heading-hero">Checklist richiesta. Ora il passo serio è l'audit.</h1>
                    <p class="copy-light copy-hero">
                        Abbiamo registrato la richiesta. Se vuoi una diagnosi costruita sui tuoi numeri reali,
                        compila l'audit e facci vedere dove il funnel perde forza.
                    </p>
                    <div class="actions">
                        <a href="{{ route('audit') }}" class="button mobile-fullwidth">Richiedi audit</a>
                        <a href="{{ route('servizi') }}" class="button-secondary mobile-fullwidth">Vedi servizi</a>
                    </div>
                </div>

                <aside class="card card-stack card-feature card-yellow">
                    <span class="label">Next</span>
                    <strong class="card-title">From checklist to action.</strong>
                </aside>
            </div>
        </section>
    </main>
@endsection
