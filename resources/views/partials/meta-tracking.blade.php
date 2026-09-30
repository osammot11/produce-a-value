@if (config('services.meta.enabled') && config('services.meta.pixel_id'))
    @php($metaConversion = session('meta_conversion'))
    <div
        data-meta-tracking
        data-pixel-id="{{ config('services.meta.pixel_id') }}"
        data-consent-url="{{ route('marketing-consent.store') }}"
        data-consent="{{ request()->cookie(\App\Services\MetaConversions::CONSENT_COOKIE) }}"
        @if ($metaConversion)
            data-event-name="{{ $metaConversion['name'] }}"
            data-event-id="{{ $metaConversion['id'] }}"
            data-event-source="{{ $metaConversion['source'] }}"
        @endif
        hidden
    ></div>

    <aside class="consent-banner" data-consent-banner aria-label="Preferenze cookie" @if (request()->cookie(\App\Services\MetaConversions::CONSENT_COOKIE)) hidden @endif>
        <div class="consent-copy">
            <strong>Cookie e tracciamento</strong>
            <p>Usiamo cookie tecnici per il sito. Con il tuo consenso, usiamo Meta Pixel e Conversions API per misurare le visite e le richieste ricevute. Puoi cambiare scelta in qualsiasi momento. <a href="{{ route('cookie-policy') }}">Leggi la Cookie Policy</a>.</p>
            <p class="consent-error" data-consent-error role="status" hidden>Non siamo riusciti a salvare la scelta. Riprova.</p>
        </div>
        <div class="consent-actions">
            <button type="button" class="consent-reject" data-consent-choice="rejected">Rifiuta</button>
            <button type="button" class="consent-accept" data-consent-choice="accepted">Accetta</button>
        </div>
    </aside>

    <script src="{{ asset('js/meta-tracking.js') }}"></script>
@endif
