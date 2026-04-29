@extends('layouts.app')

@section('title', 'Creative Performance | Produce a Value')

@section('content')
    <main class="page-brutal">
        <section class="page-hero-brutal">
            <div class="page-hero-brutal-main">
                <p class="page-brutal-kicker">Creative performance</p>
                <h1 class="page-brutal-title">Creatività che non si ferma al bello.</h1>
                <p class="page-brutal-text">
                    Costruiamo angle, asset e pagine con una logica testabile: attenzione, promessa, prova,
                    obiezione e azione.
                </p>
                <div class="hero-brutal-actions">
                    <a href="{{ route('audit') }}" class="brutal-button hero-brutal-cta-primary">Richiedi audit</a>
                    <a href="{{ route('risorsa') }}" class="hero-brutal-cta-secondary">Scarica risorsa</a>
                </div>
            </div>

            <aside class="page-hero-brutal-side page-hero-brutal-side-orange">
                <span>Service 03</span>
                <strong>Make ads worth clicking.</strong>
            </aside>
        </section>

        <section class="service-brutal-grid">
            <article class="service-brutal-card service-brutal-card-yellow">
                <span class="service-brutal-index">01</span>
                <h2>Angles</h2>
                <p>Nuovi modi di raccontare valore, urgenza, desiderio e differenza.</p>
            </article>
            <article class="service-brutal-card service-brutal-card-violet">
                <span class="service-brutal-index">02</span>
                <h2>Assets</h2>
                <p>Creatività statiche e direzioni video pensate per testing e iterazione.</p>
            </article>
            <article class="service-brutal-card service-brutal-card-orange">
                <span class="service-brutal-index">03</span>
                <h2>Landing match</h2>
                <p>Allineiamo ad, promessa e pagina per evitare frizione post-click.</p>
            </article>
            <article class="service-brutal-card service-brutal-card-dark">
                <span class="service-brutal-index">04</span>
                <h2>Learning loop</h2>
                <p>Trasformiamo risultati e segnali deboli in nuove ipotesi creative.</p>
            </article>
        </section>
    </main>
@endsection
