@extends('layouts.admin')

@section('title', 'Preventivi | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-page-heading">
            <div>
                <p class="page-brutal-kicker">Preventivi</p>
                <h1>Proposte commerciali.</h1>
            </div>
            <a class="admin-action-link" href="{{ route('admin.quotes.create') }}">Nuovo preventivo</a>
        </section>

        @if (session('status'))
            <div class="admin-error-brutal">{{ session('status') }}</div>
        @endif

        <section class="admin-table-panel">
            @forelse ($quotes as $quote)
                <a class="admin-record-card" href="{{ route('admin.quotes.show', $quote) }}">
                    <span>{{ $quote->created_at->format('d/m/Y H:i') }} · {{ $quote->items_count }} servizi</span>
                    <strong>{{ $quote->title ?: 'Preventivo per '.$quote->client_name }}</strong>
                    <p>{{ $quote->client_company ?: $quote->client_name }} · {{ \App\Models\Quote::formatMoney($quote->total_cents) }} · IVA {{ $quote->isVatExempt() ? 'esente' : '22%' }}</p>
                    <em>{{ ucfirst($quote->status) }}</em>
                </a>
            @empty
                <p class="admin-empty-brutal">Nessun preventivo.</p>
            @endforelse
        </section>

        @include('admin.partials.pagination', ['paginator' => $quotes])
    </main>
@endsection
