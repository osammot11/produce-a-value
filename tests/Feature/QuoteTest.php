<?php

namespace Tests\Feature;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_quote_with_items_and_vat(): void
    {
        $response = $this->withSession(['admin_authenticated' => true])
            ->post('/admin/preventivi', $this->quotePayload([
                'vat_type' => Quote::VAT_TYPE_STANDARD,
                'items' => [
                    ['title' => 'Audit funnel', 'description' => 'Analisi completa', 'price' => '1.000,00'],
                    ['title' => 'Landing page', 'description' => '', 'price' => '500,00'],
                ],
            ]));

        $quote = Quote::firstWhere('client_name', 'Mario Rossi');

        $response->assertRedirect('/admin/preventivi/'.$quote->slug);
        $this->assertDatabaseHas('quotes', [
            'slug' => 'proposta-cro',
            'subtotal_cents' => 150000,
            'vat_cents' => 33000,
            'total_cents' => 183000,
        ]);
        $this->assertDatabaseHas('quote_items', [
            'quote_id' => $quote->id,
            'title' => 'Landing page',
            'price_cents' => 50000,
        ]);
    }

    public function test_public_quote_requires_code_and_downloads_pdf(): void
    {
        config(['quotes.access_code' => '9999']);
        $quote = $this->quote();

        $this->get('/preventivi/'.$quote->slug)
            ->assertOk()
            ->assertSee('Accesso con codice')
            ->assertDontSee('Audit funnel');

        $this->post('/preventivi/'.$quote->slug.'/accesso', [
            'access_code' => '0000',
        ])->assertSessionHasErrors('access_code');

        $this->post('/preventivi/'.$quote->slug.'/accesso', [
            'access_code' => '9999',
        ])->assertRedirect('/preventivi/'.$quote->slug);

        $this->withSession(['quote_access_'.$quote->id => true])
            ->get('/preventivi/'.$quote->slug)
            ->assertOk()
            ->assertSee('Audit funnel')
            ->assertSee('€ 1.220,00');

        $this->withSession(['quote_access_'.$quote->id => true])
            ->get('/preventivi/'.$quote->slug.'/pdf')
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    }

    public function test_there_is_no_public_quote_listing(): void
    {
        $this->get('/preventivi')->assertNotFound();
    }

    private function quotePayload(array $overrides = []): array
    {
        return array_replace_recursive([
            'title' => 'Proposta CRO',
            'slug' => '',
            'status' => 'draft',
            'valid_until' => now()->addDays(15)->format('Y-m-d'),
            'company_name' => 'Produce a Value',
            'company_vat' => 'IT00000000000',
            'company_email' => 'hello@produceavalue.com',
            'company_phone' => '+39 000 000 0000',
            'company_address' => 'Via Test 1',
            'company_website' => 'https://produceavalue.com',
            'client_name' => 'Mario Rossi',
            'client_company' => 'Rossi Commerce',
            'client_email' => 'mario@example.com',
            'client_phone' => '+39 111 111 1111',
            'client_vat' => 'IT11111111111',
            'client_address' => 'Via Cliente 2',
            'business_plan' => '<h3>Piano</h3><p>Priorità operative.</p>',
            'vat_type' => Quote::VAT_TYPE_STANDARD,
            'items' => [
                ['title' => 'Audit funnel', 'description' => 'Analisi completa', 'price' => '1000'],
            ],
        ], $overrides);
    }

    private function quote(): Quote
    {
        $quote = Quote::create([
            'title' => 'Proposta CRO',
            'slug' => 'proposta-cro',
            'status' => 'sent',
            'company_name' => 'Produce a Value',
            'company_email' => 'hello@produceavalue.com',
            'client_name' => 'Mario Rossi',
            'client_company' => 'Rossi Commerce',
            'client_email' => 'mario@example.com',
            'business_plan' => '<h3>Piano</h3><p>Priorità operative.</p>',
            'vat_type' => Quote::VAT_TYPE_STANDARD,
            'subtotal_cents' => 100000,
            'vat_cents' => 22000,
            'total_cents' => 122000,
        ]);

        $quote->items()->create([
            'title' => 'Audit funnel',
            'description' => 'Analisi completa',
            'price_cents' => 100000,
            'sort_order' => 0,
        ]);

        return $quote;
    }
}
