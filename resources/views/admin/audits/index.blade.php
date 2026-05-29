@extends('layouts.admin')

@section('title', 'Audit | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-page-heading">
            <div>
                <p class="page-brutal-kicker">Audit</p>
                <h1>Richieste audit.</h1>
            </div>
            <a class="admin-action-link" href="{{ route('admin.audits.export', request()->query()) }}">Export CSV</a>
        </section>

        <section class="admin-filter-panel">
            <form action="{{ route('admin.audits.index') }}" method="get">
                <label>Stato
                    <select name="status">
                        <option value="">Tutti</option>
                        @foreach ($statusOptions as $value => $label)
                            <option value="{{ $value }}" @selected($filters['status'] === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </label>

                <label>Problema
                    <select name="problem">
                        <option value="">Tutti</option>
                        @foreach ($problemOptions as $problem)
                            <option value="{{ $problem }}" @selected($filters['problem'] === $problem)>{{ $problem }}</option>
                        @endforeach
                    </select>
                </label>

                <label>Budget
                    <select name="budget">
                        <option value="">Tutti</option>
                        @foreach ($budgetOptions as $budget)
                            <option value="{{ $budget }}" @selected($filters['budget'] === $budget)>{{ $budget }}</option>
                        @endforeach
                    </select>
                </label>

                <label>Timing
                    <select name="timing">
                        <option value="">Tutti</option>
                        @foreach ($timingOptions as $timing)
                            <option value="{{ $timing }}" @selected($filters['timing'] === $timing)>{{ $timing }}</option>
                        @endforeach
                    </select>
                </label>

                <div class="admin-filter-actions">
                    <button class="brutal-button" type="submit">Filtra</button>
                    <a class="admin-danger-button" href="{{ route('admin.audits.index') }}">Reset</a>
                </div>
            </form>
        </section>

        <section class="admin-table-panel">
            @forelse ($audits as $audit)
                <a class="admin-record-card" href="{{ route('admin.audits.show', $audit) }}">
                    <span>{{ $audit->created_at->format('d/m/Y H:i') }} · {{ $statusOptions[$audit->crm_status] ?? $audit->crm_status }}</span>
                    <strong>{{ $audit->brand_name ?: $audit->company }}</strong>
                    <p>{{ $audit->name }} · {{ $audit->email }}{{ $audit->phone ? ' · '.$audit->phone : '' }}</p>
                    <em>
                        {{ $audit->monthly_revenue_range ?: $audit->monthly_revenue ?: 'Revenue non indicata' }}
                        · {{ $audit->bottleneck ?: $audit->main_problem }}
                        · {{ $audit->monthly_ads_spend_range ?: $audit->monthly_ad_budget ?: $audit->project_budget }}
                    </em>
                    @if ($audit->internal_notes)
                        <small class="admin-note-flag">Note interne presenti</small>
                    @endif
                </a>
            @empty
                <p class="admin-empty-brutal">Nessun audit richiesto.</p>
            @endforelse
        </section>

        @include('admin.partials.pagination', ['paginator' => $audits])
    </main>
@endsection
