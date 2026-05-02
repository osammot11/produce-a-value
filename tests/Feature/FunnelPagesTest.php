<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $response = $this->post('/audit', [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'company' => 'Rossi Commerce',
            'website' => 'https://example.com',
            'role' => 'Founder',
            'business_type' => 'Ecommerce',
            'market' => 'Italia',
            'average_order_value' => '80 euro',
            'channels' => ['Meta Ads', 'Email'],
            'monthly_ad_budget' => '2K - 10K',
            'main_problem' => 'Conversion rate basso',
            'monthly_revenue' => '50K',
            'conversion_rate' => '1.2%',
            'monthly_sales' => '600',
            'ltv' => '180 euro',
            'goal_90_days' => 'Aumentare vendite e conversion rate senza alzare subito il budget ads.',
            'project_budget' => '8K - 20K',
            'timeline' => 'Entro 30 giorni',
            'decision_maker' => 'Sì',
            'ready_to_act' => '1',
            'notes' => 'Serve una diagnosi del funnel.',
            'privacy_consent' => '1',
        ]);

        $response->assertRedirect('/audit/richiesto');

        $this->assertDatabaseHas('audit_submissions', [
            'email' => 'mario@example.com',
            'company' => 'Rossi Commerce',
            'main_problem' => 'Conversion rate basso',
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
