@extends('layouts.app')

@section('title', 'Work | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split split-hero">
                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">Work</p>
                    <h1 class="heading-hero">Proof, not portfolio decoration.</h1>
                    <p class="copy-light copy-hero">
                        Qui non mostriamo “cose belle”. Mostriamo problemi risolti, before/after, metriche,
                        scelte fatte e segnali che un funnel può lavorare meglio.
                    </p>
                    <div class="actions">
                        <a href="{{ route('audit') }}" class="button mobile-fullwidth">Richiedi audit</a>
                        <a href="{{ route('risorsa') }}" class="button-secondary mobile-fullwidth">Scarica risorsa</a>
                    </div>
                </div>

                <aside class="card card-stack card-feature card-orange">
                    <span class="label">02</span>
                    <strong class="card-title">Show the solved problem.</strong>
                </aside>
            </div>
        </section>

        <section class="section">
            <div class="shell card-grid card-grid-three">
                <article class="card card-stack card-metric card-cream">
                    <span class="label">Case studies</span>
                    <strong class="metric-value">{{ $caseStudies->count() }}</strong>
                </article>
                <article class="card card-stack card-metric card-yellow">
                    <span class="label">Proof assets</span>
                    <strong class="metric-value">{{ $caseStudies->filter(fn ($caseStudy) => $caseStudy->testimonial_quote)->count() }}</strong>
                </article>
                <article class="card card-stack card-metric card-violet">
                    <span class="label">Problems mapped</span>
                    <strong class="metric-value">{{ $caseStudies->sum(fn ($caseStudy) => count($caseStudy->problemsSolvedList())) }}</strong>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="shell proof-grid">
                @forelse ($caseStudies as $caseStudy)
                    <a class="proof-card" href="{{ route('case-studies.show', $caseStudy->slug) }}">
                        <div class="proof-visual">
                            @if ($caseStudy->visual_image)
                                <img src="{{ $caseStudy->visual_image }}" alt="{{ $caseStudy->title }}">
                            @else
                                <div class="proof-visual-top">
                                    <span>{{ $caseStudy->visual_label ?: $caseStudy->service }}</span>
                                    <strong>{{ $caseStudy->metric_one_value ?: 'Proof' }}</strong>
                                </div>
                                <div class="proof-visual-bars">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </div>
                                <div class="proof-visual-cards">
                                    <b>{{ $caseStudy->metric_two_value ?: '01' }}</b>
                                    <b>{{ $caseStudy->metric_three_value ?: '02' }}</b>
                                </div>
                            @endif
                        </div>

                        <div class="proof-content">
                            <span class="label">{{ $caseStudy->service }} / {{ $caseStudy->client_name }}</span>
                            <h2>{{ $caseStudy->title }}</h2>
                            <p>{{ $caseStudy->summary }}</p>

                            <div class="proof-metrics">
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
                    <article class="card card-stack card-service card-yellow span-all">
                        <span class="label">Proof</span>
                        <h2 class="card-title card-title-large">Case study in arrivo.</h2>
                        <p class="card-copy">Qui compariranno risultati, before/after e proof reali appena saranno pubblicati.</p>
                        <strong class="metric-value">Soon</strong>
                    </article>
                @endforelse
            </div>
        </section>
    </main>
@endsection
