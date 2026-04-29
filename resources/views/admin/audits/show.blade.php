@extends('layouts.admin')

@section('title', $audit->company . ' | Audit Admin')

@section('content')
    <main class="admin-brutal">
        <section class="admin-detail-hero">
            <div>
                <p class="page-brutal-kicker">Audit #{{ $audit->id }}</p>
                <h1>{{ $audit->company }}</h1>
                <p>
                    {{ $audit->name }} · <a href="mailto:{{ $audit->email }}">{{ $audit->email }}</a>
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

            <article class="admin-detail-panel">
                <h2>Business basics</h2>
                <dl>
                    <dt>Sito</dt><dd>{{ $audit->website ?: 'Non indicato' }}</dd>
                    <dt>Ruolo</dt><dd>{{ $audit->role ?: 'Non indicato' }}</dd>
                    <dt>Tipo business</dt><dd>{{ $audit->business_type }}</dd>
                    <dt>Mercato</dt><dd>{{ $audit->market ?: 'Non indicato' }}</dd>
                    <dt>Ticket medio</dt><dd>{{ $audit->average_order_value ?: 'Non indicato' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel">
                <h2>Traffico e problema</h2>
                <dl>
                    <dt>Canali</dt><dd>{{ $audit->channels ? implode(', ', $audit->channels) : 'Non indicati' }}</dd>
                    <dt>Budget ads</dt><dd>{{ $audit->monthly_ad_budget ?: 'Non indicato' }}</dd>
                    <dt>Problema</dt><dd>{{ $audit->main_problem }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel">
                <h2>Numeri</h2>
                <dl>
                    <dt>Revenue mensile</dt><dd>{{ $audit->monthly_revenue ?: 'Non indicato' }}</dd>
                    <dt>Conversion rate</dt><dd>{{ $audit->conversion_rate ?: 'Non indicato' }}</dd>
                    <dt>Lead/vendite</dt><dd>{{ $audit->monthly_sales ?: 'Non indicato' }}</dd>
                    <dt>LTV</dt><dd>{{ $audit->ltv ?: 'Non indicato' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel">
                <h2>Fit</h2>
                <dl>
                    <dt>Budget progetto</dt><dd>{{ $audit->project_budget }}</dd>
                    <dt>Timing</dt><dd>{{ $audit->timeline }}</dd>
                    <dt>Decision maker</dt><dd>{{ $audit->decision_maker }}</dd>
                    <dt>Pronto ad agire</dt><dd>{{ $audit->ready_to_act ? 'Sì' : 'Non ancora' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel admin-detail-panel-wide">
                <h2>Obiettivo 90 giorni</h2>
                <p>{{ $audit->goal_90_days }}</p>
            </article>

            <article class="admin-detail-panel admin-detail-panel-wide">
                <h2>Note</h2>
                <p>{{ $audit->notes ?: 'Nessuna nota extra.' }}</p>
            </article>
        </section>
    </main>
@endsection
