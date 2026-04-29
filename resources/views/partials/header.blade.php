<header class="brutal-header">
    <div class="brutal-navbar">

        <a href="{{ url('/') }}" class="brutal-brand">
            <span class="brutal-brand-small">creative performance studio</span>
            <span class="brutal-brand-main">PAV.</span>
        </a>

        <nav class="brutal-nav" aria-label="Navigazione principale">
            <a href="{{ route('servizi') }}">Servizi</a>
            <a href="{{ route('work') }}">Work</a>
            <a href="{{ route('manifesto') }}">Manifesto</a>
            <a href="{{ route('risorsa') }}">Risorsa</a>
        </nav>

        <div class="brutal-actions">
            <a href="{{ route('audit') }}" class="brutal-button brutal-cta">Richiedi audit</a>

            <button class="brutal-toggle" type="button" aria-label="Apri menu" aria-expanded="false">
                <span></span>
                <span></span>
            </button>
        </div>

    </div>

    <div class="brutal-mobile-wrap">
        <div class="brutal-mobile-panel">

            <div class="brutal-mobile-top">
                <span class="brutal-mobile-kicker">menu</span>
                <span class="brutal-mobile-index">01</span>
            </div>

            <nav class="brutal-mobile-nav" aria-label="Navigazione mobile">
                <a href="{{ route('servizi') }}"><span>01</span> Servizi</a>
                <a href="{{ route('work') }}"><span>02</span> Work</a>
                <a href="{{ route('manifesto') }}"><span>03</span> Manifesto</a>
                <a href="{{ route('risorsa') }}"><span>04</span> Risorsa</a>
            </nav>

            <a href="{{ route('audit') }}" class="brutal-button brutal-mobile-cta">Richiedi audit</a>

        </div>
    </div>
</header>
