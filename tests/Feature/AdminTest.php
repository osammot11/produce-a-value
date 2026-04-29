<?php

namespace Tests\Feature;

use App\Models\AuditSubmission;
use App\Models\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_requires_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_and_view_dashboard(): void
    {
        config([
            'admin.email' => 'admin@example.com',
            'admin.password' => 'secret-password',
            'admin.password_hash' => null,
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ]);

        $response->assertRedirect('/admin');

        $this->withSession(['admin_authenticated' => true])
            ->get('/admin')
            ->assertOk()
            ->assertSee('Lead, audit e segnali commerciali.');
    }

    public function test_admin_can_view_audit_detail(): void
    {
        $audit = AuditSubmission::create([
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'company' => 'Rossi Commerce',
            'business_type' => 'Ecommerce',
            'main_problem' => 'Conversion rate basso',
            'goal_90_days' => 'Aumentare conversioni.',
            'project_budget' => '8K - 20K',
            'timeline' => 'Entro 30 giorni',
            'decision_maker' => 'Sì',
            'ready_to_act' => true,
        ]);

        $this->withSession(['admin_authenticated' => true])
            ->get('/admin/audit/'.$audit->id)
            ->assertOk()
            ->assertSee('Rossi Commerce')
            ->assertSee('Conversion rate basso');
    }

    public function test_admin_can_update_audit_status_and_internal_notes(): void
    {
        $audit = AuditSubmission::create([
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'company' => 'Rossi Commerce',
            'business_type' => 'Ecommerce',
            'main_problem' => 'Conversion rate basso',
            'goal_90_days' => 'Aumentare conversioni.',
            'project_budget' => '8K - 20K',
            'timeline' => 'Entro 30 giorni',
            'decision_maker' => 'Sì',
            'ready_to_act' => true,
        ]);

        $this->withSession(['admin_authenticated' => true])
            ->put('/admin/audit/'.$audit->id.'/crm', [
                'crm_status' => 'qualificato',
                'internal_notes' => 'Ottimo fit. Ricontattare domani.',
            ])
            ->assertRedirect('/admin/audit/'.$audit->id);

        $this->assertDatabaseHas('audit_submissions', [
            'id' => $audit->id,
            'crm_status' => 'qualificato',
            'internal_notes' => 'Ottimo fit. Ricontattare domani.',
        ]);
    }

    public function test_admin_can_filter_and_export_audits(): void
    {
        AuditSubmission::create([
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'company' => 'Rossi Commerce',
            'business_type' => 'Ecommerce',
            'main_problem' => 'Conversion rate basso',
            'goal_90_days' => 'Aumentare conversioni.',
            'project_budget' => '8K - 20K',
            'timeline' => 'Entro 30 giorni',
            'decision_maker' => 'Sì',
            'ready_to_act' => true,
            'crm_status' => 'qualificato',
        ]);

        AuditSubmission::create([
            'name' => 'Laura Bianchi',
            'email' => 'laura@example.com',
            'company' => 'Bianchi SaaS',
            'business_type' => 'Startup SaaS',
            'main_problem' => 'Tracking scarso',
            'goal_90_days' => 'Sistemare tracking.',
            'project_budget' => '3K - 8K',
            'timeline' => '1-3 mesi',
            'decision_maker' => 'Sì',
            'ready_to_act' => false,
            'crm_status' => 'nuovo',
        ]);

        $this->withSession(['admin_authenticated' => true])
            ->get('/admin/audit?status=qualificato&problem=Conversion%20rate%20basso&budget=8K%20-%2020K&timing=Entro%2030%20giorni')
            ->assertOk()
            ->assertSee('Rossi Commerce')
            ->assertDontSee('Bianchi SaaS');

        $export = $this->withSession(['admin_authenticated' => true])
            ->get('/admin/audit/export?status=qualificato');

        $export->assertOk();
        $export->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('Rossi Commerce', $export->streamedContent());
        $this->assertStringNotContainsString('Bianchi SaaS', $export->streamedContent());
    }

    public function test_admin_can_create_update_and_delete_case_study(): void
    {
        $session = ['admin_authenticated' => true];

        $createResponse = $this->withSession($session)->post('/admin/case-study', [
            'title' => 'Case study test',
            'slug' => '',
            'client_name' => 'Client Test',
            'industry' => 'Ecommerce',
            'service' => 'Landing Page',
            'summary' => 'Summary test',
            'challenge' => 'Challenge test',
            'solution' => 'Solution test',
            'result' => 'Result test',
            'metric_one_label' => 'CR',
            'metric_one_value' => '+20%',
            'before_state' => 'Before test',
            'after_state' => 'After test',
            'problems_solved' => "Problem one\nProblem two",
            'testimonial_quote' => 'Great work',
            'testimonial_author' => 'Client Name',
            'testimonial_role' => 'CEO',
            'status' => 'published',
        ]);

        $caseStudy = CaseStudy::firstWhere('client_name', 'Client Test');

        $createResponse->assertRedirect('/admin/case-study/'.$caseStudy->id);
        $this->assertDatabaseHas('case_studies', [
            'slug' => 'case-study-test',
            'status' => 'published',
        ]);

        $this->get('/work/'.$caseStudy->slug)
            ->assertOk()
            ->assertSee('Case study test')
            ->assertSee('Before test')
            ->assertSee('Problem one')
            ->assertSee('Great work');

        $updateResponse = $this->withSession($session)->put('/admin/case-study/'.$caseStudy->id, [
            'title' => 'Case study updated',
            'slug' => $caseStudy->slug,
            'client_name' => 'Client Test',
            'industry' => 'Ecommerce',
            'service' => 'Conversion Rate',
            'summary' => 'Summary test',
            'challenge' => 'Challenge test',
            'solution' => 'Solution test',
            'result' => 'Result test',
            'metric_one_label' => 'CR',
            'metric_one_value' => '+25%',
            'before_state' => 'Before updated',
            'after_state' => 'After updated',
            'problems_solved' => "Problem one\nProblem two",
            'testimonial_quote' => 'Great work updated',
            'testimonial_author' => 'Client Name',
            'testimonial_role' => 'CEO',
            'status' => 'draft',
        ]);

        $updateResponse->assertRedirect('/admin/case-study/'.$caseStudy->id);
        $this->assertDatabaseHas('case_studies', [
            'title' => 'Case study updated',
            'status' => 'draft',
        ]);

        $this->withSession($session)->delete('/admin/case-study/'.$caseStudy->id)
            ->assertRedirect('/admin/case-study');

        $this->assertDatabaseMissing('case_studies', [
            'client_name' => 'Client Test',
        ]);
    }
}
