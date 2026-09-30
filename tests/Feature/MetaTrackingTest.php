<?php

namespace Tests\Feature;

use App\Services\MetaConversions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MetaTrackingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
        config([
            'services.meta.enabled' => true,
            'services.meta.pixel_id' => '519510508752584',
            'services.meta.capi_access_token' => 'test-token',
            'services.meta.test_event_code' => 'TEST78705',
        ]);
    }

    public function test_consent_is_explicit_and_can_be_changed(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('data-consent-banner', false)
            ->assertSee('data-cookie-settings', false);

        $this->postJson('/privacy/marketing-consent', ['decision' => 'invalid'])
            ->assertUnprocessable();

        $this->postJson('/privacy/marketing-consent', ['decision' => 'accepted'])
            ->assertOk()
            ->assertJsonPath('decision', 'accepted')
            ->assertCookie(MetaConversions::CONSENT_COOKIE);

        $this->withCookie(MetaConversions::CONSENT_COOKIE, 'accepted')
            ->get('/')
            ->assertSee('data-consent="accepted"', false)
            ->assertSee('class="consent-banner" data-consent-banner', false);

        $this->postJson('/privacy/marketing-consent', ['decision' => 'rejected'])
            ->assertOk()
            ->assertJsonPath('decision', 'rejected');
    }

    public function test_lead_is_saved_without_marketing_consent_but_no_meta_event_is_sent(): void
    {
        Http::fake();

        $this->withSession(['ticketing_form_started_at' => now()->subSeconds(10)->timestamp])
            ->post('/servizi/ticketing-custom', $this->ticketingLead())
            ->assertRedirect('/servizi/ticketing-custom/richiesta-inviata')
            ->assertSessionMissing('meta_conversion');

        $this->assertDatabaseHas('contact_submissions', ['email' => 'giulia@example.com']);
        Http::assertNothingSent();
    }

    public function test_consented_lead_uses_the_same_event_id_for_browser_and_capi(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['events_received' => 1])]);

        $response = $this
            ->withCookie(MetaConversions::CONSENT_COOKIE, 'accepted')
            ->withUnencryptedCookies(['_fbp' => 'fb.1.123.456', '_fbc' => 'fb.1.123.click'])
            ->withSession(['ticketing_form_started_at' => now()->subSeconds(10)->timestamp])
            ->withServerVariables(['HTTP_REFERER' => 'http://localhost/?utm_source=meta'])
            ->post('/servizi/ticketing-custom', $this->ticketingLead());

        $response->assertRedirect('/servizi/ticketing-custom/richiesta-inviata')
            ->assertSessionHas('meta_conversion.name', 'Lead')
            ->assertSessionHas('meta_conversion.source', 'ticketing_demo');

        $eventId = session('meta_conversion.id');
        $this->assertNotEmpty($eventId);

        Http::assertSent(function ($request) use ($eventId) {
            $event = $request['data'][0];

            return str_contains($request->url(), '/519510508752584/events')
                && $event['event_name'] === 'Lead'
                && $event['event_id'] === $eventId
                && $event['custom_data']['lead_type'] === 'ticketing_demo'
                && $event['event_source_url'] === 'http://localhost/'
                && $event['user_data']['em'] === hash('sha256', 'giulia@example.com')
                && $event['user_data']['fbp'] === 'fb.1.123.456'
                && $event['user_data']['fbc'] === 'fb.1.123.click'
                && $request['test_event_code'] === 'TEST78705';
        });

        $this->get('/servizi/ticketing-custom/richiesta-inviata')
            ->assertSee('data-event-name="Lead"', false)
            ->assertSee('data-event-id="'.$eventId.'"', false);
    }

    public function test_booking_is_tracked_only_after_cal_confirms_it(): void
    {
        Http::fake([
            'api.cal.com/v2/bookings' => Http::response([
                'data' => [
                    'id' => 654,
                    'uid' => 'ticketing_booking_uid',
                    'status' => 'accepted',
                    'start' => '2026-10-10T09:00:00.000Z',
                    'end' => '2026-10-10T09:30:00.000Z',
                ],
            ], 201),
            'graph.facebook.com/*' => Http::response(['events_received' => 1]),
        ]);
        config(['services.cal.api_key' => 'cal-test-key', 'services.cal.event_type_id' => 3237371]);

        $this->withCookie(MetaConversions::CONSENT_COOKIE, 'accepted')
            ->get('/servizi/ticketing-custom/richiesta-inviata')
            ->assertSee('data-consent="accepted"', false);

        $this->withCredentials()->postJson('/servizi/ticketing-custom/book-call', [
            'start' => '2026-10-10T09:00:00.000Z',
            'name' => 'Giulia Bianchi',
            'email' => 'giulia@example.com',
            'phone' => '+39 333 1234567',
        ])
            ->assertCreated()
            ->assertSessionHas('meta_conversion.name', 'Schedule');

        $eventId = session('meta_conversion.id');
        Http::assertSent(fn ($request) => str_contains($request->url(), 'graph.facebook.com')
            && $request['data'][0]['event_name'] === 'Schedule'
            && $request['data'][0]['event_id'] === $eventId
            && $request['data'][0]['user_data']['ph'] === hash('sha256', '393331234567'));

        $this->get('/servizi/ticketing-custom/call-prenotata')
            ->assertSee('data-event-id="'.$eventId.'"', false);
    }

    public function test_other_lead_forms_keep_their_own_source(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['events_received' => 1])]);
        $this->withCookie(MetaConversions::CONSENT_COOKIE, 'accepted');

        $this->post('/risorsa', [
            'email' => 'risorsa@example.com',
            'privacy_consent' => '1',
        ])->assertRedirect('/risorsa/ricevuta')
            ->assertSessionHas('meta_conversion.source', 'resource');

        $this->withSession(['contact_form_started_at' => now()->subSeconds(10)->timestamp])
            ->post('/contatti', [
                'name' => 'Giulia Bianchi',
                'email' => 'contatto@example.com',
                'message' => 'Vorrei parlare del mio prossimo progetto di ticketing.',
            ])->assertRedirect('/contatti')
            ->assertSessionHas('meta_conversion.source', 'contact');

        $this->post('/audit', [
            'name' => 'Giulia Bianchi',
            'email' => 'radar@example.com',
            'phone' => '+39 333 1234567',
            'brand_name' => 'Bianchi Commerce',
            'ecommerce_url' => 'example.com',
            'online_since' => '1-2 anni',
            'product_audience' => 'Accessori per sportivi',
            'monthly_revenue_range' => '30 - 70k',
            'monthly_ads_spend_range' => '5000 - 15.000€',
            'aov_range' => '60 - 100€',
            'ads_profitability' => 'Profittevoli ma instabili',
            'monthly_orders_range' => '300 - 1000',
            'repeat_purchase_rate' => 'Qualcuno torna, poco strutturato',
            'channels' => ['Meta Ads'],
            'current_strategy' => 'Abbiamo traffico, ma non converte',
            'bottleneck' => 'Struttura del funnel',
            'goal_90_days' => 'Aumentare conversioni e margine.',
            'biggest_obstacle' => 'Serve una diagnosi.',
            'privacy_consent' => '1',
        ])->assertRedirect('/audit/richiesto')
            ->assertSessionHas('meta_conversion.source', 'radar_audit');

        Http::assertSentCount(3);
    }

    public function test_failed_cal_booking_does_not_send_schedule_event(): void
    {
        Http::fake(['api.cal.com/v2/bookings' => Http::response(['error' => ['message' => 'No slot']], 422)]);
        config(['services.cal.api_key' => 'cal-test-key', 'services.cal.event_type_id' => 3237371]);

        $this->withCookie(MetaConversions::CONSENT_COOKIE, 'accepted')
            ->withCredentials()
            ->postJson('/servizi/ticketing-custom/book-call', [
                'start' => '2026-10-10T09:00:00.000Z',
                'name' => 'Giulia Bianchi',
                'email' => 'giulia@example.com',
                'phone' => '+39 333 1234567',
            ])
            ->assertStatus(502)
            ->assertSessionMissing('meta_conversion');

        Http::assertSentCount(1);
    }

    private function ticketingLead(): array
    {
        return [
            'name' => 'Giulia Bianchi',
            'email' => 'giulia@example.com',
            'event_name' => 'Maratona di Firenze',
            'annual_tickets' => '500-1000',
            'launch_timing' => '2026-11-01',
            'message' => 'Vorrei semplificare le iscrizioni.',
        ];
    }
}
