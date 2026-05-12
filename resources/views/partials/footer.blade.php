<footer class="site-footer">
    <div class="footer-shell">

        <div class="footer-brand">
            <span class="footer-kicker">Produce a Value</span>
            <strong class="footer-title">PAV.</strong>
            <p>
                Creative performance studio for brands that need stronger positioning,
                sharper pages and systems built to convert.
            </p>
        </div>

        <div class="footer-panel">
            <span class="footer-label">Explore</span>
            <nav class="footer-nav" aria-label="Navigazione footer">
                <a href="{{ route('servizi') }}">Servizi</a>
                <a href="{{ route('work') }}">Work</a>
                <a href="{{ route('manifesto') }}">Manifesto</a>
                <a href="{{ route('risorsa') }}">Risorsa</a>
                <a href="{{ route('contatti') }}">Contatti</a>
            </nav>
        </div>

        <div class="footer-panel footer-contact">
            <span class="footer-label">Audit</span>
            <p>Hai traffico, vendite o creatività che dovrebbero lavorare meglio?</p>
            <a href="{{ route('audit') }}" class="button footer-cta">Richiedi audit</a>
        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} Produce a Value</span>
            <span>
                <a href="{{ route('privacy-policy') }}">Privacy</a>
                /
                <a href="{{ route('cookie-policy') }}">Cookie</a>
            </span>
        </div>

    </div>
</footer>
