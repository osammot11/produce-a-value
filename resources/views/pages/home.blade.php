@extends('layouts.app')

@section('title', 'Produce a Value')

@section('content')

    <main>

        <section class="hero-brutal">
            <div class="hero-brutal-grid">

                <div class="hero-brutal-main">
                    <p class="hero-brutal-kicker">Funnel growth system</p>

                    <h1 class="hero-brutal-title">
                        Stop leaking<br>
                        traffic, sales<br>
                        and attention.
                    </h1>

                    <p class="hero-brutal-text">
                        Audit, landing pages and creative performance for ecommerce and startups that need
                        stronger funnels, not prettier excuses.
                    </p>

                    <div class="hero-brutal-actions">
                        <a href="{{ route('audit') }}" class="brutal-button hero-brutal-cta-primary">Richiedi audit</a>
                        <a href="{{ route('risorsa') }}" class="hero-brutal-cta-secondary">Scarica risorsa</a>
                    </div>
                </div>

                <div class="hero-brutal-side">
                    <div class="hero-brutal-card hero-brutal-card-top">
                        <span class="hero-brutal-card-label">Audit</span>
                        <span class="hero-brutal-card-value">Find the leaks</span>
                    </div>

                    <div class="hero-brutal-card hero-brutal-card-middle">
                        <span class="hero-brutal-card-label">Landing</span>
                        <span class="hero-brutal-card-value">Turn clicks into intent</span>
                    </div>

                    <div class="hero-brutal-card hero-brutal-card-bottom">
                        <span class="hero-brutal-card-label">Creative</span>
                        <span class="hero-brutal-card-value">Make tests worth running</span>
                    </div>
                </div>

            </div>
        </section>

        <section class="stats-brutal">
            <div class="stats-brutal-shell">

                <div class="stats-brutal-intro">
                    <p class="stats-brutal-kicker">Funnel problems</p>
                    <h2 class="stats-brutal-title">Leaks,<br>not vibes.</h2>
                    <p class="stats-brutal-text">
                        Se paghi traffico, pubblichi creatività e mandi persone su pagine deboli,
                        il problema non è fare più rumore. È chiudere le perdite.
                    </p>
                </div>

                <div class="stats-brutal-grid">
                    <article class="stats-brutal-card stats-brutal-card-dark">
                        <span class="stats-brutal-label">Above the fold</span>
                        <strong class="stats-brutal-value">03s</strong>
                        <p class="stats-brutal-note">Hai pochi secondi per far capire valore, differenza e prossima azione.</p>
                    </article>

                    <article class="stats-brutal-card stats-brutal-card-yellow">
                        <span class="stats-brutal-label">Paid traffic</span>
                        <strong class="stats-brutal-value">€</strong>
                        <p class="stats-brutal-note">Ogni click mandato su una pagina confusa diventa costo nascosto.</p>
                    </article>

                    <article class="stats-brutal-card stats-brutal-card-violet">
                        <span class="stats-brutal-label">Creative testing</span>
                        <strong class="stats-brutal-value">10x</strong>
                        <p class="stats-brutal-note">Più asset non bastano se angle, promessa e pagina non parlano insieme.</p>
                    </article>

                    <article class="stats-brutal-card stats-brutal-card-orange">
                        <span class="stats-brutal-label">Next move</span>
                        <strong class="stats-brutal-value">90d</strong>
                        <p class="stats-brutal-note">L'audit serve a decidere cosa può muovere i numeri nei prossimi 90 giorni.</p>
                    </article>
                </div>

            </div>
        </section>

        <section class="home-funnel-brutal">
            <div class="home-funnel-main">
                <p class="page-brutal-kicker">Free diagnostic</p>
                <h2>Prima capiamo dove perde. Poi decidiamo cosa costruire.</h2>
                <p>
                    Il percorso migliore parte dall'audit: raccogliamo dati su business, traffico, numeri,
                    problemi e urgenza. Se non sei pronto, scarica la checklist e fai una prima autodiagnosi.
                </p>
            </div>
            <div class="home-funnel-actions">
                <a href="{{ route('audit') }}" class="brutal-button">Richiedi audit</a>
                <a href="{{ route('risorsa') }}">Scarica risorsa</a>
            </div>
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
