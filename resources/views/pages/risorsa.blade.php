@extends('layouts.app')

@section('title', 'Risorsa gratuita | Produce a Value')

@section('content')
    <main class="resource-brutal">
        <section class="resource-brutal-shell">
            <div class="resource-brutal-main">
                <p class="page-brutal-kicker">Risorsa gratuita</p>
                <h1 class="page-brutal-title">Checklist per capire perché il tuo sito non converte.</h1>
                <p class="page-brutal-text">
                    Una diagnosi pratica per ecommerce e startup: offerta, above the fold, proof, funnel,
                    creatività e tracciamento. Niente teoria gonfia. Solo punti da controllare.
                </p>

                <div class="resource-brutal-list">
                    <span>Inside</span>
                    <ul>
                        <li>12 segnali che una landing sta bruciando traffico.</li>
                        <li>Domande per capire se il problema è offerta, pagina o traffico.</li>
                        <li>Priorità brutale: cosa sistemare prima.</li>
                    </ul>
                </div>
            </div>

            <form class="resource-form-brutal" action="{{ route('risorsa.store') }}" method="post">
                @csrf

                @if ($errors->any())
                    <div class="audit-error-brutal">
                        <strong>Controlla i dati.</strong>
                        <p>Email e consenso privacy sono obbligatori.</p>
                    </div>
                @endif

                <label>Nome
                    <input type="text" name="name" value="{{ old('name') }}">
                </label>

                <label>Email
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </label>

                <label>Tipo business
                    <select name="business_type">
                        <option value="">Seleziona</option>
                        <option value="Ecommerce" @selected(old('business_type') === 'Ecommerce')>Ecommerce</option>
                        <option value="Startup" @selected(old('business_type') === 'Startup')>Startup</option>
                        <option value="Lead generation" @selected(old('business_type') === 'Lead generation')>Lead generation</option>
                        <option value="Altro" @selected(old('business_type') === 'Altro')>Altro</option>
                    </select>
                </label>

                <label class="audit-privacy-brutal">
                    <input type="checkbox" name="privacy_consent" value="1" required @checked(old('privacy_consent'))>
                    <span>Accetto il trattamento dei dati secondo la <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.</span>
                </label>

                <button class="brutal-button contact-brutal-submit" type="submit">Scarica risorsa</button>
                <a href="{{ route('audit') }}" class="resource-audit-link">Vuoi saltare la checklist? Richiedi audit.</a>
            </form>
        </section>
    </main>
@endsection
