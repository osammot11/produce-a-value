@extends('layouts.admin')

@section('title', 'Lead Risorsa | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-page-heading">
            <p class="page-brutal-kicker">Risorsa</p>
            <h1>Lead magnet.</h1>
        </section>

        <section class="admin-table-panel">
            @forelse ($leads as $lead)
                <div class="admin-record-card">
                    <span>{{ $lead->created_at->format('d/m/Y H:i') }}</span>
                    <strong>{{ $lead->email }}</strong>
                    <p>{{ $lead->name ?: 'Nome non indicato' }}</p>
                    <em>{{ $lead->business_type ?: 'Tipo business non indicato' }}</em>
                </div>
            @empty
                <p class="admin-empty-brutal">Nessun lead risorsa.</p>
            @endforelse
        </section>

        @include('admin.partials.pagination', ['paginator' => $leads])
    </main>
@endsection
