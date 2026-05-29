<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class CalComService
{
    /**
     * @return array<string, mixed>
     */
    public function slots(string $start, string $end, string $timeZone): array
    {
        $response = $this->client(config('services.cal.api_version_slots'))
            ->get('/slots', [
                'eventTypeId' => config('services.cal.event_type_id'),
                'start' => $start,
                'end' => $end,
                'timeZone' => $timeZone,
                'format' => 'range',
            ]);

        if ($response->failed()) {
            throw new RuntimeException($response->json('error.message') ?: 'Impossibile leggere gli slot Cal.com.');
        }

        return $response->json('data', []);
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    public function createBooking(array $payload): array
    {
        $response = $this->client(config('services.cal.api_version_bookings'))
            ->post('/bookings', $payload);

        if ($response->failed()) {
            throw new RuntimeException($response->json('error.message') ?: 'Impossibile creare la prenotazione Cal.com.');
        }

        return $response->json('data', []);
    }

    private function client(string $apiVersion): PendingRequest
    {
        $apiKey = config('services.cal.api_key');

        if (! $apiKey || ! config('services.cal.event_type_id')) {
            throw new RuntimeException('Configurazione Cal.com incompleta.');
        }

        return Http::baseUrl(rtrim((string) config('services.cal.api_base_url'), '/'))
            ->acceptJson()
            ->asJson()
            ->withToken($apiKey)
            ->withHeaders([
                'cal-api-version' => $apiVersion,
            ])
            ->timeout(10);
    }
}
