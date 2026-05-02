@extends('layouts.admin')

@section('title', 'Contatti | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-page-heading">
            <p class="page-brutal-kicker">Contatti</p>
            <h1>Richieste generiche.</h1>
        </section>

        <section class="admin-table-panel">
            @forelse ($contacts as $contact)
                <article class="admin-record-card">
                    <span>{{ $contact->created_at->format('d/m/Y H:i') }}</span>
                    <strong>{{ $contact->name }}</strong>
                    <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a> · {{ $contact->budget ?: 'Budget non indicato' }}</p>
                    <em>{{ $contact->message }}</em>
                    <span class="admin-note-flag">{{ $contact->ip_address ?: 'IP non disponibile' }}</span>
                    @if ($contact->user_agent)
                        <small class="admin-tech-meta">{{ \Illuminate\Support\Str::limit($contact->user_agent, 180) }}</small>
                    @endif
                </article>
            @empty
                <p class="admin-empty-brutal">Nessun contatto.</p>
            @endforelse
        </section>

        @include('admin.partials.pagination', ['paginator' => $contacts])
    </main>
@endsection
