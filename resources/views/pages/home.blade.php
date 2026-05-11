@extends('layouts.app')

@section('title', 'Produce a Value')

@section('content')

    <main>

        <section class="brutal-section brutal-section-hero">
            <div class="brutal-shell brutal-split brutal-split-hero">

                <div class="brutal-panel-dark brutal-panel-dark-large">
                    <p class="brutal-kicker brutal-kicker-large">Performance Marketing Agency</p>

                    <h1 class="brutal-heading-hero">
                        Migliora i tuoi<br>
                        risultati o non ci<br>
                        paghi un centesimo.
                    </h1>

                    <p class="brutal-copy-light brutal-copy-hero">
                        Fai una prova di 90 giorni con Produce a Value, se non raggiungiamo i risultati prestabiliti, ti restituiamo tutto, fino all'ultimo centesimo.
                    </p>

                    <div class="hero-brutal-actions">
                        <a href="{{ route('audit') }}" class="brutal-button mobile-fullwidth">Richiedi audit</a>
                    </div>
                </div>

                <div class="brutal-step-grid">
                    <div class="brutal-card brutal-card-stack brutal-card-step brutal-card-cream">
                        <span class="brutal-label">Step 01</span>
                        <span class="brutal-card-title">Offerta irrinunciabile</span>
                    </div>

                    <div class="brutal-card brutal-card-stack brutal-card-step brutal-card-violet">
                        <span class="brutal-label">Step 02</span>
                        <span class="brutal-card-title">Funneling perfetto</span>
                    </div>

                    <div class="brutal-card brutal-card-stack brutal-card-step brutal-card-orange">
                        <span class="brutal-label">Step 03</span>
                        <span class="brutal-card-title">Campagne da urlo</span>
                    </div>
                </div>

            </div>
        </section>

        <section class="brutal-section">
            <div class="brutal-shell brutal-split">

                <div class="brutal-panel-dark">
                    <p class="brutal-kicker">Il nostro approccio</p>
                    <h2 class="brutal-heading-section">Risultati,<br>niente chiacchiere.</h2>
                    <p class="brutal-copy-light brutal-copy-narrow">Lavoriamo per portare solo ed esclusivamente risultati economici concreti e tangibili ai nostri clienti. Con la formula del Revenue Share, non guadagni, non ci paghi.</p>
                </div>

                <div class="brutal-card-grid">
                    <article class="brutal-card brutal-card-stack brutal-card-metric brutal-card-cream">
                        <span class="brutal-label">Clienti</span>
                        <strong class="brutal-metric-value">127</strong>
                        <p class="brutal-card-copy">Aziende che si sono affidate a PAV negli ultimi 5 anni.</p>
                    </article>

                    <article class="brutal-card brutal-card-stack brutal-card-metric brutal-card-yellow">
                        <span class="brutal-label">Paid traffic</span>
                        <strong class="brutal-metric-value">28.7 mln€</strong>
                        <p class="brutal-card-copy">Budget ADV gestito per i nostri clienti.</p>
                    </article>

                    <article class="brutal-card brutal-card-stack brutal-card-metric brutal-card-violet">
                        <span class="brutal-label">Campaigns management</span>
                        <strong class="brutal-metric-value">8,43X</strong>
                        <p class="brutal-card-copy">ROAS medio delle nostre campagne ADV.</p>
                    </article>

                    <article class="brutal-card brutal-card-stack brutal-card-metric brutal-card-orange">
                        <span class="brutal-label">Next move</span>
                        <strong class="brutal-metric-value">90d</strong>
                        <p class="brutal-card-copy">L'audit serve a decidere cosa può muovere i numeri nei prossimi 90 giorni.</p>
                    </article>
                </div>

            </div>
        </section>

        <section class="brutal-section">
            <div class="brutal-shell">
                <div class="brutal-panel-dark">
                    <p class="brutal-kicker">Diagnosi gratuita</p>
                    <h2 class="brutal-heading-funnel">Trasforma i dati nella tua roadmap grazie al nostro Free Audit</h2>
                    <p class="brutal-copy-light brutal-copy-wide">
                        Analizzeremo insieme ogni singolo dettaglio del tuo store/funnel, passeremo sotto la lente d'ingrandimento le tue ads e renderemo le tue offerte da standard ad indimenticabili.
                        <br>Siamo così sicuri dei nostri metodi, che se non ottieni risultati, non ci paghi.
                    </p>
                    <div class="hero-brutal-actions">
                        <a href="{{ route('audit') }}" class="brutal-button mobile-fullwidth">Richiedi il tuo audit</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="brutal-section">
            <div class="brutal-shell brutal-split">

                <div class="brutal-panel-dark brutal-sticky">
                    <p class="brutal-kicker">Domande frequenti</p>
                    <h2 class="brutal-heading-section">Domande,<br>risposte,<br>zero fuffa.</h2>
                    <p class="brutal-copy-light brutal-copy-narrow">Tutto ciò che ti serve sapere prima iniziare il tuo progetto con noi, prenotare una chiamata o decidere se siamo la soluzione che fa al caso tuo.</p>
                </div>

                <div class="faq-brutal-list">

                    <div class="faq-brutal-item active">
                        <button class="faq-brutal-question" type="button" aria-expanded="true">
                            <span>What kind of projects do you usually take on?</span>
                            <span class="faq-brutal-icon"></span>
                        </button>
                        <div class="faq-brutal-answer">
                            <p>
                                We usually work on high-impact landing pages, agency websites,
                                conversion-focused redesigns and digital experiences where brand
                                perception matters as much as performance.
                            </p>
                        </div>
                    </div>

                    <div class="faq-brutal-item">
                        <button class="faq-brutal-question" type="button" aria-expanded="false">
                            <span>Do you only handle design, or also development?</span>
                            <span class="faq-brutal-icon"></span>
                        </button>
                        <div class="faq-brutal-answer">
                            <p>
                                Both. Strategy, interface design and front-end execution can all be
                                part of the same process.
                            </p>
                        </div>
                    </div>

                    <div class="faq-brutal-item">
                        <button class="faq-brutal-question" type="button" aria-expanded="false">
                            <span>Can you work on an existing brand without rebuilding everything?</span>
                            <span class="faq-brutal-icon"></span>
                        </button>
                        <div class="faq-brutal-answer">
                            <p>
                                Yes. Sometimes the right move is not a full reset but a sharper
                                structure, better hierarchy and stronger conversion logic.
                            </p>
                        </div>
                    </div>

                    <div class="faq-brutal-item">
                        <button class="faq-brutal-question" type="button" aria-expanded="false">
                            <span>How fast can a project realistically move?</span>
                            <span class="faq-brutal-icon"></span>
                        </button>
                        <div class="faq-brutal-answer">
                            <p>
                                It depends on scope, but focused pages can move very quickly.
                                The biggest variable is usually decision speed.
                            </p>
                        </div>
                    </div>

                    <div class="faq-brutal-item">
                        <button class="faq-brutal-question" type="button" aria-expanded="false">
                            <span>Are you a good fit for every type of client?</span>
                            <span class="faq-brutal-icon"></span>
                        </button>
                        <div class="faq-brutal-answer">
                            <p>
                                No. This style works best for brands that want strong positioning,
                                clear direction and real character.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main>

@endsection
