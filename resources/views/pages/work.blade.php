@extends('layouts.app')

@section('title', 'Work | Produce a Value')

@section('content')
    <main class="page-brutal">
        <section class="page-hero-brutal">
            <div class="page-hero-brutal-main">
                <p class="page-brutal-kicker">Work</p>
                <h1 class="page-brutal-title">Proof, not portfolio decoration.</h1>
                <p class="page-brutal-text">
                    Qui non mostriamo “cose belle”. Mostriamo problemi risolti, before/after, metriche,
                    scelte fatte e segnali che un funnel può lavorare meglio.
                </p>
                <div class="hero-brutal-actions">
                    <a href="{{ route('audit') }}" class="brutal-button hero-brutal-cta-primary">Richiedi audit</a>
                    <a href="{{ route('risorsa') }}" class="hero-brutal-cta-secondary">Scarica risorsa</a>
                </div>
            </div>

            <aside class="page-hero-brutal-side page-hero-brutal-side-orange">
                <span>02</span>
                <strong>Show the solved problem.</strong>
            </aside>
        </section>

        <section class="work-proof-strip">
            <article>
                <span>Case studies</span>
                <strong>{{ $caseStudies->count() }}</strong>
            </article>
            <article>
                <span>Proof assets</span>
                <strong>{{ $caseStudies->filter(fn ($caseStudy) => $caseStudy->testimonial_quote)->count() }}</strong>
            </article>
            <article>
                <span>Problems mapped</span>
                <strong>{{ $caseStudies->sum(fn ($caseStudy) => count($caseStudy->problemsSolvedList())) }}</strong>
            </article>
        </section>

        <section class="work-brutal-grid">
            @forelse ($caseStudies as $caseStudy)
                <a class="work-proof-card" href="{{ route('case-studies.show', $caseStudy->slug) }}">
                    <div class="case-visual-mockup">
                        @if ($caseStudy->visual_image)
                            <img src="{{ $caseStudy->visual_image }}" alt="{{ $caseStudy->title }}">
                        @else
                            <div class="case-visual-top">
                                <span>{{ $caseStudy->visual_label ?: $caseStudy->service }}</span>
                                <strong>{{ $caseStudy->metric_one_value ?: 'Proof' }}</strong>
                            </div>
                            <div class="case-visual-bars">
                                <i></i>
                                <i></i>
                                <i></i>
                            </div>
                            <div class="case-visual-cards">
                                <b>{{ $caseStudy->metric_two_value ?: '01' }}</b>
                                <b>{{ $caseStudy->metric_three_value ?: '02' }}</b>
                            </div>
                        @endif
                    </div>

                    <div class="work-proof-content">
                        <span class="work-brutal-tag">{{ $caseStudy->service }} / {{ $caseStudy->client_name }}</span>
                        <h2>{{ $caseStudy->title }}</h2>
                        <p>{{ $caseStudy->summary }}</p>

                        <div class="work-proof-metrics">
                            @foreach ([
                                [$caseStudy->metric_one_label, $caseStudy->metric_one_value],
                                [$caseStudy->metric_two_label, $caseStudy->metric_two_value],
                                [$caseStudy->metric_three_label, $caseStudy->metric_three_value],
                            ] as [$label, $value])
                                @if ($label || $value)
                                    <div>
                                        <strong>{{ $value }}</strong>
                                        <span>{{ $label }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </a>
            @empty
                <article class="work-brutal-card">
                    <span class="work-brutal-tag">Proof</span>
                    <h2>Case study in arrivo.</h2>
                    <p>Qui compariranno risultati, before/after e proof reali appena saranno pubblicati.</p>
                    <strong>Soon</strong>
                </article>
            @endforelse
        </section>
    </main>
@endsection
