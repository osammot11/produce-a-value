@extends('layouts.admin')

@section('title', ($audit->brand_name ?: $audit->company) . ' | Audit Admin')

@section('content')
    <main class="admin-brutal">
        <section class="admin-detail-hero">
            <div>
                <p class="page-brutal-kicker">Audit #{{ $audit->id }}</p>
                <h1>{{ $audit->brand_name ?: $audit->company }}</h1>
                <p>
                    {{ $audit->name }} · <a href="mailto:{{ $audit->email }}">{{ $audit->email }}</a>
                    @if ($audit->phone)
                        · <a href="tel:{{ $audit->phone }}">{{ $audit->phone }}</a>
                    @endif
                    · <span class="admin-badge">{{ $statusOptions[$audit->crm_status] ?? $audit->crm_status }}</span>
                </p>
            </div>
            <a class="brutal-button" href="{{ route('admin.audits.index') }}">Torna agli audit</a>
        </section>

        @if (session('status'))
            <div class="admin-error-brutal">{{ session('status') }}</div>
        @endif

        <section class="admin-detail-grid">
            <article class="admin-detail-panel admin-detail-panel-wide">
                <h2>CRM interno</h2>
                <form class="admin-case-form admin-crm-form" action="{{ route('admin.audits.crm.update', $audit) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="admin-form-grid">
                        <label>Stato audit
                            <select name="crm_status" required>
                                @foreach ($statusOptions as $value => $label)
                                    <option value="{{ $value }}" @selected(old('crm_status', $audit->crm_status) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="admin-form-field-wide">Note interne
                            <textarea name="internal_notes" rows="6" placeholder="Prossimo follow-up, fit, obiezioni, contesto commerciale...">{{ old('internal_notes', $audit->internal_notes) }}</textarea>
                        </label>

                        <div class="admin-form-actions">
                            <span class="admin-empty-brutal">Queste note non sono visibili all'utente.</span>
                            <button class="brutal-button" type="submit">Aggiorna CRM</button>
                        </div>
                    </div>
                </form>
            </article>

            @if ($audit->radar_profile || $audit->radar_priority || $audit->radar_summary)
                <article class="admin-detail-panel admin-detail-panel-wide">
                    <h2>Diagnosi RADAR</h2>

                    <div class="admin-radar-strip">
                        <div>
                            <span>Score</span>
                            <strong>{{ is_null($audit->radar_score) ? '-' : $audit->radar_score.'/100' }}</strong>
                        </div>
                        <div>
                            <span>Profilo</span>
                            <strong>{{ $audit->radar_profile ?: 'Non calcolato' }}</strong>
                        </div>
                        <div>
                            <span>Priorità</span>
                            <strong>{{ $audit->radar_priority ?: 'Non calcolata' }}</strong>
                        </div>
                    </div>

                    @if ($audit->radar_summary)
                        <p class="admin-radar-summary">{{ $audit->radar_summary }}</p>
                    @endif

                    @if ($audit->radar_recommendations)
                        <ul class="admin-radar-list">
                            @foreach ($audit->radar_recommendations as $recommendation)
                                <li>{{ $recommendation }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if ($audit->radar_scores)
                        <div class="admin-radar-scores" aria-label="Score RADAR per area">
                            @foreach ($audit->radar_scores as $area => $score)
                                <span>{{ ucfirst($area) }} · {{ $score }}/100</span>
                            @endforeach
                        </div>
                    @endif
                </article>
            @endif

            @if ($audit->cal_booking_uid)
                <article class="admin-detail-panel admin-detail-panel-wide">
                    <h2>Call prenotata</h2>
                    <dl>
                        <dt>Quando</dt><dd>{{ $audit->cal_booking_start_at?->format('d/m/Y H:i') ?: 'Non indicato' }}</dd>
                        <dt>Status</dt><dd>{{ $audit->cal_booking_status ?: 'Non indicato' }}</dd>
                        <dt>UID Cal.com</dt><dd>{{ $audit->cal_booking_uid }}</dd>
                    </dl>
                </article>
            @endif

            <article class="admin-detail-panel">
                <h2>RADAR progetto</h2>
                <dl>
                    <dt>Brand</dt><dd>{{ $audit->brand_name ?: $audit->company }}</dd>
                    <dt>Ecommerce</dt><dd>{{ $audit->ecommerce_url ?: $audit->website ?: 'Non indicato' }}</dd>
                    <dt>Storico</dt><dd>{{ $audit->online_since ?: 'Non indicato' }}</dd>
                    <dt>Prodotto e target</dt><dd>{{ $audit->product_audience ?: 'Non indicato' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel">
                <h2>Numeri ecommerce</h2>
                <dl>
                    <dt>Revenue</dt><dd>{{ $audit->monthly_revenue_range ?: $audit->monthly_revenue ?: 'Non indicato' }}</dd>
                    <dt>Spesa ads</dt><dd>{{ $audit->monthly_ads_spend_range ?: $audit->monthly_ad_budget ?: 'Non indicato' }}</dd>
                    <dt>AOV</dt><dd>{{ $audit->aov_range ?: $audit->average_order_value ?: 'Non indicato' }}</dd>
                    <dt>Ordini</dt><dd>{{ $audit->monthly_orders_range ?: $audit->monthly_sales ?: 'Non indicato' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel">
                <h2>Performance e canali</h2>
                <dl>
                    <dt>Redditività ads</dt><dd>{{ $audit->ads_profitability ?: 'Non indicato' }}</dd>
                    <dt>Fidelizzazione</dt><dd>{{ $audit->repeat_purchase_rate ?: 'Non indicato' }}</dd>
                    <dt>Canali</dt><dd>{{ $audit->channels ? implode(', ', $audit->channels) : 'Non indicati' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel">
                <h2>Strategia e criticità</h2>
                <dl>
                    <dt>Strategia attuale</dt><dd>{{ $audit->current_strategy ?: 'Non indicato' }}</dd>
                    <dt>Collo di bottiglia</dt><dd>{{ $audit->bottleneck ?: $audit->main_problem }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel admin-detail-panel-wide">
                <h2>Obiettivo 90 giorni</h2>
                <p>{{ $audit->goal_90_days }}</p>
            </article>

            <article class="admin-detail-panel admin-detail-panel-wide">
                <h2>Ostacolo principale</h2>
                <p>{{ $audit->biggest_obstacle ?: $audit->notes ?: 'Nessun ostacolo indicato.' }}</p>
            </article>
        </section>
    </main>
@endsection
