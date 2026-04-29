@extends('layouts.admin')

@section('title', 'Case Study | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-page-heading">
            <div>
                <p class="page-brutal-kicker">Case study</p>
                <h1>Proof library.</h1>
            </div>
            <a class="admin-action-link" href="{{ route('admin.case-studies.create') }}">Nuovo case study</a>
        </section>

        @if (session('status'))
            <div class="admin-error-brutal">{{ session('status') }}</div>
        @endif

        <section class="admin-table-panel">
            @forelse ($caseStudies as $caseStudy)
                <a class="admin-record-card" href="{{ route('admin.case-studies.show', $caseStudy) }}">
                    <span>{{ $caseStudy->created_at->format('d/m/Y H:i') }}</span>
                    <strong>{{ $caseStudy->title }}</strong>
                    <p>{{ $caseStudy->client_name }} · {{ $caseStudy->service }} · {{ $caseStudy->industry ?: 'Industry non indicata' }}</p>
                    <em>{{ $caseStudy->status === 'published' ? 'Pubblicato' : 'Bozza' }}</em>
                </a>
            @empty
                <p class="admin-empty-brutal">Nessun case study.</p>
            @endforelse
        </section>

        @include('admin.partials.pagination', ['paginator' => $caseStudies])
    </main>
@endsection
