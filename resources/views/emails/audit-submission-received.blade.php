@php
    $channels = is_array($audit->channels) ? implode(', ', $audit->channels) : $audit->channels;
    $brand = $audit->brand_name ?: $audit->company;
    $site = $audit->ecommerce_url ?: $audit->website;
@endphp

<h1>Nuovo RADAR strategico</h1>

<p><strong>Brand:</strong> {{ $brand }}</p>
<p><strong>Ecommerce:</strong> {{ $site ?: '-' }}</p>
<p><strong>Da quanto online:</strong> {{ $audit->online_since ?: '-' }}</p>
<p><strong>Nome:</strong> {{ $audit->name }}</p>
<p><strong>Email:</strong> {{ $audit->email }}</p>
<p><strong>Telefono:</strong> {{ $audit->phone ?: '-' }}</p>

<hr>

<h2>Diagnosi RADAR</h2>

<p><strong>Score:</strong> {{ is_null($audit->radar_score) ? '-' : $audit->radar_score.'/100' }}</p>
<p><strong>Profilo:</strong> {{ $audit->radar_profile ?: '-' }}</p>
<p><strong>Priorità:</strong> {{ $audit->radar_priority ?: '-' }}</p>

@if ($audit->radar_summary)
    <p>{{ $audit->radar_summary }}</p>
@endif

@if ($audit->radar_recommendations)
    <ul>
        @foreach ($audit->radar_recommendations as $recommendation)
            <li>{{ $recommendation }}</li>
        @endforeach
    </ul>
@endif

<hr>

<p><strong>Cosa vende e a chi:</strong></p>
<p>{{ $audit->product_audience ?: '-' }}</p>

<p><strong>Fatturato mensile medio:</strong> {{ $audit->monthly_revenue_range ?: $audit->monthly_revenue ?: '-' }}</p>
<p><strong>Spesa mensile ads:</strong> {{ $audit->monthly_ads_spend_range ?: $audit->monthly_ad_budget ?: '-' }}</p>
<p><strong>Scontrino medio:</strong> {{ $audit->aov_range ?: $audit->average_order_value ?: '-' }}</p>
<p><strong>Redditività ads:</strong> {{ $audit->ads_profitability ?: '-' }}</p>
<p><strong>Ordini al mese:</strong> {{ $audit->monthly_orders_range ?: $audit->monthly_sales ?: '-' }}</p>
<p><strong>Fidelizzazione:</strong> {{ $audit->repeat_purchase_rate ?: '-' }}</p>
<p><strong>Canali attivi:</strong> {{ $channels ?: '-' }}</p>

<hr>

<p><strong>Strategia attuale:</strong> {{ $audit->current_strategy ?: '-' }}</p>
<p><strong>Collo di bottiglia:</strong> {{ $audit->bottleneck ?: $audit->main_problem ?: '-' }}</p>

<p><strong>Obiettivo 90 giorni:</strong></p>
<p>{{ $audit->goal_90_days }}</p>

<p><strong>Ostacolo principale:</strong></p>
<p>{{ $audit->biggest_obstacle ?: $audit->notes ?: '-' }}</p>
