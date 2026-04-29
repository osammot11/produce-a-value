@extends('layouts.app')

@section('title', 'Richiedi Audit | Produce a Value')

@section('content')
    <main class="audit-brutal">
        <section class="audit-brutal-shell">
            <div class="audit-brutal-intro">
                <p class="page-brutal-kicker">Audit gratuito</p>
                <h1 class="page-brutal-title">Scopri dove il tuo funnel sta perdendo soldi.</h1>
                <p class="page-brutal-text">
                    Rispondi alle domande. Noi useremo i dati per capire se possiamo aiutarti e dove intervenire
                    prima: traffico, creatività, landing, conversion rate o offerta.
                </p>

                <div class="audit-brutal-proof">
                    <span>8 step</span>
                    <strong>Zero call inutili. Solo dati, contesto e prossima mossa.</strong>
                </div>
            </div>

            <form class="audit-form-brutal" action="{{ route('audit.store') }}" method="post" data-multistep-form>
                @csrf

                @if ($errors->any())
                    <div class="audit-error-brutal">
                        <strong>Ci sono dati da sistemare.</strong>
                        <p>Controlla i campi evidenziati e completa il form.</p>
                    </div>
                @endif

                <div class="audit-progress-brutal" aria-label="Avanzamento form">
                    <span data-progress-label>Step 1 di 8</span>
                    <div><i data-progress-bar></i></div>
                </div>

                <section class="audit-step-brutal is-active" data-step>
                    <span class="audit-step-index">01 / Business basics</span>
                    <h2>Partiamo dalle coordinate.</h2>

                    <div class="audit-field-grid">
                        <label>Nome
                            <input type="text" name="name" value="{{ old('name') }}" data-summary="Nome" required>
                        </label>
                        <label>Email
                            <input type="email" name="email" value="{{ old('email') }}" data-summary="Email" required>
                        </label>
                        <label>Azienda
                            <input type="text" name="company" value="{{ old('company') }}" data-summary="Azienda" required>
                        </label>
                        <label>Sito web
                            <input type="text" name="website" value="{{ old('website') }}" placeholder="https://..." data-summary="Sito">
                        </label>
                        <label>Ruolo
                            <input type="text" name="role" value="{{ old('role') }}" data-summary="Ruolo">
                        </label>
                    </div>
                </section>

                <section class="audit-step-brutal" data-step>
                    <span class="audit-step-index">02 / Business type</span>
                    <h2>Che macchina stai cercando di far crescere?</h2>

                    <div class="audit-field-grid">
                        <label>Tipo business
                            <select name="business_type" data-summary="Tipo business" required>
                                <option value="">Seleziona</option>
                                <option value="Ecommerce" @selected(old('business_type') === 'Ecommerce')>Ecommerce</option>
                                <option value="Startup SaaS" @selected(old('business_type') === 'Startup SaaS')>Startup SaaS</option>
                                <option value="Lead generation" @selected(old('business_type') === 'Lead generation')>Lead generation</option>
                                <option value="Altro" @selected(old('business_type') === 'Altro')>Altro</option>
                            </select>
                        </label>
                        <label>Mercato
                            <input type="text" name="market" value="{{ old('market') }}" placeholder="Italia, Europa, global..." data-summary="Mercato">
                        </label>
                        <label>Ticket medio / AOV
                            <input type="text" name="average_order_value" value="{{ old('average_order_value') }}" placeholder="Es. 80 euro, 2K, 15K..." data-summary="Ticket medio">
                        </label>
                    </div>
                </section>

                <section class="audit-step-brutal" data-step>
                    <span class="audit-step-index">03 / Traffico</span>
                    <h2>Da dove arrivano oggi clienti e vendite?</h2>

                    <div class="audit-check-grid" data-summary-group="Canali">
                        @foreach (['Meta Ads', 'Google Ads', 'SEO', 'Email', 'Organic social', 'Marketplace'] as $channel)
                            <label>
                                <input type="checkbox" name="channels[]" value="{{ $channel }}" @checked(in_array($channel, old('channels', [])))>
                                <span>{{ $channel }}</span>
                            </label>
                        @endforeach
                    </div>

                    <label class="audit-wide-field">Budget ads mensile
                        <select name="monthly_ad_budget" data-summary="Budget ads">
                            <option value="">Seleziona</option>
                            <option value="Sotto 2K" @selected(old('monthly_ad_budget') === 'Sotto 2K')>Sotto 2K</option>
                            <option value="2K - 10K" @selected(old('monthly_ad_budget') === '2K - 10K')>2K - 10K</option>
                            <option value="10K - 50K" @selected(old('monthly_ad_budget') === '10K - 50K')>10K - 50K</option>
                            <option value="50K+" @selected(old('monthly_ad_budget') === '50K+')>50K+</option>
                        </select>
                    </label>
                </section>

                <section class="audit-step-brutal" data-step>
                    <span class="audit-step-index">04 / Problema</span>
                    <h2>Qual è il collo di bottiglia più doloroso?</h2>

                    <label class="audit-wide-field">Problema principale
                        <select name="main_problem" data-summary="Problema principale" required>
                            <option value="">Seleziona</option>
                            <option value="Poche vendite" @selected(old('main_problem') === 'Poche vendite')>Poche vendite</option>
                            <option value="Conversion rate basso" @selected(old('main_problem') === 'Conversion rate basso')>Conversion rate basso</option>
                            <option value="Creatività che non performano" @selected(old('main_problem') === 'Creatività che non performano')>Creatività che non performano</option>
                            <option value="Funnel confuso" @selected(old('main_problem') === 'Funnel confuso')>Funnel confuso</option>
                            <option value="Tracking scarso" @selected(old('main_problem') === 'Tracking scarso')>Tracking scarso</option>
                        </select>
                    </label>
                </section>

                <section class="audit-step-brutal" data-step>
                    <span class="audit-step-index">05 / Numeri</span>
                    <h2>Dammi il quadro, anche se non è perfetto.</h2>

                    <div class="audit-field-grid">
                        <label>Revenue mensile
                            <input type="text" name="monthly_revenue" value="{{ old('monthly_revenue') }}" data-summary="Revenue mensile">
                        </label>
                        <label>Conversion rate
                            <input type="text" name="conversion_rate" value="{{ old('conversion_rate') }}" data-summary="Conversion rate">
                        </label>
                        <label>Lead / vendite mensili
                            <input type="text" name="monthly_sales" value="{{ old('monthly_sales') }}" data-summary="Lead o vendite">
                        </label>
                        <label>LTV
                            <input type="text" name="ltv" value="{{ old('ltv') }}" data-summary="LTV">
                        </label>
                    </div>
                </section>

                <section class="audit-step-brutal" data-step>
                    <span class="audit-step-index">06 / Obiettivo</span>
                    <h2>Cosa deve succedere nei prossimi 90 giorni?</h2>

                    <label class="audit-wide-field">Obiettivo
                        <textarea name="goal_90_days" rows="7" data-summary="Obiettivo 90 giorni" required>{{ old('goal_90_days') }}</textarea>
                    </label>
                </section>

                <section class="audit-step-brutal" data-step>
                    <span class="audit-step-index">07 / Fit</span>
                    <h2>Capire il fit ci evita perdite di tempo.</h2>

                    <div class="audit-field-grid">
                        <label>Budget progetto
                            <select name="project_budget" data-summary="Budget progetto" required>
                                <option value="">Seleziona</option>
                                <option value="Sotto 3K" @selected(old('project_budget') === 'Sotto 3K')>Sotto 3K</option>
                                <option value="3K - 8K" @selected(old('project_budget') === '3K - 8K')>3K - 8K</option>
                                <option value="8K - 20K" @selected(old('project_budget') === '8K - 20K')>8K - 20K</option>
                                <option value="20K+" @selected(old('project_budget') === '20K+')>20K+</option>
                            </select>
                        </label>
                        <label>Timing
                            <select name="timeline" data-summary="Timing" required>
                                <option value="">Seleziona</option>
                                <option value="Subito" @selected(old('timeline') === 'Subito')>Subito</option>
                                <option value="Entro 30 giorni" @selected(old('timeline') === 'Entro 30 giorni')>Entro 30 giorni</option>
                                <option value="1-3 mesi" @selected(old('timeline') === '1-3 mesi')>1-3 mesi</option>
                                <option value="Sto esplorando" @selected(old('timeline') === 'Sto esplorando')>Sto esplorando</option>
                            </select>
                        </label>
                        <label>Sei decision maker?
                            <select name="decision_maker" data-summary="Decision maker" required>
                                <option value="">Seleziona</option>
                                <option value="Sì" @selected(old('decision_maker') === 'Sì')>Sì</option>
                                <option value="No, ma influenzo la decisione" @selected(old('decision_maker') === 'No, ma influenzo la decisione')>No, ma influenzo la decisione</option>
                                <option value="No" @selected(old('decision_maker') === 'No')>No</option>
                            </select>
                        </label>
                        <label>Disponibile a intervenire subito?
                            <select name="ready_to_act" data-summary="Pronto ad agire" required>
                                <option value="">Seleziona</option>
                                <option value="1" @selected(old('ready_to_act') === '1')>Sì</option>
                                <option value="0" @selected(old('ready_to_act') === '0')>Non ancora</option>
                            </select>
                        </label>
                    </div>
                </section>

                <section class="audit-step-brutal" data-step>
                    <span class="audit-step-index">08 / Review</span>
                    <h2>Ultimo controllo.</h2>

                    <label class="audit-wide-field">Note extra
                        <textarea name="notes" rows="5" data-summary="Note">{{ old('notes') }}</textarea>
                    </label>

                    <div class="audit-review-brutal" data-review-list>
                        <p>Il riepilogo si aggiorna automaticamente mentre compili il form.</p>
                    </div>

                    <label class="audit-privacy-brutal">
                        <input type="checkbox" name="privacy_consent" value="1" required @checked(old('privacy_consent'))>
                        <span>Accetto il trattamento dei dati secondo la <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.</span>
                    </label>
                </section>

                <div class="audit-actions-brutal">
                    <button class="brutal-button audit-prev-brutal" type="button" data-prev-step>Indietro</button>
                    <button class="brutal-button audit-next-brutal" type="button" data-next-step>Avanti</button>
                    <button class="brutal-button audit-submit-brutal" type="submit" data-submit-step>Richiedi audit</button>
                </div>
            </form>
        </section>
    </main>
@endsection
