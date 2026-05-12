@extends('layouts.app')

@section('title', 'Produce a Value')

@section('content')

    <main>

        <section class="section section-hero">
            <div class="shell split split-hero">

                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">Performance Marketing Agency</p>

                    <h1 class="heading-hero">
                        Migliora i tuoi<br>
                        risultati o non ci<br>
                        paghi un centesimo.
                    </h1>

                    <p class="copy-light copy-hero">
                        Fai una prova di 90 giorni con Produce a Value, se non raggiungiamo i risultati prestabiliti, ti restituiamo tutto, fino all'ultimo centesimo.
                    </p>

                    <div class="actions">
                        <a href="{{ route('audit') }}" class="button mobile-fullwidth">Richiedi audit</a>
                    </div>
                </div>

                <div class="step-grid">
                    <div class="card card-stack card-step card-cream">
                        <span class="label">Step 01</span>
                        <span class="card-title">Offerta irrinunciabile</span>
                    </div>

                    <div class="card card-stack card-step card-violet">
                        <span class="label">Step 02</span>
                        <span class="card-title">Funneling perfetto</span>
                    </div>

                    <div class="card card-stack card-step card-orange">
                        <span class="label">Step 03</span>
                        <span class="card-title">Campagne da urlo</span>
                    </div>
                </div>

            </div>
        </section>

        <section class="section">
            <div class="shell split">

                <div class="panel-dark">
                    <p class="kicker">Il nostro approccio</p>
                    <h2 class="heading-section">Risultati,<br>niente chiacchiere.</h2>
                    <p class="copy-light copy-narrow">Lavoriamo per portare solo ed esclusivamente risultati economici concreti e tangibili ai nostri clienti. Con la formula del Revenue Share, non guadagni, non ci paghi.</p>
                </div>

                <div class="card-grid">
                    <article class="card card-stack card-metric card-cream">
                        <span class="label">Clienti</span>
                        <strong class="metric-value">127</strong>
                        <p class="card-copy">Aziende che si sono affidate a PAV negli ultimi 5 anni.</p>
                    </article>

                    <article class="card card-stack card-metric card-yellow">
                        <span class="label">Paid traffic</span>
                        <strong class="metric-value">28.7 mln€</strong>
                        <p class="card-copy">Budget ADV gestito per i nostri clienti.</p>
                    </article>

                    <article class="card card-stack card-metric card-violet">
                        <span class="label">Campaigns management</span>
                        <strong class="metric-value">8,43X</strong>
                        <p class="card-copy">ROAS medio delle nostre campagne ADV.</p>
                    </article>

                    <article class="card card-stack card-metric card-orange">
                        <span class="label">Next move</span>
                        <strong class="metric-value">90d</strong>
                        <p class="card-copy">L'audit serve a decidere cosa può muovere i numeri nei prossimi 90 giorni.</p>
                    </article>
                </div>

            </div>
        </section>

        <section class="section">
            <div class="shell">
                <div class="panel-dark">
                    <p class="kicker">Diagnosi gratuita</p>
                    <h2 class="heading-funnel">Trasforma i dati nella tua roadmap grazie al nostro Free Audit</h2>
                    <p class="copy-light copy-wide">
                        Analizzeremo insieme ogni singolo dettaglio del tuo store/funnel, passeremo sotto la lente d'ingrandimento le tue ads e renderemo le tue offerte da standard ad indimenticabili.
                        <br>Siamo così sicuri dei nostri metodi, che se non ottieni risultati, non ci paghi.
                    </p>
                    <div class="actions">
                        <a href="{{ route('audit') }}" class="button mobile-fullwidth">Richiedi il tuo audit</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="shell split">

                <div class="panel-dark sticky-panel">
                    <p class="kicker">Domande frequenti</p>
                    <h2 class="heading-section">Domande,<br>risposte,<br>zero fuffa.</h2>
                    <p class="copy-light copy-narrow">Tutto ciò che ti serve sapere prima iniziare il tuo progetto con noi, prenotare una chiamata o decidere se siamo la soluzione che fa al caso tuo.</p>
                </div>

                <div class="faq-list">

                    <div class="faq-item active">
                        <button class="faq-question" type="button" aria-expanded="true">
                            <span>What kind of projects do you usually take on?</span>
                            <span class="faq-icon"></span>
                        </button>
                        <div class="faq-answer">
                            <p>
                                We usually work on high-impact landing pages, agency websites,
                                conversion-focused redesigns and digital experiences where brand
                                perception matters as much as performance.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            <span>Do you only handle design, or also development?</span>
                            <span class="faq-icon"></span>
                        </button>
                        <div class="faq-answer">
                            <p>
                                Both. Strategy, interface design and front-end execution can all be
                                part of the same process.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            <span>Can you work on an existing brand without rebuilding everything?</span>
                            <span class="faq-icon"></span>
                        </button>
                        <div class="faq-answer">
                            <p>
                                Yes. Sometimes the right move is not a full reset but a sharper
                                structure, better hierarchy and stronger conversion logic.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            <span>How fast can a project realistically move?</span>
                            <span class="faq-icon"></span>
                        </button>
                        <div class="faq-answer">
                            <p>
                                It depends on scope, but focused pages can move very quickly.
                                The biggest variable is usually decision speed.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            <span>Are you a good fit for every type of client?</span>
                            <span class="faq-icon"></span>
                        </button>
                        <div class="faq-answer">
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
