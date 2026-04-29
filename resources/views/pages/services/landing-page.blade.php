@extends('layouts.app')

@section('title', 'Landing Page | Produce a Value')

@section('content')
    <main class="page-brutal">
        <section class="page-hero-brutal">
            <div class="page-hero-brutal-main">
                <p class="page-brutal-kicker">Landing pages</p>
                <h1 class="page-brutal-title">Pagine per trasformare traffico in domanda.</h1>
                <p class="page-brutal-text">
                    Progettiamo landing e funnel page per campagne paid, lanci, validazione offerte e acquisizione
                    lead. Ogni blocco deve guadagnarsi il posto nella pagina.
                </p>
                <div class="hero-brutal-actions">
                    <a href="{{ route('audit') }}" class="brutal-button hero-brutal-cta-primary">Richiedi audit</a>
                    <a href="{{ route('risorsa') }}" class="hero-brutal-cta-secondary">Scarica risorsa</a>
                </div>
            </div>

            <aside class="page-hero-brutal-side">
                <span>Service 01</span>
                <strong>Traffic needs a destination.</strong>
            </aside>
        </section>

        <section class="process-brutal">
            <div class="process-brutal-heading">
                <p class="page-brutal-kicker">Focus</p>
                <h2>Cosa sistemiamo.</h2>
            </div>
            <div class="process-brutal-list">
                <div><span>Offer</span><p>Promessa, angle, rischio percepito e motivo per agire ora.</p></div>
                <div><span>Structure</span><p>Hero, proof, obiezioni, CTA e sequenza narrativa.</p></div>
                <div><span>Copy</span><p>Messaggio diretto, specifico e costruito per il target.</p></div>
                <div><span>Tracking</span><p>Eventi e micro-conversioni per leggere cosa succede davvero.</p></div>
            </div>
        </section>
    </main>
@endsection
