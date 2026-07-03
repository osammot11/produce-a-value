<?php

namespace Tests\Feature;

use App\Mail\AuditSubmissionReceived;
use App\Mail\ContactSubmissionReceived;
use App\Models\AuditSubmission;
use App\Models\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FunnelPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_funnel_pages_return_successful_responses(): void
    {
        foreach ([
            '/',
            '/audit',
            '/risorsa',
            '/servizi',
            '/servizi/landing-page',
            '/servizi/conversion-rate',
            '/servizi/creative-performance',
            '/servizi/ticketing-custom',
            '/servizi/ticketing-custom/richiesta-inviata',
            '/servizi/ticketing-custom/call-prenotata',
            '/work',
            '/manifesto',
            '/contatti',
            '/privacy-policy',
            '/cookie-policy',
        ] as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_audit_submission_is_validated_and_stored(): void
    {
        Mail::fake();
        config(['lead-notifications.email' => 'giovannonicommerciale@gmail.com']);

        $response = $this->post('/audit', [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'phone' => '+39 333 1234567',
            'brand_name' => 'Rossi Commerce',
            'ecommerce_url' => 'example.com',
            'online_since' => '1-2 anni',
            'product_audience' => 'Vendiamo accessori premium a clienti ecommerce in Italia.',
            'monthly_revenue_range' => '30 - 70k',
            'monthly_ads_spend_range' => '5000 - 15.000€',
            'aov_range' => '60 - 100€',
            'ads_profitability' => 'Profittevoli ma instabili',
            'monthly_orders_range' => '300 - 1000',
            'repeat_purchase_rate' => 'Qualcuno torna, poco strutturato',
            'channels' => ['Meta Ads', 'Email marketing/Automazioni'],
            'current_strategy' => 'Abbiamo traffico, ma non converte',
            'bottleneck' => 'Struttura del funnel',
            'goal_90_days' => 'Aumentare vendite e conversion rate senza alzare subito il budget ads.',
            'biggest_obstacle' => 'Serve una diagnosi del funnel.',
            'privacy_consent' => '1',
        ]);

        $response->assertRedirect('/audit/richiesto');
        $response->assertSessionHas('radar_result.priority', 'Conversione e funnel');

        $this->assertDatabaseHas('audit_submissions', [
            'email' => 'mario@example.com',
            'phone' => '+39 333 1234567',
            'company' => 'Rossi Commerce',
            'brand_name' => 'Rossi Commerce',
            'website' => 'https://example.com',
            'ecommerce_url' => 'https://example.com',
            'main_problem' => 'Struttura del funnel',
            'bottleneck' => 'Struttura del funnel',
            'monthly_revenue_range' => '30 - 70k',
            'monthly_ads_spend_range' => '5000 - 15.000€',
            'radar_score' => 56,
            'radar_profile' => 'Growth con attrito',
            'radar_priority' => 'Conversione e funnel',
        ]);

        Mail::assertSent(AuditSubmissionReceived::class, function (AuditSubmissionReceived $mail) {
            return $mail->hasTo('giovannonicommerciale@gmail.com')
                && $mail->audit->email === 'mario@example.com';
        });
    }

    public function test_audit_radar_page_shows_new_flow_and_requires_final_contact_data(): void
    {
        $this->get('/audit')
            ->assertOk()
            ->assertSee('RADAR strategico')
            ->assertSee('Come si chiama il tuo brand?')
            ->assertSee('Stiamo leggendo i segnali del tuo ecommerce.')
            ->assertSee('Telefono');

        $response = $this->post('/audit', [
            'brand_name' => 'No Contact Brand',
            'ecommerce_url' => 'https://example.com',
            'online_since' => '6-12 mesi',
            'product_audience' => 'Vendiamo prodotti ecommerce a un target specifico.',
            'monthly_revenue_range' => '10 - 30k',
            'monthly_ads_spend_range' => '1000 - 5000€',
            'aov_range' => '30 - 60€',
            'ads_profitability' => 'Break-even',
            'monthly_orders_range' => '100 - 300',
            'repeat_purchase_rate' => 'Quasi mai',
            'current_strategy' => 'Non abbiamo una strategia chiara',
            'bottleneck' => 'Acquisizione clienti',
            'goal_90_days' => 'Capire dove intervenire nei prossimi 90 giorni.',
            'biggest_obstacle' => 'Non sappiamo quale leva muovere per prima.',
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
        ]);

        $response->assertSessionHasErrors(['phone', 'channels', 'privacy_consent']);
    }

    public function test_call_booking_sends_audit_metadata_as_strings(): void
    {
        Http::fake([
            'api.cal.com/v2/bookings' => Http::response([
                'data' => [
                    'id' => 987,
                    'uid' => 'booking_uid',
                    'status' => 'accepted',
                    'start' => '2026-06-01T09:00:00.000Z',
                    'end' => '2026-06-01T09:30:00.000Z',
                ],
            ], 201),
        ]);

        config([
            'services.cal.api_key' => 'cal_test_key',
            'services.cal.event_type_id' => 3237371,
        ]);

        $audit = AuditSubmission::create([
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'phone' => '+39 333 1234567',
            'company' => 'Rossi Commerce',
            'business_type' => 'Ecommerce',
            'main_problem' => 'Conversion rate basso',
            'goal_90_days' => 'Aumentare conversioni.',
            'project_budget' => 'RADAR strategico',
            'timeline' => 'Prossimi 90 giorni',
            'decision_maker' => 'Sì',
            'ready_to_act' => true,
            'radar_profile' => 'Growth con attrito',
            'radar_priority' => 'Conversione e funnel',
        ]);

        $response = $this->postJson('/audit/book-call', [
            'audit_id' => $audit->id,
            'start' => '2026-06-01T09:00:00.000Z',
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'phone' => '+39 333 1234567',
            'timeZone' => 'Europe/Rome',
        ]);

        $response->assertCreated();

        Http::assertSent(function ($request) use ($audit) {
            return $request->url() === 'https://api.cal.com/v2/bookings'
                && $request['metadata']['audit_submission_id'] === (string) $audit->id
                && is_string($request['metadata']['audit_submission_id']);
        });

        $this->assertDatabaseHas('audit_submissions', [
            'id' => $audit->id,
            'cal_booking_uid' => 'booking_uid',
            'cal_booking_status' => 'accepted',
        ]);
    }

    public function test_resource_lead_is_validated_and_stored(): void
    {
        $response = $this->post('/risorsa', [
            'name' => 'Laura',
            'email' => 'laura@example.com',
            'business_type' => 'Startup',
            'privacy_consent' => '1',
        ]);

        $response->assertRedirect('/risorsa/ricevuta');

        $this->assertDatabaseHas('resource_leads', [
            'email' => 'laura@example.com',
            'business_type' => 'Startup',
        ]);
    }

    public function test_contact_submission_is_validated_and_stored(): void
    {
        Mail::fake();
        config(['lead-notifications.email' => 'giovannonicommerciale@gmail.com']);

        $response = $this
            ->withSession(['contact_form_started_at' => now()->subSeconds(10)->timestamp])
            ->withServerVariables([
                'REMOTE_ADDR' => '203.0.113.10',
                'HTTP_USER_AGENT' => 'PAV Test Browser',
            ])
            ->post('/contatti', [
                'name' => 'Giulia',
                'email' => 'giulia@example.com',
                'budget' => '10k-plus',
                'message' => 'Vorrei parlare di una landing per ecommerce.',
            ]);

        $response->assertRedirect('/contatti');

        $this->assertDatabaseHas('contact_submissions', [
            'email' => 'giulia@example.com',
            'budget' => '10k-plus',
            'ip_address' => '203.0.113.10',
            'user_agent' => 'PAV Test Browser',
        ]);

        Mail::assertSent(ContactSubmissionReceived::class, function (ContactSubmissionReceived $mail) {
            return $mail->hasTo('giovannonicommerciale@gmail.com')
                && $mail->contact->email === 'giulia@example.com';
        });
    }

    public function test_contact_honeypot_submission_is_accepted_but_not_stored(): void
    {
        $response = $this
            ->withSession(['contact_form_started_at' => now()->subSeconds(10)->timestamp])
            ->post('/contatti', [
                'name' => 'Bot',
                'email' => 'bot@example.com',
                'budget' => '10k-plus',
                'message' => 'Questo messaggio sembra valido ma arriva da un bot.',
                'company_website' => 'https://spam.example',
            ]);

        $response->assertRedirect('/contatti');

        $this->assertDatabaseMissing('contact_submissions', [
            'email' => 'bot@example.com',
        ]);
    }

    public function test_contact_submission_without_form_timing_is_accepted_but_not_stored(): void
    {
        $response = $this->post('/contatti', [
            'name' => 'Fast Bot',
            'email' => 'fast@example.com',
            'budget' => '10k-plus',
            'message' => 'Questo invio arriva senza prima caricare la pagina contatti.',
        ]);

        $response->assertRedirect('/contatti');

        $this->assertDatabaseMissing('contact_submissions', [
            'email' => 'fast@example.com',
        ]);
    }

    public function test_ticketing_landing_stores_demo_request_and_sends_notification(): void
    {
        Mail::fake();
        config(['lead-notifications.email' => 'giovannonicommerciale@gmail.com']);

        $this->get('/servizi/ticketing-custom')
            ->assertOk()
            ->assertSee('Marathon System by Produce a Value')
            ->assertSee('Richiedi il tuo sito demo gratuito');

        $response = $this
            ->withSession(['ticketing_form_started_at' => now()->subSeconds(10)->timestamp])
            ->withServerVariables([
                'REMOTE_ADDR' => '203.0.113.20',
                'HTTP_USER_AGENT' => 'PAV Ticketing Test Browser',
            ])
            ->post('/servizi/ticketing-custom', [
                'name' => 'Roberto Cervelli',
                'email' => 'roberto@example.com',
                'event_name' => 'Francigena Tuscany Marathon',
                'event_type' => 'Maratona',
                'current_system' => 'WooCommerce',
                'annual_tickets' => '1000+',
                'launch_timing' => 'Tra 2 mesi',
                'message' => 'Vogliamo ridurre commissioni e lavoro manuale.',
            ]);

        $response->assertRedirect('/servizi/ticketing-custom/richiesta-inviata');

        $this->assertDatabaseHas('contact_submissions', [
            'email' => 'roberto@example.com',
            'budget' => 'Ticketing custom',
            'ip_address' => '203.0.113.20',
            'user_agent' => 'PAV Ticketing Test Browser',
        ]);

        Mail::assertSent(ContactSubmissionReceived::class, function (ContactSubmissionReceived $mail) {
            return $mail->hasTo('giovannonicommerciale@gmail.com')
                && $mail->contact->email === 'roberto@example.com'
                && str_contains($mail->contact->message, 'Francigena Tuscany Marathon');
        });

        $this->get('/servizi/ticketing-custom/richiesta-inviata')
            ->assertOk()
            ->assertSee('data-cal-booking', false)
            ->assertSee('Giorno')
            ->assertSee('Orario')
            ->assertSee('Dettagli')
            ->assertDontSee('app.cal.com/embed');
    }

    public function test_ticketing_call_booking_sends_ticketing_source_metadata(): void
    {
        Http::fake([
            'api.cal.com/v2/bookings' => Http::response([
                'data' => [
                    'id' => 654,
                    'uid' => 'ticketing_booking_uid',
                    'status' => 'accepted',
                    'start' => '2026-07-10T09:00:00.000Z',
                    'end' => '2026-07-10T09:30:00.000Z',
                ],
            ], 201),
        ]);

        config([
            'services.cal.api_key' => 'cal_test_key',
            'services.cal.event_type_id' => 3237371,
        ]);

        $response = $this->postJson('/servizi/ticketing-custom/book-call', [
            'source' => 'produceavalue_ticketing',
            'start' => '2026-07-10T09:00:00.000Z',
            'name' => 'Roberto Cervelli',
            'email' => 'roberto@example.com',
            'phone' => '+39 333 1234567',
            'notes' => 'Evento: Francigena Tuscany Marathon',
            'timeZone' => 'Europe/Rome',
        ]);

        $response->assertCreated();

        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.cal.com/v2/bookings'
                && $request['metadata']['source'] === 'produceavalue_ticketing';
        });
    }

    public function test_work_page_is_a_proof_hub_with_published_case_studies(): void
    {
        CaseStudy::create([
            'title' => 'Proof case',
            'slug' => 'proof-case',
            'client_name' => 'Proof Client',
            'industry' => 'Ecommerce',
            'service' => 'Landing Page',
            'summary' => 'Summary proof',
            'challenge' => 'Challenge proof',
            'solution' => 'Solution proof',
            'result' => 'Result proof',
            'metric_one_label' => 'Lead quality',
            'metric_one_value' => '+42%',
            'before_state' => 'Before proof',
            'after_state' => 'After proof',
            'problems_solved' => "Problem A\nProblem B",
            'testimonial_quote' => 'Proof quote',
            'testimonial_author' => 'Proof Author',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->get('/work')
            ->assertOk()
            ->assertSee('Proof, not portfolio decoration.')
            ->assertSee('Proof case')
            ->assertSee('+42%');

        $this->get('/work/proof-case')
            ->assertOk()
            ->assertSee('Before proof')
            ->assertSee('Problem A')
            ->assertSee('Proof quote');
    }
}
