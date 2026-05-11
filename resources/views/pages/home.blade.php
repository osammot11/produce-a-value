@extends('layouts.app')

@section('title', 'Produce a Value')

@section('content')

    <main>

        <section class="hero-brutal">
            <div class="hero-brutal-grid">

                <div class="hero-brutal-main">
                    <p class="hero-brutal-kicker">Performance Marketing Agency</p>

                    <h1 class="hero-brutal-title">
                        Migliora i tuoi<br>
                        risultati o non ci<br>
                        paghi un centesimo.
                    </h1>

                    <p class="hero-brutal-text">
                        Fai una prova di 90 giorni con Produce a Value, se non raggiungiamo i risultati prestabiliti, ti restituiamo tutto, fino all'ultimo centesimo.
                    </p>

                    <div class="hero-brutal-actions">
                        <a href="{{ route('audit') }}" class="brutal-button hero-brutal-cta-primary mobile-fullwidth">Richiedi audit</a>
                    </div>
                </div>

                <div class="hero-brutal-side">
                    <div class="hero-brutal-card hero-brutal-card-top">
                        <span class="hero-brutal-card-label">Step 01</span>
                        <span class="hero-brutal-card-value">Offerta irrinunciabile</span>
                    </div>

                    <div class="hero-brutal-card hero-brutal-card-middle">
                        <span class="hero-brutal-card-label">Step 02</span>
                        <span class="hero-brutal-card-value">Funneling perfetto</span>
                    </div>

                    <div class="hero-brutal-card hero-brutal-card-bottom">
                        <span class="hero-brutal-card-label">Step 03</span>
                        <span class="hero-brutal-card-value">Campagne da urlo</span>
                    </div>
                </div>

            </div>
        </section>

        <section class="stats-brutal">
            <div class="stats-brutal-shell">

                <div class="stats-brutal-intro">
                    <p class="stats-brutal-kicker">Il nostro approccio</p>
                    <h2 class="stats-brutal-title">Risultati,<br>niente chiacchiere.</h2>
                    <p class="stats-brutal-text">Lavoriamo per portare solo ed esclusivamente risultati economici concreti e tangibili ai nostri clienti. Con la formula del Revenue Share, non guadagni, non ci paghi.</p>
                </div>

                <div class="stats-brutal-grid">
                    <article class="stats-brutal-card stats-brutal-card-dark">
                        <span class="stats-brutal-label">Clienti</span>
                        <strong class="stats-brutal-value">127</strong>
                        <p class="stats-brutal-note">Aziende che si sono affidate a PAV negli ultimi 5 anni.</p>
                    </article>

                    <article class="stats-brutal-card stats-brutal-card-yellow">
                        <span class="stats-brutal-label">Paid traffic</span>
                        <strong class="stats-brutal-value">28.7 mln€</strong>
                        <p class="stats-brutal-note">Budget ADV gestito per i nostri clienti.</p>
                    </article>

                    <article class="stats-brutal-card stats-brutal-card-violet">
                        <span class="stats-brutal-label">Campaigns management</span>
                        <strong class="stats-brutal-value">8,43X</strong>
                        <p class="stats-brutal-note">ROAS medio delle nostre campagne ADV.</p>
                    </article>

                    <article class="stats-brutal-card stats-brutal-card-orange">
                        <span class="stats-brutal-label">Next move</span>
                        <strong class="stats-brutal-value">90d</strong>
                        <p class="stats-brutal-note">L'audit serve a decidere cosa può muovere i numeri nei prossimi 90 giorni.</p>
                    </article>
                </div>

            </div>
        </section>

        <section class="stats-brutal container">
            <div class="home-funnel-main stack-large">
                <p class="hero-brutal-kicker">Diagnosi gratuita</p>
                <h2 class="top-margin-mid">Trasforma i dati nella tua roadmap grazie al nostro Free Audit</h2>
                <p>Analizzeremo insieme ogni singolo dettaglio del tuo store/funnel, passeremo sotto la lente d'ingrandimento le tue ads e renderemo le tue offerte da standard ad indimenticabili.
                    <br>Siamo così sicuri dei nostri metodi, che se non ottieni risultati, non ci paghi.</p>
                <a href="{{ route('audit') }}" class="brutal-button mobile-fullwidth top-margin-large">Richiedi il tuo audit</a>
        </section>

        <section class="faq-brutal">
            <div class="faq-brutal-shell">

                <div class="faq-brutal-heading">
                    <p class="faq-brutal-kicker">Domande frequenti</p>
                    <h2 class="faq-brutal-title">Domande,<br>risposte,<br>zero fuffa.</h2>
                    <p class="faq-brutal-text">Tutto ciò che ti serve sapere prima iniziare il tuo progetto con noi, prenotare una chiamata o decidere se siamo la soluzione che fa al caso tuo.</p>
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
