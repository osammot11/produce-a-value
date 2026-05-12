@extends('layouts.app')

@section('title', $caseStudy->title . ' | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split split-hero">
                <div class="panel-dark panel-dark-large">
                    <p class="kicker kicker-large">{{ $caseStudy->service }} / {{ $caseStudy->client_name }}</p>
                    <h1 class="heading-hero">{{ $caseStudy->title }}</h1>
                    <p class="copy-light copy-hero">{{ $caseStudy->summary }}</p>
                    <div class="actions">
                        <a href="{{ route('audit') }}" class="button mobile-fullwidth">Richiedi audit</a>
                        <a href="{{ route('work') }}" class="button-secondary mobile-fullwidth">Torna alla lista</a>
                    </div>
                </div>

                <aside class="card card-stack card-feature card-orange">
                    <span class="label">{{ $caseStudy->industry ?: 'Case study' }}</span>
                    <strong class="card-title">{{ $caseStudy->metric_one_value ?: 'Proof' }}</strong>
                </aside>
            </div>
        </section>

        <section class="section">
            <div class="shell split">
                <div class="panel-dark">
                    <p class="kicker">Proof snapshot</p>
                    <h2 class="card-title card-title-large">{{ $caseStudy->visual_label ?: $caseStudy->service }}</h2>
                    <p class="copy-light copy-wide">{{ $caseStudy->visual_caption ?: $caseStudy->summary }}</p>
                </div>

                <div class="card-grid">
                    <article class="card card-stack card-process card-cream">
                        <span class="label">Cliente</span>
                        <strong class="card-title">{{ $caseStudy->client_name }}</strong>
                    </article>
                    <article class="card card-stack card-process card-yellow">
                        <span class="label">Contesto</span>
                        <strong class="card-title">{{ $caseStudy->industry ?: 'Non indicato' }}</strong>
                    </article>
                    <article class="card card-stack card-process card-violet span-all">
                        <span class="label">Segnale chiave</span>
                        <strong class="card-title">{{ $caseStudy->metric_one_value ?: 'Proof' }}</strong>
                    </article>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="shell card-grid card-grid-three">
                @php($metricColors = ['card-yellow', 'card-violet', 'card-orange'])

                @foreach ([
                    [$caseStudy->metric_one_label, $caseStudy->metric_one_value],
                    [$caseStudy->metric_two_label, $caseStudy->metric_two_value],
                    [$caseStudy->metric_three_label, $caseStudy->metric_three_value],
                ] as $index => [$label, $value])
                    @if ($label || $value)
                        <article class="card card-stack card-metric {{ $metricColors[$index] }}">
                            <span class="label">{{ $label }}</span>
                            <strong class="metric-value">{{ $value }}</strong>
                        </article>
                    @endif
                @endforeach
            </div>
        </section>

        <section class="section">
            <div class="shell card-grid">
                <article class="card card-stack card-service card-cream">
                    <span class="label">Before</span>
                    <h2 class="card-title card-title-large">Prima</h2>
                    <p class="card-copy">{{ $caseStudy->before_state ?: $caseStudy->challenge }}</p>
                </article>

                <article class="card card-stack card-service card-yellow">
                    <span class="label">After</span>
                    <h2 class="card-title card-title-large">Dopo</h2>
                    <p class="card-copy">{{ $caseStudy->after_state ?: $caseStudy->result }}</p>
                </article>
            </div>
        </section>

        @if (count($caseStudy->problemsSolvedList()))
            <section class="section">
                <div class="shell split">
                    <div class="panel-dark">
                        <p class="kicker">Problems solved</p>
                        <h2 class="card-title card-title-large">Non “abbiamo fatto design”. Abbiamo tolto attrito.</h2>
                    </div>

                    <div class="card-grid">
                        @foreach ($caseStudy->problemsSolvedList() as $problem)
                            <article class="card card-process card-cream">
                                <span class="label">Problema</span>
                                <p class="card-copy">{{ $problem }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="section">
            <div class="shell card-grid card-grid-four">
                <article class="card card-stack card-service card-cream">
                    <span class="label">01</span>
                    <h2 class="card-title card-title-large">La sfida</h2>
                    <p class="card-copy">{{ $caseStudy->challenge }}</p>
                </article>

                <article class="card card-stack card-service card-yellow">
                    <span class="label">02</span>
                    <h2 class="card-title card-title-large">Soluzione</h2>
                    <p class="card-copy">{{ $caseStudy->solution }}</p>
                </article>

                <article class="card card-stack card-service card-violet">
                    <span class="label">03</span>
                    <h2 class="card-title card-title-large">Risultati</h2>
                    <p class="card-copy">{{ $caseStudy->result }}</p>
                </article>

                <article class="card card-stack card-service card-orange">
                    <span class="label">Il prossimo passo</span>
                    <h2 class="card-title card-title-large">Vuoi trovare le perdite nel tuo funnel?</h2>
                    <p class="card-copy">Richiedi un audit e portaci numeri, traffico, problema e obiettivo dei prossimi 90 giorni.</p>
                    <a href="{{ route('audit') }}" class="link-button">Richiedi audit</a>
                </article>
            </div>
        </section>

        @if ($caseStudy->testimonial_quote)
            <section class="section">
                <div class="shell card card-stack card-feature card-violet">
                    <blockquote class="heading-section">
                        “{{ $caseStudy->testimonial_quote }}”
                    </blockquote>
                    <p class="label">
                        {{ $caseStudy->testimonial_author ?: $caseStudy->client_name }}
                        @if ($caseStudy->testimonial_role)
                            <span>{{ $caseStudy->testimonial_role }}</span>
                        @endif
                    </p>
                </div>
            </section>
        @endif
    </main>
@endsection
