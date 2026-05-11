@extends('layouts.app')

@section('title', 'Creative Performance | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split split-hero">
                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">Creative performance</p>
                    <h1 class="heading-hero">Creatività che non si ferma al bello.</h1>
                    <p class="copy-light copy-hero">
                        Costruiamo angle, asset e pagine con una logica testabile: attenzione, promessa, prova,
                        obiezione e azione.
                    </p>
                    <div class="actions">
                        <a href="{{ route('audit') }}" class="button mobile-fullwidth">Richiedi audit</a>
                        <a href="{{ route('risorsa') }}" class="button-secondary mobile-fullwidth">Scarica risorsa</a>
                    </div>
                </div>

                <aside class="card card-stack card-feature card-orange">
                    <span class="label">Service 03</span>
                    <strong class="card-title">Make ads worth clicking.</strong>
                </aside>
            </div>
        </section>

        <section class="section">
            <div class="shell card-grid card-grid-four">
                <article class="card card-stack card-service card-yellow">
                    <span class="label">01</span>
                    <h2 class="card-title card-title-large">Angles</h2>
                    <p class="card-copy">Nuovi modi di raccontare valore, urgenza, desiderio e differenza.</p>
                </article>
                <article class="card card-stack card-service card-violet">
                    <span class="label">02</span>
                    <h2 class="card-title card-title-large">Assets</h2>
                    <p class="card-copy">Creatività statiche e direzioni video pensate per testing e iterazione.</p>
                </article>
                <article class="card card-stack card-service card-orange">
                    <span class="label">03</span>
                    <h2 class="card-title card-title-large">Landing match</h2>
                    <p class="card-copy">Allineiamo ad, promessa e pagina per evitare frizione post-click.</p>
                </article>
                <article class="card card-stack card-service card-dark">
                    <span class="label">04</span>
                    <h2 class="card-title card-title-large">Learning loop</h2>
                    <p class="card-copy">Trasformiamo risultati e segnali deboli in nuove ipotesi creative.</p>
                </article>
            </div>
        </section>
    </main>
@endsection
