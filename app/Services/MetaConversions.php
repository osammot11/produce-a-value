<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class MetaConversions
{
    public const CONSENT_COOKIE = 'pav_marketing_consent';

    public function record(
        Request $request,
        string $eventName,
        string $source,
        string $sourceUrl,
        ?string $email = null,
        ?string $phone = null,
    ): void {
        if (! config('services.meta.enabled') || ! config('services.meta.pixel_id') ||
            $request->cookie(self::CONSENT_COOKIE) !== 'accepted') {
            return;
        }

        $eventId = (string) Str::uuid();

        $request->session()->flash('meta_conversion', [
            'name' => $eventName,
            'id' => $eventId,
            'source' => $source,
        ]);

        if (! config('services.meta.capi_access_token')) {
            return;
        }

        $userData = array_filter([
            'em' => $this->hash($email),
            'ph' => $this->hash($phone ? preg_replace('/\D+/', '', $phone) : null),
            'client_ip_address' => $request->ip(),
            'client_user_agent' => $request->userAgent(),
            'fbp' => $request->cookie('_fbp'),
            'fbc' => $request->cookie('_fbc'),
        ]);

        $event = [
            'event_name' => $eventName,
            'event_time' => now()->timestamp,
            'event_id' => $eventId,
            'action_source' => 'website',
            'event_source_url' => $this->sourceUrl($request, $sourceUrl),
            'user_data' => $userData,
            'custom_data' => ['lead_type' => $source],
        ];

        defer(fn () => $this->send($event));
    }

    private function hash(?string $value): ?string
    {
        $value = mb_strtolower(trim((string) $value));

        return $value !== '' ? hash('sha256', $value) : null;
    }

    private function sourceUrl(Request $request, string $fallback): string
    {
        $referer = $request->headers->get('referer');
        $parts = is_string($referer) ? parse_url($referer) : false;

        if (is_array($parts) &&
            in_array($parts['scheme'] ?? null, ['http', 'https'], true) &&
            strcasecmp($parts['host'] ?? '', $request->getHost()) === 0) {
            $port = isset($parts['port']) ? ':'.$parts['port'] : '';

            return $parts['scheme'].'://'.$parts['host'].$port.($parts['path'] ?? '/');
        }

        return $fallback;
    }

    private function send(array $event): void
    {
        $payload = ['data' => [$event]];

        if ($testCode = config('services.meta.test_event_code')) {
            $payload['test_event_code'] = $testCode;
        }

        try {
            $response = Http::timeout(3)
                ->withQueryParameters(['access_token' => config('services.meta.capi_access_token')])
                ->post('https://graph.facebook.com/'.config('services.meta.api_version').'/'.config('services.meta.pixel_id').'/events', $payload);

            if ($response->failed() || $response->json('events_received') !== 1) {
                Log::warning('Meta CAPI event was not accepted.', [
                    'event_id' => $event['event_id'],
                    'status' => $response->status(),
                ]);
            }
        } catch (Throwable $exception) {
            Log::warning('Meta CAPI request failed.', [
                'event_id' => $event['event_id'],
                'exception' => $exception::class,
            ]);
        }
    }
}
