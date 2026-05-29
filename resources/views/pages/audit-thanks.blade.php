@extends('layouts.app')

@section('title', 'Analisi RADAR | Produce a Value')

@section('content')
    @php
        $radarResult = session('radar_result');
        $score = $radarResult['score'] ?? null;
        $profile = $radarResult['profile'] ?? 'Diagnosi ricevuta';
        $priority = $radarResult['priority'] ?? 'analisi operativa';
        $summary = $radarResult['summary'] ?? 'Abbiamo ricevuto i dati. La prossima cosa da fare è trasformarli in una lettura operativa: dove si perde valore, quale leva muovere per prima e cosa evitare nei prossimi 90 giorni.';
        $recommendations = $radarResult['recommendations'] ?? [
            'Ricostruire il quadro tra traffico, offerta, pagina e retention.',
            'Individuare un solo collo di bottiglia prioritario prima di aggiungere nuove attività.',
            'Tradurre la diagnosi in una roadmap breve con metrica, owner e scadenza.',
        ];
        $scores = $radarResult['scores'] ?? [];
        $scoreLabels = [
            'maturity' => 'Maturità',
            'acquisition' => 'Acquisizione',
            'retention' => 'Retention',
            'strategy' => 'Strategia',
        ];
        $auditContact = $radarResult['audit'] ?? [];
    @endphp

    <main>
        <section class="section section-hero">
            <div class="shell split split-hero">
                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">Analisi RADAR ricevuta</p>
                    <h1 class="heading-hero">Ecco la prima lettura del tuo ecommerce.</h1>
                    <p class="copy-light copy-hero">
                        Questa è una diagnosi preliminare basata sulle risposte appena inviate. Serve a capire la
                        direzione, non a sostituire una call vera con numeri, contesto e priorità commerciali.
                    </p>
                    <div class="actions">
                        <a href="#call" class="button mobile-fullwidth">Prenota call gratuita</a>
                        <a href="{{ route('work') }}" class="button-secondary mobile-fullwidth">Vedi il work</a>
                    </div>
                </div>

                <aside class="card card-stack card-feature card-violet">
                    <span class="label">Profilo RADAR</span>
                    <strong class="card-title">{{ $profile }}</strong>
                    <p class="card-copy">Priorità emersa: {{ $priority }}.</p>
                    @if (! is_null($score))
                        <span class="metric-value">{{ $score }}/100</span>
                    @endif
                </aside>
            </div>
        </section>

        <section class="section">
            <div class="shell radar-analysis">
                <article class="card card-cream content-panel radar-analysis-main">
                    <span class="label">Diagnosi preliminare</span>
                    <h2>{{ $priority }}</h2>
                    <p>{{ $summary }}</p>
                </article>

                <div class="radar-score-grid">
                    @forelse ($scores as $area => $areaScore)
                        <article class="card card-stack card-process card-cream">
                            <span class="label">{{ $scoreLabels[$area] ?? ucfirst($area) }}</span>
                            <strong class="card-title">{{ $areaScore }}/100</strong>
                            <p class="card-copy">{{ match ($area) {
                                'maturity' => 'Quanto il progetto ha già storico, volume e segnali utili per decidere.',
                                'acquisition' => 'Quanto traffico, ads e canali sembrano già strutturati o scalabili.',
                                'retention' => 'Quanto il business recupera valore dopo il primo ordine.',
                                'strategy' => 'Quanto la direzione attuale appare chiara, ordinata e misurabile.',
                                default => 'Segnale operativo emerso dalle risposte del RADAR.',
                            } }}</p>
                        </article>
                    @empty
                        <article class="card card-stack card-process card-cream">
                            <span class="label">RADAR</span>
                            <strong class="card-title">Analisi salvata</strong>
                            <p class="card-copy">La diagnosi completa verrà letta insieme durante la call approfondita.</p>
                        </article>
                    @endforelse
                </div>

                <article class="card card-yellow content-panel radar-next-actions">
                    <span class="label">Cosa fare ora</span>
                    <h2>Le prime mosse non sono tutte uguali.</h2>
                    <ul class="check-list">
                        @foreach ($recommendations as $recommendation)
                            <li>{{ $recommendation }}</li>
                        @endforeach
                    </ul>
                </article>
            </div>
        </section>

        <section class="section" id="call">
            <div class="shell">
                <div class="panel-dark cal-section-heading">
                    <p class="kicker kicker-large">Call approfondita gratuita</p>
                    <h2 class="heading-section">Portiamo il RADAR dentro una conversazione vera.</h2>
                    <p class="copy-light copy-wide">
                        Prenota uno slot: guardiamo insieme risposte, numeri, priorità e fit. Se non ha senso lavorare
                        insieme, te lo diciamo senza giri larghi.
                    </p>
                </div>

                <div
                    class="card card-cream cal-booking"
                    data-cal-booking
                    data-slots-url="{{ route('audit.slots') }}"
                    data-book-url="{{ route('audit.book-call') }}"
                    data-thanks-url="{{ route('audit.call-thanks') }}"
                    data-timezone="{{ config('services.cal.timezone') }}"
                >
                    <div class="cal-booking-progress" aria-label="Avanzamento prenotazione">
                        <span class="is-active" data-cal-progress-step="0">Giorno</span>
                        <span data-cal-progress-step="1">Orario</span>
                        <span data-cal-progress-step="2">Dettagli</span>
                    </div>

                    <div class="cal-booking-steps">
                        <div class="cal-booking-step is-active" data-cal-booking-step>
                            <div class="cal-booking-panel">
                                <span class="label">1 / Giorno</span>
                                <h3>Scegli il giorno della call.</h3>
                                <div class="cal-slot-status" data-cal-status>Caricamento slot disponibili...</div>
                                <div class="cal-days" data-cal-days></div>
                            </div>
                        </div>

                        <div class="cal-booking-step" data-cal-booking-step>
                            <div class="cal-booking-panel">
                                <span class="label">2 / Orario</span>
                                <h3>Scegli l'orario che preferisci.</h3>
                                <p class="cal-slot-status" data-cal-selected-day></p>
                                <div class="cal-slots" data-cal-slots></div>
                                <button class="button-secondary cal-back-button" type="button" data-cal-back>Torna ai giorni</button>
                            </div>
                        </div>

                        <form class="cal-booking-step cal-booking-panel cal-booking-form" data-cal-form data-cal-booking-step>
                            <span class="label">3 / Dettagli contatto</span>
                            <h3>Conferma i dati per ricevere invito e link.</h3>
                            <p class="cal-slot-status" data-cal-selected-slot></p>
                            <input type="hidden" name="audit_id" value="{{ $auditContact['id'] ?? '' }}">
                            <input type="hidden" name="start" data-cal-start>

                            <label>Nome
                                <input type="text" name="name" value="{{ $auditContact['name'] ?? '' }}" required>
                            </label>

                            <label>Email
                                <input type="email" name="email" value="{{ $auditContact['email'] ?? '' }}" required>
                            </label>

                            <label>Telefono
                                <input type="tel" name="phone" value="{{ $auditContact['phone'] ?? '' }}" required>
                            </label>

                            <label>Note per la call
                                <textarea name="notes" rows="5" placeholder="Aggiungi contesto, link o priorità che vuoi discutere."></textarea>
                            </label>

                            <button class="button-secondary cal-back-button" type="button" data-cal-back>Torna agli orari</button>
                            <button class="button button-submit fullwidth" type="submit" data-cal-submit disabled>Prenota call gratuita</button>
                            <div class="cal-booking-loader" data-cal-loader aria-hidden="true">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <strong>Stiamo confermando la call con Cal.com...</strong>
                            </div>
                            <p class="cal-booking-message" data-cal-message></p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
