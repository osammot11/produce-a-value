@extends('layouts.app')

@section('title', 'Landing Page | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split split-hero">
                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">Landing pages</p>
                    <h1 class="heading-hero">Pagine per trasformare traffico in domanda.</h1>
                    <p class="copy-light copy-hero">
                        Progettiamo landing e funnel page per campagne paid, lanci, validazione offerte e acquisizione
                        lead. Ogni blocco deve guadagnarsi il posto nella pagina.
                    </p>
                    <div class="actions">
                        <a href="{{ route('audit') }}" class="button mobile-fullwidth">Richiedi audit</a>
                        <a href="{{ route('risorsa') }}" class="button-secondary mobile-fullwidth">Scarica risorsa</a>
                    </div>
                </div>

                <aside class="card card-stack card-feature card-violet">
                    <span class="label">Service 01</span>
                    <strong class="card-title">Traffic needs a destination.</strong>
                </aside>
            </div>
        </section>

        <section class="section">
            <div class="shell split">
                <div class="panel-dark">
                    <p class="kicker">Focus</p>
                    <h2 class="heading-section">Cosa sistemiamo.</h2>
                </div>

                <div class="card-grid">
                    <div class="card card-process card-cream">
                        <span class="label">Offer</span>
                        <p class="card-copy">Promessa, angle, rischio percepito e motivo per agire ora.</p>
                    </div>
                    <div class="card card-process card-cream">
                        <span class="label">Structure</span>
                        <p class="card-copy">Hero, proof, obiezioni, CTA e sequenza narrativa.</p>
                    </div>
                    <div class="card card-process card-cream">
                        <span class="label">Copy</span>
                        <p class="card-copy">Messaggio diretto, specifico e costruito per il target.</p>
                    </div>
                    <div class="card card-process card-cream">
                        <span class="label">Tracking</span>
                        <p class="card-copy">Eventi e micro-conversioni per leggere cosa succede davvero.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
