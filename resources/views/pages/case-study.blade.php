@extends('layouts.app')

@section('title', $caseStudy->title . ' | Produce a Value')

@section('content')
    <main class="page-brutal">
        <section class="page-hero-brutal">
            <div class="page-hero-brutal-main">
                <p class="page-brutal-kicker">{{ $caseStudy->service }} / {{ $caseStudy->client_name }}</p>
                <h1 class="page-brutal-title">{{ $caseStudy->title }}</h1>
                <p class="page-brutal-text">{{ $caseStudy->summary }}</p>
                <div class="hero-brutal-actions">
                    <a href="{{ route('audit') }}" class="brutal-button hero-brutal-cta-primary">Richiedi audit</a>
                    <a href="{{ route('work') }}" class="hero-brutal-cta-secondary">Torna alla lista</a>
                </div>
            </div>

            <aside class="page-hero-brutal-side page-hero-brutal-side-orange">
                <span>{{ $caseStudy->industry ?: 'Case study' }}</span>
                <strong>{{ $caseStudy->metric_one_value ?: 'Proof' }}</strong>
            </aside>
        </section>

        <section class="case-proof-snapshot">
            <div class="case-proof-snapshot-main">
                <p class="page-brutal-kicker">Proof snapshot</p>
                <h2>{{ $caseStudy->visual_label ?: $caseStudy->service }}</h2>
                <p>{{ $caseStudy->visual_caption ?: $caseStudy->summary }}</p>
            </div>

            <div class="case-proof-snapshot-meta">
                <div>
                    <span>Cliente</span>
                    <strong>{{ $caseStudy->client_name }}</strong>
                </div>
                <div>
                    <span>Contesto</span>
                    <strong>{{ $caseStudy->industry ?: 'Non indicato' }}</strong>
                </div>
                <div>
                    <span>Segnale chiave</span>
                    <strong>{{ $caseStudy->metric_one_value ?: 'Proof' }}</strong>
                </div>
            </div>
        </section>

        <section class="case-study-metrics-brutal">
            @foreach ([
                [$caseStudy->metric_one_label, $caseStudy->metric_one_value],
                [$caseStudy->metric_two_label, $caseStudy->metric_two_value],
                [$caseStudy->metric_three_label, $caseStudy->metric_three_value],
            ] as [$label, $value])
                @if ($label || $value)
                    <article>
                        <span>{{ $label }}</span>
                        <strong>{{ $value }}</strong>
                    </article>
                @endif
            @endforeach
        </section>

        <section class="case-before-after-brutal">
            <article>
                <h2>Before</h2>
                <p>{{ $caseStudy->before_state ?: $caseStudy->challenge }}</p>
            </article>

            <article>
                <h2>After</h2>
                <p>{{ $caseStudy->after_state ?: $caseStudy->result }}</p>
            </article>
        </section>

        @if (count($caseStudy->problemsSolvedList()))
            <section class="case-problems-brutal">
                <div>
                    <p class="page-brutal-kicker">Problems solved</p>
                    <h2>Non “abbiamo fatto design”. Abbiamo tolto attrito.</h2>
                </div>

                <ul>
                    @foreach ($caseStudy->problemsSolvedList() as $problem)
                        <li>{{ $problem }}</li>
                    @endforeach
                </ul>
            </section>
        @endif

        <section class="manifesto-brutal-list">
            <article>
                <span>01</span>
                <h2>La sfida</h2>
                <p>{{ $caseStudy->challenge }}</p>
            </article>

            <article>
                <span>02</span>
                <h2>Soluzione</h2>
                <p>{{ $caseStudy->solution }}</p>
            </article>

            <article>
                <span>03</span>
                <h2>Risultati</h2>
                <p>{{ $caseStudy->result }}</p>
            </article>

            <article>
                <span>Il prossimo passo</span>
                <h2>Vuoi trovare le perdite nel tuo funnel?</h2>
                <p>Richiedi un audit e portaci numeri, traffico, problema e obiettivo dei prossimi 90 giorni.</p>
                <a href="{{ route('audit') }}" class="service-brutal-link">Richiedi audit</a>
            </article>
        </section>

        @if ($caseStudy->testimonial_quote)
            <section class="case-testimonial-brutal">
                <blockquote>
                    “{{ $caseStudy->testimonial_quote }}”
                </blockquote>
                <p>
                    {{ $caseStudy->testimonial_author ?: $caseStudy->client_name }}
                    @if ($caseStudy->testimonial_role)
                        <span>{{ $caseStudy->testimonial_role }}</span>
                    @endif
                </p>
            </section>
        @endif
    </main>
@endsection
