@extends('layouts.app')

@section('title', 'Contatti | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split">
                <div class="panel-dark sticky-panel">
                    <p class="kicker kicker-large">Contatti</p>
                    <h1 class="heading-section">Hai un progetto che deve spingere di più?</h1>
                    <p class="copy-light copy-wide">
                        Questa pagina resta per richieste generiche. Se vuoi una diagnosi concreta su funnel,
                        traffico e conversioni, passa dall'audit.
                    </p>

                    <div class="actions">
                        <a href="{{ route('audit') }}" class="button mobile-fullwidth">Richiedi audit</a>
                        <a href="{{ route('risorsa') }}" class="button-secondary mobile-fullwidth">Scarica risorsa</a>
                    </div>

                    <div class="contact-direct">
                        <span class="label">Email</span>
                        <a href="mailto:hello@produceavalue.com">hello@produceavalue.com</a>
                    </div>
                </div>

                <form class="form-panel form-stack" action="{{ route('contatti.store') }}" method="post">
                    @csrf

                    <div class="form-honeypot" aria-hidden="true">
                        <label>
                            Sito aziendale
                            <input type="text" name="company_website" tabindex="-1" autocomplete="off">
                        </label>
                    </div>

                    @if (session('status'))
                        <div class="form-error form-success">
                            <strong>Messaggio ricevuto.</strong>
                            <p>{{ session('status') }}</p>
                        </div>
                    @endif

                    <label>
                        Nome
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Il tuo nome" required>
                    </label>

                    <label>
                        Email
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nome@email.com" required>
                    </label>

                    <label>
                        Budget indicativo
                        <select name="budget">
                            <option value="">Seleziona range</option>
                            <option value="under-5k" @selected(old('budget') === 'under-5k')>Sotto 5K</option>
                            <option value="5k-10k" @selected(old('budget') === '5k-10k')>5K - 10K</option>
                            <option value="10k-plus" @selected(old('budget') === '10k-plus')>10K+</option>
                        </select>
                    </label>

                    <label>
                        Progetto
                        <textarea name="message" rows="6" placeholder="Brand, pagina, sito, funnel, campagna..." required>{{ old('message') }}</textarea>
                    </label>

                    <button class="button fullwidth" type="submit">Invia richiesta</button>
                </form>
            </div>
        </section>
    </main>
@endsection
