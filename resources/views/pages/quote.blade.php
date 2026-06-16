@extends('layouts.app')

@section('title', ($quote->title ?: 'Preventivo') . ' | Produce a Value')

@section('content')
    @if (! $hasAccess)
        <main class="section section-hero">
            <div class="shell split split-hero">
                <section class="panel-dark panel-dark-large">
                    <p class="kicker">Preventivo riservato</p>
                    <h1 class="heading-hero">Accesso con codice.</h1>
                    <p class="copy-hero">Inserisci il codice ricevuto per consultare la proposta commerciale.</p>
                </section>

                <section class="form-panel quote-login">
                    @if ($errors->any())
                        <div class="form-error">
                            <strong>Codice non valido</strong>
                            <p>Controlla il codice e riprova.</p>
                        </div>
                    @endif

                    <form class="form-stack" action="{{ route('quotes.access', $quote) }}" method="post">
                        @csrf
                        <label>Codice accesso
                            <input type="password" name="access_code" inputmode="numeric" autocomplete="one-time-code" required autofocus>
                        </label>
                        <button class="button button-submit" type="submit">Apri preventivo</button>
                    </form>
                </section>
            </div>
        </main>
    @else
        <main class="section quote-page">
            <div class="shell quote-shell">
                <section class="panel-dark panel-dark-large quote-hero">
                    <div>
                        <p class="kicker">Preventivo riservato</p>
                        <h1 class="heading-section">{{ $quote->title ?: 'Proposta per '.$quote->client_name }}</h1>
                        <p class="copy-light">{{ $quote->client_company ?: $quote->client_name }} · {{ $quote->valid_until ? 'Valido fino al '.$quote->valid_until->format('d/m/Y') : 'Validità da confermare' }}</p>
                    </div>

                    <div class="quote-actions">
                        <a class="button" href="{{ route('quotes.pdf', $quote) }}">Scarica PDF</a>
                        <form action="{{ route('quotes.logout', $quote) }}" method="post">
                            @csrf
                            <button class="button button-secondary" type="submit">Esci</button>
                        </form>
                    </div>
                </section>

                <section class="quote-grid">
                    <article class="card card-cream content-panel">
                        <span class="label">Da</span>
                        <h2>{{ $quote->company_name }}</h2>
                        <p>{{ $quote->company_address ?: 'Indirizzo non indicato' }}</p>
                        <p>{{ $quote->company_vat ? 'P.IVA '.$quote->company_vat : 'P.IVA non indicata' }}</p>
                        <p>{{ $quote->company_email ?: 'Email non indicata' }}</p>
                        <p>{{ $quote->company_phone ?: '' }}</p>
                    </article>

                    <article class="card card-cream content-panel">
                        <span class="label">Per</span>
                        <h2>{{ $quote->client_company ?: $quote->client_name }}</h2>
                        <p>{{ $quote->client_name }}</p>
                        <p>{{ $quote->client_address ?: 'Indirizzo non indicato' }}</p>
                        <p>{{ $quote->client_vat ? 'P.IVA / CF '.$quote->client_vat : 'P.IVA / CF non indicata' }}</p>
                        <p>{{ $quote->client_email ?: 'Email non indicata' }}</p>
                    </article>
                </section>

                <section class="card card-cream content-panel quote-box">
                    <span class="label">Servizi</span>
                    <div class="quote-table">
                        @foreach ($quote->items as $item)
                            <div class="quote-row">
                                <div>
                                    <strong>{{ $item->title }}</strong>
                                    @if ($item->description)
                                        <p>{{ $item->description }}</p>
                                    @endif
                                </div>
                                <b>{{ $item->formattedPrice() }}</b>
                            </div>
                        @endforeach
                    </div>

                    <div class="quote-total">
                        <span>Subtotale</span>
                        <strong>{{ \App\Models\Quote::formatMoney($quote->subtotal_cents) }}</strong>
                        <span>IVA</span>
                        <strong>{{ $quote->isVatExempt() ? 'Esente' : \App\Models\Quote::formatMoney($quote->vat_cents) }}</strong>
                        <span>Totale</span>
                        <strong>{{ \App\Models\Quote::formatMoney($quote->total_cents) }}</strong>
                    </div>
                </section>

                @if ($quote->business_plan)
                    <section class="card card-yellow content-panel quote-box">
                        <span class="label">Business plan</span>
                        <div class="quote-richtext">{!! $quote->business_plan !!}</div>
                    </section>
                @endif
            </div>
        </main>

    @endif
@endsection
