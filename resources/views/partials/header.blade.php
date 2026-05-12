<header class="site-header">
    <div class="navbar">

        <a href="{{ url('/') }}" class="brand">
            <span class="brand-main">PAV.</span>
        </a>

        <nav class="nav" aria-label="Navigazione principale">
            <a href="{{ route('servizi') }}">Servizi</a>
            <a href="{{ route('work') }}">Work</a>
            <a href="{{ route('manifesto') }}">Manifesto</a>
            <a href="{{ route('risorsa') }}">Risorsa</a>
        </nav>

        <div class="header-actions">
            <a href="{{ route('audit') }}" class="button nav-cta">Richiedi audit</a>

            <button class="menu-toggle" type="button" aria-label="Apri menu" aria-expanded="false">
                <span></span>
                <span></span>
            </button>
        </div>

    </div>

    <div class="mobile-menu">
        <div class="mobile-menu-panel">

            <div class="mobile-menu-top">
                <span class="mobile-menu-kicker">menu</span>
                <span class="mobile-menu-index">01</span>
            </div>

            <nav class="mobile-nav" aria-label="Navigazione mobile">
                <a href="{{ route('servizi') }}"><span>01</span> Servizi</a>
                <a href="{{ route('work') }}"><span>02</span> Work</a>
                <a href="{{ route('manifesto') }}"><span>03</span> Manifesto</a>
                <a href="{{ route('risorsa') }}"><span>04</span> Risorsa</a>
            </nav>

            <a href="{{ route('audit') }}" class="button mobile-cta">Richiedi audit</a>

        </div>
    </div>
</header>
