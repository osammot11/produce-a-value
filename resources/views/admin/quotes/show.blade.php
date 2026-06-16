@extends('layouts.admin')

@section('title', ($quote->title ?: 'Preventivo') . ' | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-detail-hero">
            <div>
                <p class="page-brutal-kicker">Preventivo #{{ $quote->id }}</p>
                <h1>{{ $quote->title ?: 'Preventivo per '.$quote->client_name }}</h1>
                <p>{{ $quote->client_company ?: $quote->client_name }} · {{ \App\Models\Quote::formatMoney($quote->total_cents) }} · {{ ucfirst($quote->status) }}</p>
            </div>
            <div class="admin-inline-actions">
                <a class="admin-danger-button" href="{{ route('quotes.show', $quote) }}" target="_blank" rel="noopener">Apri pubblico</a>
                <a class="admin-action-link" href="{{ route('admin.quotes.edit', $quote) }}">Modifica</a>
                <form action="{{ route('admin.quotes.destroy', $quote) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="admin-danger-button" type="submit">Elimina</button>
                </form>
            </div>
        </section>

        @if (session('status'))
            <div class="admin-error-brutal">{{ session('status') }}</div>
        @endif

        <section class="admin-detail-grid">
            <article class="admin-detail-panel">
                <h2>Link cliente</h2>
                <dl>
                    <dt>URL</dt><dd><a href="{{ route('quotes.show', $quote) }}" target="_blank" rel="noopener">{{ route('quotes.show', $quote) }}</a></dd>
                    <dt>Codice</dt><dd>{{ config('quotes.access_code') }}</dd>
                    <dt>Scadenza</dt><dd>{{ $quote->valid_until?->format('d/m/Y') ?: 'Non indicata' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel">
                <h2>Cliente</h2>
                <dl>
                    <dt>Nome</dt><dd>{{ $quote->client_name }}</dd>
                    <dt>Azienda</dt><dd>{{ $quote->client_company ?: 'Non indicata' }}</dd>
                    <dt>Email</dt><dd>{{ $quote->client_email ?: 'Non indicata' }}</dd>
                    <dt>Telefono</dt><dd>{{ $quote->client_phone ?: 'Non indicato' }}</dd>
                    <dt>P.IVA</dt><dd>{{ $quote->client_vat ?: 'Non indicata' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel admin-detail-panel-wide">
                <h2>Servizi</h2>
                <div class="admin-money-summary">
                    @foreach ($quote->items as $item)
                        <div>
                            <strong>{{ $item->title }}</strong>
                            <span>{{ $item->description ?: 'Nessuna descrizione' }}</span>
                            <b>{{ $item->formattedPrice() }}</b>
                        </div>
                    @endforeach
                </div>
                <dl>
                    <dt>Subtotale</dt><dd>{{ \App\Models\Quote::formatMoney($quote->subtotal_cents) }}</dd>
                    <dt>IVA</dt><dd>{{ $quote->isVatExempt() ? 'Esente' : \App\Models\Quote::formatMoney($quote->vat_cents) }}</dd>
                    <dt>Totale</dt><dd><strong>{{ \App\Models\Quote::formatMoney($quote->total_cents) }}</strong></dd>
                </dl>
            </article>

            @if ($quote->business_plan)
                <article class="admin-detail-panel admin-detail-panel-wide">
                    <h2>Business plan</h2>
                    <div class="admin-richtext-preview">{!! $quote->business_plan !!}</div>
                </article>
            @endif
        </section>
    </main>
@endsection
