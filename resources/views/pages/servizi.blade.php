@extends('layouts.app')

@section('title', 'Servizi | Produce a Value')

@section('content')
    <main class="page-brutal">
        <section class="page-hero-brutal">
            <div class="page-hero-brutal-main">
                <p class="page-brutal-kicker">Servizi</p>
                <h1 class="page-brutal-title">Strategia, design e performance nello stesso colpo.</h1>
                <p class="page-brutal-text">
                    Costruiamo sistemi digitali per brand che vogliono posizionarsi meglio, vendere di più
                    e smettere di sembrare intercambiabili.
                </p>
            </div>

            <aside class="page-hero-brutal-side">
                <span>01</span>
                <strong>From idea to impact.</strong>
            </aside>
        </section>

        <section class="service-brutal-grid">
            <article class="service-brutal-card service-brutal-card-yellow">
                <span class="service-brutal-index">01</span>
                <h2>Landing pages</h2>
                <p>Pagine per campagne, lanci e funnel dove estetica e conversione lavorano insieme.</p>
                <a href="{{ route('services.landing-page') }}" class="service-brutal-link">Approfondisci</a>
            </article>

            <article class="service-brutal-card service-brutal-card-violet">
                <span class="service-brutal-index">02</span>
                <h2>Conversion rate</h2>
                <p>Audit, CRO e ottimizzazione per spremere più valore dal traffico che hai già.</p>
                <a href="{{ route('services.conversion-rate') }}" class="service-brutal-link">Approfondisci</a>
            </article>

            <article class="service-brutal-card service-brutal-card-orange">
                <span class="service-brutal-index">03</span>
                <h2>Creative performance</h2>
                <p>Creatività, angle e asset per campagne che devono generare apprendimento e vendite.</p>
                <a href="{{ route('services.creative-performance') }}" class="service-brutal-link">Approfondisci</a>
            </article>

            <article class="service-brutal-card service-brutal-card-dark">
                <span class="service-brutal-index">04</span>
                <h2>Funnel audit</h2>
                <p>Diagnosi brutale su offerta, pagina, traffico, tracking e priorità dei prossimi 90 giorni.</p>
                <a href="{{ route('audit') }}" class="service-brutal-link">Richiedi audit</a>
            </article>
        </section>

        <section class="process-brutal">
            <div class="process-brutal-heading">
                <p class="page-brutal-kicker">Metodo</p>
                <h2>Veloci, ma non casuali.</h2>
            </div>

            <div class="process-brutal-list">
                <div><span>Audit</span><p>Capire dove perdi attenzione, fiducia e conversione.</p></div>
                <div><span>Direction</span><p>Definire messaggio, struttura e priorità prima di disegnare.</p></div>
                <div><span>Execution</span><p>Produrre pagine e asset con ritmo, controllo e feedback breve.</p></div>
                <div><span>Measure</span><p>Leggere i risultati e trasformarli in prossime mosse.</p></div>
            </div>
        </section>
    </main>
@endsection
