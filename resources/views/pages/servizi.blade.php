@extends('layouts.app')

@section('title', 'Servizi | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split split-hero">
                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">Servizi</p>
                    <h1 class="heading-hero">Strategia, design e performance nello stesso colpo.</h1>
                    <p class="copy-light copy-hero">
                        Costruiamo sistemi digitali per brand che vogliono posizionarsi meglio, vendere di più
                        e smettere di sembrare intercambiabili.
                    </p>
                </div>

                <aside class="card card-stack card-feature card-violet">
                    <span class="label">01</span>
                    <strong class="card-title">From idea to impact.</strong>
                </aside>
            </div>
        </section>

        <section class="section">
            <div class="shell card-grid card-grid-four">
                <article class="card card-stack card-service card-yellow">
                    <span class="label">01</span>
                    <h2 class="card-title card-title-large">Landing pages</h2>
                    <p class="card-copy">Pagine per campagne, lanci e funnel dove estetica e conversione lavorano insieme.</p>
                    <a href="{{ route('services.landing-page') }}" class="link-button">Approfondisci</a>
                </article>

                <article class="card card-stack card-service card-violet">
                    <span class="label">02</span>
                    <h2 class="card-title card-title-large">Conversion rate</h2>
                    <p class="card-copy">Audit, CRO e ottimizzazione per spremere più valore dal traffico che hai già.</p>
                    <a href="{{ route('services.conversion-rate') }}" class="link-button">Approfondisci</a>
                </article>

                <article class="card card-stack card-service card-orange">
                    <span class="label">03</span>
                    <h2 class="card-title card-title-large">Creative performance</h2>
                    <p class="card-copy">Creatività, angle e asset per campagne che devono generare apprendimento e vendite.</p>
                    <a href="{{ route('services.creative-performance') }}" class="link-button">Approfondisci</a>
                </article>

                <article class="card card-stack card-service card-dark">
                    <span class="label">04</span>
                    <h2 class="card-title card-title-large">Ticketing custom</h2>
                    <p class="card-copy">Sistemi proprietari per iscrizioni, pagamenti, ticket PDF, admin e checkout eventi.</p>
                    <a href="{{ route('services.ticketing-custom') }}" class="link-button">Approfondisci</a>
                </article>

                <article class="card card-stack card-service card-cream">
                    <span class="label">05</span>
                    <h2 class="card-title card-title-large">Funnel audit</h2>
                    <p class="card-copy">Diagnosi brutale su offerta, pagina, traffico, tracking e priorità dei prossimi 90 giorni.</p>
                    <a href="{{ route('audit') }}" class="link-button">Richiedi audit</a>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="shell split">
                <div class="panel-dark">
                    <p class="kicker">Metodo</p>
                    <h2 class="heading-section">Veloci, ma non casuali.</h2>
                </div>

                <div class="card-grid">
                    <div class="card card-process card-cream">
                        <span class="label">Audit</span>
                        <p class="card-copy">Capire dove perdi attenzione, fiducia e conversione.</p>
                    </div>
                    <div class="card card-process card-cream">
                        <span class="label">Direction</span>
                        <p class="card-copy">Definire messaggio, struttura e priorità prima di disegnare.</p>
                    </div>
                    <div class="card card-process card-cream">
                        <span class="label">Execution</span>
                        <p class="card-copy">Produrre pagine e asset con ritmo, controllo e feedback breve.</p>
                    </div>
                    <div class="card card-process card-cream">
                        <span class="label">Measure</span>
                        <p class="card-copy">Leggere i risultati e trasformarli in prossime mosse.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
