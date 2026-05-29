<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Mail\AuditSubmissionReceived;
use App\Mail\ContactSubmissionReceived;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
