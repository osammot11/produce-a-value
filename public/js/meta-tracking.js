(function () {
    const tracking = document.querySelector('[data-meta-tracking]');
    if (!tracking) return;

    const banner = document.querySelector('[data-consent-banner]');
    const error = banner.querySelector('[data-consent-error]');
    const buttons = Array.from(banner.querySelectorAll('[data-consent-choice]'));
    const settings = document.querySelector('[data-cookie-settings]');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    let consent = tracking.dataset.consent;
    let pixelStarted = false;

    function startPixel() {
        if (pixelStarted || consent !== 'accepted') return;
        pixelStarted = true;

        // Meta Pixel queue: no external request is made before consent.
        (function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () { n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments); };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = true;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = true;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s);
        })(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', tracking.dataset.pixelId);
        fbq('track', 'PageView');

        if (tracking.dataset.eventName && tracking.dataset.eventId) {
            fbq('track', tracking.dataset.eventName,
                { lead_type: tracking.dataset.eventSource },
                { eventID: tracking.dataset.eventId });
        }
    }

    function removePixelCookies() {
        const domains = ['', location.hostname, '.' + location.hostname.split('.').slice(-2).join('.')];

        ['_fbp', '_fbc'].forEach(function (name) {
            domains.forEach(function (domain) {
                document.cookie = name + '=; Max-Age=0; Path=/; SameSite=Lax' + (domain ? '; Domain=' + domain : '');
            });
        });
    }

    if (consent === 'accepted') startPixel();

    settings?.addEventListener('click', function () {
        banner.hidden = false;
        error.hidden = true;
        banner.querySelector('[data-consent-choice]')?.focus();
    });

    buttons.forEach(function (button) {
        button.addEventListener('click', async function () {
            const decision = button.dataset.consentChoice;
            buttons.forEach(function (item) { item.disabled = true; });
            error.hidden = true;

            try {
                const response = await fetch(tracking.dataset.consentUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ decision: decision }),
                });

                if (!response.ok) throw new Error('Consent request failed');

                const wasAccepted = consent === 'accepted';
                consent = decision;
                banner.hidden = true;

                if (decision === 'accepted') startPixel();
                if (decision === 'rejected' && wasAccepted) {
                    removePixelCookies();
                    window.location.reload();
                }
            } catch (exception) {
                error.hidden = false;
            } finally {
                buttons.forEach(function (item) { item.disabled = false; });
            }
        });
    });
})();
