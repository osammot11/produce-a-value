@extends('layouts.app')

@section('title', 'Conversion Rate | Produce a Value')

@section('content')
    <main class="page-brutal">
        <section class="page-hero-brutal">
            <div class="page-hero-brutal-main">
                <p class="page-brutal-kicker">Conversion rate</p>
                <h1 class="page-brutal-title">Più valore dallo stesso traffico.</h1>
                <p class="page-brutal-text">
                    Analizziamo pagina, funnel, copy, UX, proof e numeri per individuare le perdite di conversione
                    e trasformarle in priorità operative.
                </p>
                <div class="actions">
                    <a href="{{ route('audit') }}" class="button">Richiedi audit</a>
                    <a href="{{ route('work') }}" class="button-secondary">Vedi work</a>
                </div>
            </div>

            <aside class="page-hero-brutal-side page-hero-brutal-side-yellow">
                <span>Service 02</span>
                <strong>Stop leaking intent.</strong>
            </aside>
        </section>

        <section class="manifesto-brutal-list">
            <article>
                <span>01</span>
                <h2>Audit euristico.</h2>
                <p>Scoviamo frizioni, salti logici e mancanze di fiducia.</p>
            </article>
            <article>
                <span>02</span>
                <h2>Priorità test.</h2>
                <p>Non tutto conta uguale. Decidiamo cosa può muovere i numeri prima.</p>
            </article>
            <article>
                <span>03</span>
                <h2>Page redesign.</h2>
                <p>Ristrutturiamo sezioni, messaggio e CTA con logica di conversione.</p>
            </article>
            <article>
                <span>04</span>
                <h2>Misurazione.</h2>
                <p>Ogni intervento deve diventare leggibile, non solo più bello.</p>
            </article>
        </section>
    </main>
@endsection
