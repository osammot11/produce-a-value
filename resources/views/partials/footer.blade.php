<footer class="brutal-footer">
    <div class="brutal-footer-shell">

        <div class="brutal-footer-brand">
            <span class="brutal-footer-kicker">Produce a Value</span>
            <strong class="brutal-footer-title">PAV.</strong>
            <p>
                Creative performance studio for brands that need stronger positioning,
                sharper pages and systems built to convert.
            </p>
        </div>

        <div class="brutal-footer-panel brutal-footer-nav-panel">
            <span class="brutal-footer-label">Explore</span>
            <nav class="brutal-footer-nav" aria-label="Navigazione footer">
                <a href="{{ route('servizi') }}">Servizi</a>
                <a href="{{ route('work') }}">Work</a>
                <a href="{{ route('manifesto') }}">Manifesto</a>
                <a href="{{ route('risorsa') }}">Risorsa</a>
                <a href="{{ route('contatti') }}">Contatti</a>
            </nav>
        </div>

        <div class="brutal-footer-panel brutal-footer-contact">
            <span class="brutal-footer-label">Audit</span>
            <p>Hai traffico, vendite o creatività che dovrebbero lavorare meglio?</p>
            <a href="{{ route('audit') }}" class="brutal-button brutal-footer-cta">Richiedi audit</a>
        </div>

        <div class="brutal-footer-bottom">
            <span>© {{ date('Y') }} Produce a Value</span>
            <span>
                <a href="{{ route('privacy-policy') }}">Privacy</a>
                /
                <a href="{{ route('cookie-policy') }}">Cookie</a>
            </span>
        </div>

    </div>
</footer>
