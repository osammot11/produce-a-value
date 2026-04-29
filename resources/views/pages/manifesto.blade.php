@extends('layouts.app')

@section('title', 'Manifesto | Produce a Value')

@section('content')
    <main class="page-brutal">
        <section class="page-hero-brutal">
            <div class="page-hero-brutal-main">
                <p class="page-brutal-kicker">Manifesto</p>
                <h1 class="page-brutal-title">Il design deve avere carattere. La strategia deve vendere.</h1>
                <p class="page-brutal-text">
                    Produce a Value nasce per costruire esperienze digitali che non cercano approvazione
                    generica: cercano attenzione, fiducia e movimento.
                </p>
                <div class="hero-brutal-actions">
                    <a href="{{ route('audit') }}" class="brutal-button hero-brutal-cta-primary">Richiedi audit</a>
                    <a href="{{ route('servizi') }}" class="hero-brutal-cta-secondary">Vedi servizi</a>
                </div>
            </div>

            <aside class="page-hero-brutal-side page-hero-brutal-side-yellow">
                <span>03</span>
                <strong>No pretty noise.</strong>
            </aside>
        </section>

        <section class="manifesto-brutal-list">
            <article>
                <span>01</span>
                <h2>La chiarezza batte la decorazione.</h2>
                <p>Ogni sezione deve aiutare qualcuno a capire, fidarsi o agire.</p>
            </article>

            <article>
                <span>02</span>
                <h2>Il carattere non è caos.</h2>
                <p>Uno stile forte funziona solo quando gerarchia, ritmo e messaggio sono sotto controllo.</p>
            </article>

            <article>
                <span>03</span>
                <h2>La performance non vive dopo il design.</h2>
                <p>Conversione, contenuto e direzione visiva vanno progettati insieme dall'inizio.</p>
            </article>

            <article>
                <span>04</span>
                <h2>Meglio polarizzare che sparire.</h2>
                <p>Un brand memorabile non prova a piacere a tutti. Parla meglio alle persone giuste.</p>
            </article>
        </section>
    </main>
@endsection
