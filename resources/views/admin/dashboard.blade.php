@extends('layouts.admin')

@section('title', 'Dashboard Admin | Produce a Value')

@section('content')
    <main class="admin-brutal">
        <section class="admin-page-heading">
            <p class="page-brutal-kicker">Dashboard</p>
            <h1>Lead, audit e segnali commerciali.</h1>
        </section>

        <section class="admin-stat-grid">
            <a href="{{ route('admin.case-studies.index') }}" class="admin-stat-card admin-stat-card-yellow">
                <span>Case study</span>
                <strong>{{ $caseStudyCount }}</strong>
            </a>
            <a href="{{ route('admin.quotes.index') }}" class="admin-stat-card admin-stat-card-violet">
                <span>Preventivi</span>
                <strong>{{ $quoteCount }}</strong>
            </a>
            <a href="{{ route('admin.audits.index') }}" class="admin-stat-card admin-stat-card-yellow">
                <span>Audit richiesti</span>
                <strong>{{ $auditCount }}</strong>
            </a>
            <a href="{{ route('admin.resource-leads.index') }}" class="admin-stat-card admin-stat-card-violet">
                <span>Lead risorsa</span>
                <strong>{{ $resourceLeadCount }}</strong>
            </a>
        </section>

        <section class="admin-dashboard-grid">
            <article class="admin-list-panel">
                <div class="admin-panel-top">
                    <h2>Ultimi preventivi</h2>
                    <a href="{{ route('admin.quotes.index') }}">Vedi tutti</a>
                </div>
                @forelse ($latestQuotes as $quote)
                    <a class="admin-row-link" href="{{ route('admin.quotes.show', $quote) }}">
                        <strong>{{ $quote->title ?: 'Preventivo per '.$quote->client_name }}</strong>
                        <span>{{ $quote->client_company ?: $quote->client_name }} · {{ \App\Models\Quote::formatMoney($quote->total_cents) }} · {{ $quote->status }}</span>
                    </a>
                @empty
                    <p class="admin-empty-brutal">Nessun preventivo ancora.</p>
                @endforelse
            </article>

            <article class="admin-list-panel">
                <div class="admin-panel-top">
                    <h2>Ultimi case study</h2>
                    <a href="{{ route('admin.case-studies.index') }}">Vedi tutti</a>
                </div>
                @forelse ($latestCaseStudies as $caseStudy)
                    <a class="admin-row-link" href="{{ route('admin.case-studies.show', $caseStudy) }}">
                        <strong>{{ $caseStudy->title }}</strong>
                        <span>{{ $caseStudy->client_name }} · {{ $caseStudy->service }} · {{ $caseStudy->status }}</span>
                    </a>
                @empty
                    <p class="admin-empty-brutal">Nessun case study ancora.</p>
                @endforelse
            </article>

            <article class="admin-list-panel">
                <div class="admin-panel-top">
                    <h2>Ultimi audit</h2>
                    <a href="{{ route('admin.audits.index') }}">Vedi tutti</a>
                </div>
                @forelse ($latestAudits as $audit)
                    <a class="admin-row-link" href="{{ route('admin.audits.show', $audit) }}">
                        <strong>{{ $audit->company }}</strong>
                        <span>{{ $audit->email }} · {{ $audit->main_problem }}</span>
                    </a>
                @empty
                    <p class="admin-empty-brutal">Nessun audit ancora.</p>
                @endforelse
            </article>

            <article class="admin-list-panel">
                <div class="admin-panel-top">
                    <h2>Ultime risorse</h2>
                    <a href="{{ route('admin.resource-leads.index') }}">Vedi tutti</a>
                </div>
                @forelse ($latestLeads as $lead)
                    <div class="admin-row-link">
                        <strong>{{ $lead->email }}</strong>
                        <span>{{ $lead->name ?: 'Nome non indicato' }} · {{ $lead->business_type ?: 'Tipo non indicato' }}</span>
                    </div>
                @empty
                    <p class="admin-empty-brutal">Nessun lead risorsa ancora.</p>
                @endforelse
            </article>

            <article class="admin-list-panel">
                <div class="admin-panel-top">
                    <h2>Ultimi contatti</h2>
                    <a href="{{ route('admin.contacts.index') }}">Vedi tutti</a>
                </div>
                @forelse ($latestContacts as $contact)
                    <div class="admin-row-link">
                        <strong>{{ $contact->name }}</strong>
                        <span>{{ $contact->email }} · {{ $contact->budget ?: 'Budget non indicato' }}</span>
                    </div>
                @empty
                    <p class="admin-empty-brutal">Nessun contatto ancora.</p>
                @endforelse
            </article>
        </section>
    </main>
@endsection
