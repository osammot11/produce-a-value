@php
    $channels = is_array($audit->channels) ? implode(', ', $audit->channels) : $audit->channels;
@endphp

<h1>Nuova richiesta audit</h1>

<p><strong>Nome:</strong> {{ $audit->name }}</p>
<p><strong>Email:</strong> {{ $audit->email }}</p>
<p><strong>Azienda:</strong> {{ $audit->company }}</p>
<p><strong>Sito:</strong> {{ $audit->website ?: '-' }}</p>
<p><strong>Ruolo:</strong> {{ $audit->role ?: '-' }}</p>

<hr>

<p><strong>Business:</strong> {{ $audit->business_type }}</p>
<p><strong>Mercato:</strong> {{ $audit->market ?: '-' }}</p>
<p><strong>Ticket medio:</strong> {{ $audit->average_order_value ?: '-' }}</p>
<p><strong>Canali:</strong> {{ $channels ?: '-' }}</p>
<p><strong>Budget ads mensile:</strong> {{ $audit->monthly_ad_budget ?: '-' }}</p>

<hr>

<p><strong>Problema principale:</strong> {{ $audit->main_problem }}</p>
<p><strong>Revenue mensile:</strong> {{ $audit->monthly_revenue ?: '-' }}</p>
<p><strong>Conversion rate:</strong> {{ $audit->conversion_rate ?: '-' }}</p>
<p><strong>Sales/lead mensili:</strong> {{ $audit->monthly_sales ?: '-' }}</p>
<p><strong>LTV:</strong> {{ $audit->ltv ?: '-' }}</p>

<hr>

<p><strong>Obiettivo 90 giorni:</strong></p>
<p>{{ $audit->goal_90_days }}</p>

<p><strong>Budget progetto:</strong> {{ $audit->project_budget }}</p>
<p><strong>Timing:</strong> {{ $audit->timeline }}</p>
<p><strong>Decision maker:</strong> {{ $audit->decision_maker }}</p>
<p><strong>Pronto ad agire:</strong> {{ $audit->ready_to_act ? 'Sì' : 'No' }}</p>

@if ($audit->notes)
    <p><strong>Note:</strong></p>
    <p>{{ $audit->notes }}</p>
@endif
