@extends('layouts.app')

@section('title', 'Servizi | Produce a Value')

@section('content')
    <main>
        <section class="brutal-section brutal-section-hero">
            <div class="brutal-shell brutal-split brutal-split-hero">
                <div class="brutal-panel-dark brutal-panel-dark-large">
                    <p class="brutal-kicker brutal-kicker-large">Servizi</p>
                    <h1 class="brutal-heading-hero">Strategia, design e performance nello stesso colpo.</h1>
                    <p class="brutal-copy-light brutal-copy-hero">
                        Costruiamo sistemi digitali per brand che vogliono posizionarsi meglio, vendere di più
                        e smettere di sembrare intercambiabili.
                    </p>
                </div>

                <aside class="brutal-card brutal-card-stack brutal-card-feature brutal-card-violet">
                    <span class="brutal-label">01</span>
                    <strong class="brutal-card-title">From idea to impact.</strong>
                </aside>
            </div>
        </section>

        <section class="brutal-section">
            <div class="brutal-shell brutal-card-grid brutal-card-grid-four">
                <article class="brutal-card brutal-card-stack brutal-card-service brutal-card-yellow">
                    <span class="brutal-label">01</span>
                    <h2 class="brutal-card-title brutal-card-title-large">Landing pages</h2>
                    <p class="brutal-card-copy">Pagine per campagne, lanci e funnel dove estetica e conversione lavorano insieme.</p>
                    <a href="{{ route('services.landing-page') }}" class="service-brutal-link">Approfondisci</a>
                </article>

                <article class="brutal-card brutal-card-stack brutal-card-service brutal-card-violet">
                    <span class="brutal-label">02</span>
                    <h2 class="brutal-card-title brutal-card-title-large">Conversion rate</h2>
                    <p class="brutal-card-copy">Audit, CRO e ottimizzazione per spremere più valore dal traffico che hai già.</p>
                    <a href="{{ route('services.conversion-rate') }}" class="service-brutal-link">Approfondisci</a>
                </article>

                <article class="brutal-card brutal-card-stack brutal-card-service brutal-card-orange">
                    <span class="brutal-label">03</span>
                    <h2 class="brutal-card-title brutal-card-title-large">Creative performance</h2>
                    <p class="brutal-card-copy">Creatività, angle e asset per campagne che devono generare apprendimento e vendite.</p>
                    <a href="{{ route('services.creative-performance') }}" class="service-brutal-link">Approfondisci</a>
                </article>

                <article class="brutal-card brutal-card-stack brutal-card-service brutal-card-dark">
                    <span class="brutal-label">04</span>
                    <h2 class="brutal-card-title brutal-card-title-large">Funnel audit</h2>
                    <p class="brutal-card-copy">Diagnosi brutale su offerta, pagina, traffico, tracking e priorità dei prossimi 90 giorni.</p>
                    <a href="{{ route('audit') }}" class="service-brutal-link">Richiedi audit</a>
                </article>
            </div>
        </section>

        <section class="brutal-section">
            <div class="brutal-shell brutal-split">
                <div class="brutal-panel-dark">
                    <p class="brutal-kicker">Metodo</p>
                    <h2 class="brutal-heading-section">Veloci, ma non casuali.</h2>
                </div>

                <div class="brutal-card-grid">
                    <div class="brutal-card brutal-card-process brutal-card-cream">
                        <span class="brutal-label">Audit</span>
                        <p class="brutal-card-copy">Capire dove perdi attenzione, fiducia e conversione.</p>
                    </div>
                    <div class="brutal-card brutal-card-process brutal-card-cream">
                        <span class="brutal-label">Direction</span>
                        <p class="brutal-card-copy">Definire messaggio, struttura e priorità prima di disegnare.</p>
                    </div>
                    <div class="brutal-card brutal-card-process brutal-card-cream">
                        <span class="brutal-label">Execution</span>
                        <p class="brutal-card-copy">Produrre pagine e asset con ritmo, controllo e feedback breve.</p>
                    </div>
                    <div class="brutal-card brutal-card-process brutal-card-cream">
                        <span class="brutal-label">Measure</span>
                        <p class="brutal-card-copy">Leggere i risultati e trasformarli in prossime mosse.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
