@extends('layouts.app')

@section('title', 'Manifesto | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split split-hero">
                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">Manifesto</p>
                    <h1 class="heading-hero">Il design deve avere carattere. La strategia deve vendere.</h1>
                    <p class="copy-light copy-hero">
                        Produce a Value nasce per costruire esperienze digitali che non cercano approvazione
                        generica: cercano attenzione, fiducia e movimento.
                    </p>
                    <div class="actions">
                        <a href="{{ route('audit') }}" class="button mobile-fullwidth">Richiedi audit</a>
                        <a href="{{ route('servizi') }}" class="button-secondary mobile-fullwidth">Vedi servizi</a>
                    </div>
                </div>

                <aside class="card card-stack card-feature card-yellow">
                    <span class="label">03</span>
                    <strong class="card-title">No pretty noise.</strong>
                </aside>
            </div>
        </section>

        <section class="section">
            <div class="shell card-grid card-grid-four">
                <article class="card card-stack card-service card-cream">
                    <span class="label">01</span>
                    <h2 class="card-title card-title-large">La chiarezza batte la decorazione.</h2>
                    <p class="card-copy">Ogni sezione deve aiutare qualcuno a capire, fidarsi o agire.</p>
                </article>

                <article class="card card-stack card-service card-yellow">
                    <span class="label">02</span>
                    <h2 class="card-title card-title-large">Il carattere non è caos.</h2>
                    <p class="card-copy">Uno stile forte funziona solo quando gerarchia, ritmo e messaggio sono sotto controllo.</p>
                </article>

                <article class="card card-stack card-service card-violet">
                    <span class="label">03</span>
                    <h2 class="card-title card-title-large">La performance non vive dopo il design.</h2>
                    <p class="card-copy">Conversione, contenuto e direzione visiva vanno progettati insieme dall'inizio.</p>
                </article>

                <article class="card card-stack card-service card-orange">
                    <span class="label">04</span>
                    <h2 class="card-title card-title-large">Meglio polarizzare che sparire.</h2>
                    <p class="card-copy">Un brand memorabile non prova a piacere a tutti. Parla meglio alle persone giuste.</p>
                </article>
            </div>
        </section>
    </main>
@endsection
