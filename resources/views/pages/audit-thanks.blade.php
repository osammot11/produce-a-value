@extends('layouts.app')

@section('title', 'Audit richiesto | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split split-hero">
                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">Audit richiesto</p>
                    <h1 class="heading-hero">Dati ricevuti. Ora guardiamo dove perde il funnel.</h1>
                    <p class="copy-light copy-hero">
                        La richiesta è stata salvata. Se c'è fit, ti ricontatteremo per trasformare i dati in una
                        direzione operativa chiara.
                    </p>
                    <div class="actions">
                        <a href="{{ route('work') }}" class="button mobile-fullwidth">Vedi il work</a>
                        <a href="{{ route('risorsa') }}" class="button-secondary mobile-fullwidth">Scarica risorsa</a>
                    </div>
                </div>

                <aside class="card card-stack card-feature card-violet">
                    <span class="label">Next</span>
                    <strong class="card-title">Analysis before action.</strong>
                </aside>
            </div>
        </section>
    </main>
@endsection
