@extends('layouts.admin')

@section('title', $caseStudy->title . ' | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-detail-hero">
            <div>
                <p class="page-brutal-kicker">Case study #{{ $caseStudy->id }}</p>
                <h1>{{ $caseStudy->title }}</h1>
                <p>{{ $caseStudy->client_name }} · {{ $caseStudy->service }} · {{ $caseStudy->status }}</p>
            </div>
            <div class="admin-inline-actions">
                @if ($caseStudy->status === 'published')
                    <a class="admin-danger-button" href="{{ route('case-studies.show', $caseStudy->slug) }}">Apri pubblico</a>
                @endif
                <a class="admin-action-link" href="{{ route('admin.case-studies.edit', $caseStudy) }}">Modifica</a>
                <form action="{{ route('admin.case-studies.destroy', $caseStudy) }}" method="post">
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
                <h2>Meta</h2>
                <dl>
                    <dt>Slug</dt><dd>{{ $caseStudy->slug }}</dd>
                    <dt>Industry</dt><dd>{{ $caseStudy->industry ?: 'Non indicata' }}</dd>
                    <dt>Pubblicato</dt><dd>{{ $caseStudy->published_at?->format('d/m/Y H:i') ?: 'No' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel">
                <h2>Metriche</h2>
                <dl>
                    <dt>{{ $caseStudy->metric_one_label ?: 'Metric 1' }}</dt><dd>{{ $caseStudy->metric_one_value ?: 'Non indicata' }}</dd>
                    <dt>{{ $caseStudy->metric_two_label ?: 'Metric 2' }}</dt><dd>{{ $caseStudy->metric_two_value ?: 'Non indicata' }}</dd>
                    <dt>{{ $caseStudy->metric_three_label ?: 'Metric 3' }}</dt><dd>{{ $caseStudy->metric_three_value ?: 'Non indicata' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel admin-detail-panel-wide">
                <h2>Summary</h2>
                <p>{{ $caseStudy->summary }}</p>
            </article>

            <article class="admin-detail-panel admin-detail-panel-wide">
                <h2>Proof assets</h2>
                <dl>
                    <dt>Visual</dt><dd>{{ $caseStudy->visual_label ?: 'Non indicato' }}</dd>
                    <dt>Caption</dt><dd>{{ $caseStudy->visual_caption ?: 'Non indicata' }}</dd>
                    <dt>Image</dt><dd>{{ $caseStudy->visual_image ?: 'Mockup CSS automatico' }}</dd>
                    <dt>Testimonial</dt><dd>{{ $caseStudy->testimonial_quote ?: 'Non indicata' }}</dd>
                    <dt>Autore</dt><dd>{{ $caseStudy->testimonial_author ?: 'Non indicato' }}</dd>
                </dl>
            </article>

            <article class="admin-detail-panel">
                <h2>Challenge</h2>
                <p>{{ $caseStudy->challenge }}</p>
            </article>

            <article class="admin-detail-panel">
                <h2>Solution</h2>
                <p>{{ $caseStudy->solution }}</p>
            </article>

            <article class="admin-detail-panel admin-detail-panel-wide">
                <h2>Result</h2>
                <p>{{ $caseStudy->result }}</p>
            </article>
        </section>
    </main>
@endsection
