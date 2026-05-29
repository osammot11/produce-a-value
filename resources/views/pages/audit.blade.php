@extends('layouts.app')

@section('title', 'RADAR Strategico | Produce a Value')

@section('content')
    @php
        $options = [
            'online_since' => ['Meno di 6 mesi', '6-12 mesi', '1-2 anni', 'Più di 2 anni'],
            'monthly_revenue_range' => ['< 10k', '10 - 30k', '30 - 70k', '70 - 150k', '150k +'],
            'monthly_ads_spend_range' => ['0€', '< 1000€', '1000 - 5000€', '5000 - 15.000€', '15.000€ +'],
            'aov_range' => ['< 30€', '30 - 60€', '60 - 100€', '100€ +', 'Non conosco il mio AOV'],
            'ads_profitability' => ['Profittevoli e scalabili', 'Profittevoli ma instabili', 'Break-even', 'In perdita', 'Non facciamo ads strutturate'],
            'monthly_orders_range' => ['< 100', '100 - 300', '300 - 1000', '1000+'],
            'repeat_purchase_rate' => ['Sì, in modo costante', 'Qualcuno torna, poco strutturato', 'Quasi mai', 'Non lo so/non monitoriamo'],
            'channels' => ['Meta Ads', 'Google Ads', 'TikTok Ads', 'Email marketing/Automazioni', 'Influencer/Creators', 'Altro'],
            'current_strategy' => [
                'Cresciamo ma in modo disordinato',
                'Funziona, ma dipende troppo dalle ads',
                'Vendiamo, ma i margini sono il problema',
                'Abbiamo traffico, ma non converte',
                'Non abbiamo una strategia chiara',
            ],
            'bottleneck' => [
                'Acquisizione clienti',
                'Margini',
                'Retention / clienti che non tornano',
                'Struttura del funnel',
                'Troppe cose da fare, struttura non chiara',
            ],
        ];
    @endphp

    <main>
        <section class="section section-hero">
            <div class="shell split">
                <div class="panel-dark panel-dark-large sticky-panel">
                    <p class="kicker kicker-large">RADAR strategico</p>
                    <h1 class="heading-hero">Scopri cosa blocca davvero la crescita del tuo ecommerce.</h1>
                    <p class="copy-light copy-hero">
                        Rispondi al RADAR. Useremo le risposte per leggere numeri, canali, strategia e colli di bottiglia
                        prima di proporti la prossima mossa.
                    </p>

                    <div class="card card-process card-yellow callout">
                        <span class="label">16 step</span>
                        <strong class="card-title">Prima diagnosi, poi contatto. Zero form generici.</strong>
                    </div>
                </div>

                <form class="form-panel" action="{{ route('audit.store') }}" method="post" data-multistep-form>
                    @csrf

                    @if ($errors->any())
                        <div class="form-error">
                            <strong>Ci sono dati da sistemare.</strong>
                            <p>Controlla i campi evidenziati e completa il RADAR.</p>
                        </div>
                    @endif

                    <div class="progress" aria-label="Avanzamento form">
                        <span data-progress-label>Step 1 di 16</span>
                        <div><i data-progress-bar></i></div>
                    </div>

                    <section class="step is-active" data-step>
                        <span class="step-index">01 / Progetto</span>
                        <h2>Come si chiama il tuo brand?</h2>
                        <label class="wide-field">Brand
                            <input type="text" name="brand_name" value="{{ old('brand_name') }}" data-summary="Brand" required>
                        </label>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">02 / Vetrina</span>
                        <h2>Link al tuo ecommerce.</h2>
                        <label class="wide-field">URL ecommerce
                            <input type="text" name="ecommerce_url" value="{{ old('ecommerce_url') }}" placeholder="miodominio.com" inputmode="url" data-summary="Ecommerce" required>
                        </label>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">03 / Storico</span>
                        <h2>Da quanto siete online?</h2>
                        <div class="check-grid check-grid-stack">
                            @foreach ($options['online_since'] as $option)
                                <label>
                                    <input type="radio" name="online_since" value="{{ $option }}" data-summary="Storico online" required @checked(old('online_since') === $option)>
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">04 / Identità</span>
                        <h2>Cosa vendi e a chi?</h2>
                        <label class="wide-field">Prodotto e target
                            <textarea name="product_audience" rows="7" data-summary="Prodotto e target" required>{{ old('product_audience') }}</textarea>
                        </label>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">05 / Revenue</span>
                        <h2>Fatturato mensile medio.</h2>
                        <div class="check-grid check-grid-stack">
                            @foreach ($options['monthly_revenue_range'] as $option)
                                <label>
                                    <input type="radio" name="monthly_revenue_range" value="{{ $option }}" data-summary="Revenue mensile" required @checked(old('monthly_revenue_range') === $option)>
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">06 / Advertising</span>
                        <h2>Spesa mensile ads.</h2>
                        <div class="check-grid check-grid-stack">
                            @foreach ($options['monthly_ads_spend_range'] as $option)
                                <label>
                                    <input type="radio" name="monthly_ads_spend_range" value="{{ $option }}" data-summary="Spesa ads" required @checked(old('monthly_ads_spend_range') === $option)>
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">07 / Scontrino</span>
                        <h2>Scontrino medio (AOV).</h2>
                        <div class="check-grid check-grid-stack">
                            @foreach ($options['aov_range'] as $option)
                                <label>
                                    <input type="radio" name="aov_range" value="{{ $option }}" data-summary="AOV" required @checked(old('aov_range') === $option)>
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">08 / Performance</span>
                        <h2>Redditività delle ads.</h2>
                        <div class="check-grid check-grid-stack">
                            @foreach ($options['ads_profitability'] as $option)
                                <label>
                                    <input type="radio" name="ads_profitability" value="{{ $option }}" data-summary="Redditività ads" required @checked(old('ads_profitability') === $option)>
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">09 / Volume</span>
                        <h2>Ordini al mese.</h2>
                        <div class="check-grid check-grid-stack">
                            @foreach ($options['monthly_orders_range'] as $option)
                                <label>
                                    <input type="radio" name="monthly_orders_range" value="{{ $option }}" data-summary="Ordini mensili" required @checked(old('monthly_orders_range') === $option)>
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">10 / Fidelizzazione</span>
                        <h2>I clienti tornano a comprare?</h2>
                        <div class="check-grid check-grid-stack">
                            @foreach ($options['repeat_purchase_rate'] as $option)
                                <label>
                                    <input type="radio" name="repeat_purchase_rate" value="{{ $option }}" data-summary="Fidelizzazione" required @checked(old('repeat_purchase_rate') === $option)>
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">11 / Canali</span>
                        <h2>Canali attivi con continuità.</h2>
                        <div class="check-grid check-grid-stack" data-required-checkbox-group="Canali">
                            @foreach ($options['channels'] as $channel)
                                <label>
                                    <input type="checkbox" name="channels[]" value="{{ $channel }}" @checked(in_array($channel, old('channels', [])))>
                                    <span>{{ $channel }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">12 / Direzione</span>
                        <h2>La tua strategia attuale.</h2>
                        <div class="check-grid check-grid-stack">
                            @foreach ($options['current_strategy'] as $option)
                                <label>
                                    <input type="radio" name="current_strategy" value="{{ $option }}" data-summary="Strategia attuale" required @checked(old('current_strategy') === $option)>
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">13 / Criticità</span>
                        <h2>Il tuo collo di bottiglia.</h2>
                        <div class="check-grid check-grid-stack">
                            @foreach ($options['bottleneck'] as $option)
                                <label>
                                    <input type="radio" name="bottleneck" value="{{ $option }}" data-summary="Collo di bottiglia" required @checked(old('bottleneck') === $option)>
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">14 / Obiettivo</span>
                        <h2>Obiettivo per i prossimi 90 giorni.</h2>
                        <label class="wide-field">Obiettivo
                            <textarea name="goal_90_days" rows="7" data-summary="Obiettivo 90 giorni" required>{{ old('goal_90_days') }}</textarea>
                        </label>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">15 / Ostacolo</span>
                        <h2>Cosa ti blocca di più oggi?</h2>
                        <label class="wide-field">Ostacolo principale
                            <textarea name="biggest_obstacle" rows="7" data-summary="Ostacolo" required>{{ old('biggest_obstacle') }}</textarea>
                        </label>
                    </section>

                    <section class="step" data-step data-loading-step>
                        <span class="step-index">RADAR / Elaborazione</span>
                        <div class="loading-panel" aria-live="polite">
                            <h2>Stiamo leggendo i segnali del tuo ecommerce.</h2>
                            <p>Analisi di revenue, canali, margini, retention e collo di bottiglia in corso.</p>
                            <div class="loading-bars" aria-hidden="true">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </section>

                    <section class="step" data-step>
                        <span class="step-index">16 / Contatti</span>
                        <h2>Inserisci i tuoi dati per ricevere il report operativo personalizzato.</h2>

                        <div class="field-grid">
                            <label>Nome completo
                                <input type="text" name="name" value="{{ old('name') }}" data-summary="Nome" required>
                            </label>
                            <label>Email
                                <input type="email" name="email" value="{{ old('email') }}" data-summary="Email" required>
                            </label>
                            <label>Telefono
                                <input type="tel" name="phone" value="{{ old('phone') }}" data-summary="Telefono" required>
                            </label>
                        </div>

                        <label class="privacy-check">
                            <input type="checkbox" name="privacy_consent" value="1" required @checked(old('privacy_consent'))>
                            <span>Accetto il trattamento dei dati secondo la <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.</span>
                        </label>
                    </section>

                    <div class="form-actions">
                        <button class="button button-prev" type="button" data-prev-step>Indietro</button>
                        <button class="button button-next" type="button" data-next-step>Avanti</button>
                        <button class="button button-submit" type="submit" data-submit-step>Ricevi report</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
