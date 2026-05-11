@extends('layouts.app')

@section('title', 'Conversion Rate | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split split-hero">
                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">Conversion rate</p>
                    <h1 class="heading-hero">Più valore dallo stesso traffico.</h1>
                    <p class="copy-light copy-hero">
                        Analizziamo pagina, funnel, copy, UX, proof e numeri per individuare le perdite di conversione
                        e trasformarle in priorità operative.
                    </p>
                    <div class="actions">
                        <a href="{{ route('audit') }}" class="button mobile-fullwidth">Richiedi audit</a>
                        <a href="{{ route('work') }}" class="button-secondary mobile-fullwidth">Vedi work</a>
                    </div>
                </div>

                <aside class="card card-stack card-feature card-yellow">
                    <span class="label">Service 02</span>
                    <strong class="card-title">Stop leaking intent.</strong>
                </aside>
            </div>
        </section>

        <section class="section">
            <div class="shell card-grid card-grid-four">
                <article class="card card-stack card-service card-cream">
                    <span class="label">01</span>
                    <h2 class="card-title card-title-large">Audit euristico.</h2>
                    <p class="card-copy">Scoviamo frizioni, salti logici e mancanze di fiducia.</p>
                </article>
                <article class="card card-stack card-service card-yellow">
                    <span class="label">02</span>
                    <h2 class="card-title card-title-large">Priorità test.</h2>
                    <p class="card-copy">Non tutto conta uguale. Decidiamo cosa può muovere i numeri prima.</p>
                </article>
                <article class="card card-stack card-service card-violet">
                    <span class="label">03</span>
                    <h2 class="card-title card-title-large">Page redesign.</h2>
                    <p class="card-copy">Ristrutturiamo sezioni, messaggio e CTA con logica di conversione.</p>
                </article>
                <article class="card card-stack card-service card-orange">
                    <span class="label">04</span>
                    <h2 class="card-title card-title-large">Misurazione.</h2>
                    <p class="card-copy">Ogni intervento deve diventare leggibile, non solo più bello.</p>
                </article>
            </div>
        </section>
    </main>
@endsection
