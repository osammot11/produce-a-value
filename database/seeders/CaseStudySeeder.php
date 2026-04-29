<?php

namespace Database\Seeders;

use App\Models\CaseStudy;
use Illuminate\Database\Seeder;

class CaseStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $caseStudies = [
            [
                'title' => 'Landing page per aumentare richieste qualificate',
                'slug' => 'landing-page-richieste-qualificate',
                'client_name' => 'Nova Commerce',
                'industry' => 'Ecommerce skincare',
                'service' => 'Landing Page',
                'summary' => 'Una pagina campagna costruita per trasformare traffico paid in lead più caldi e meno dispersi.',
                'challenge' => 'Il traffico arrivava da Meta Ads ma la pagina non rendeva chiara la promessa, disperdeva attenzione e non filtrava abbastanza.',
                'solution' => 'Abbiamo ricostruito above the fold, prova, sequenza delle obiezioni e CTA con una struttura più aggressiva e misurabile.',
                'result' => 'La nuova landing ha migliorato la qualità delle richieste e reso più chiaro quali angle creativi generavano intento reale.',
                'metric_one_label' => 'Lead quality',
                'metric_one_value' => '+42%',
                'metric_two_label' => 'Time to launch',
                'metric_two_value' => '12d',
                'metric_three_label' => 'Funnel leaks',
                'metric_three_value' => '-31%',
                'visual_label' => 'Campaign landing mockup',
                'visual_caption' => 'Hero, proof stack e CTA ricostruiti per traffico paid.',
                'before_state' => 'Pagina dispersiva, promessa generica, proof sotto la piega e CTA poco qualificante.',
                'after_state' => 'Above the fold diretto, sequenza obiezioni più chiara e richiesta lead filtrata.',
                'problems_solved' => "Promessa poco specifica\nCTA troppo generica\nProof non visibile\nTraffico paid non filtrato",
                'testimonial_quote' => 'Il lavoro ha reso finalmente leggibile cosa stavamo testando e perché alcuni lead valevano più di altri.',
                'testimonial_author' => 'Elena Marini',
                'testimonial_role' => 'Growth Lead, Nova Commerce',
                'status' => 'published',
                'published_at' => now()->subDays(18),
            ],
            [
                'title' => 'Audit CRO per startup SaaS in fase scale',
                'slug' => 'audit-cro-startup-saas-scale',
                'client_name' => 'MetricFlow',
                'industry' => 'SaaS B2B',
                'service' => 'Conversion Rate',
                'summary' => 'Diagnosi di funnel, pricing page e demo request per capire dove il traffico perdeva fiducia.',
                'challenge' => 'Il prodotto aveva traction, ma la pagina non riusciva a trasformare interesse tecnico in richieste demo concrete.',
                'solution' => 'Abbiamo mappato frizioni, mancanze di proof, ambiguità dell’offerta e priorità di test per i successivi 90 giorni.',
                'result' => 'Il team ha ottenuto una roadmap operativa per intervenire su messaggio, proof, CTA e tracciamento eventi.',
                'metric_one_label' => 'Priority tests',
                'metric_one_value' => '9',
                'metric_two_label' => 'Critical issues',
                'metric_two_value' => '14',
                'metric_three_label' => 'Roadmap',
                'metric_three_value' => '90d',
                'visual_label' => 'CRO roadmap mockup',
                'visual_caption' => 'Diagnosi funnel con priorità su demo request, pricing e proof.',
                'before_state' => 'Interesse tecnico alto, ma pagina pricing e demo request non trasformavano fiducia in azione.',
                'after_state' => 'Roadmap con test ordinati per impatto, effort e ruolo nel funnel.',
                'problems_solved' => "Demo request debole\nProof B2B insufficiente\nPricing page ambigua\nEventi tracking incompleti",
                'testimonial_quote' => 'La cosa utile è stata uscire dalla sensazione e avere una lista chiara di test con priorità.',
                'testimonial_author' => 'Marco Gentili',
                'testimonial_role' => 'Founder, MetricFlow',
                'status' => 'published',
                'published_at' => now()->subDays(9),
            ],
            [
                'title' => 'Creative system per campagna ecommerce',
                'slug' => 'creative-system-campagna-ecommerce',
                'client_name' => 'Forge Active',
                'industry' => 'Ecommerce apparel',
                'service' => 'Creative Performance',
                'summary' => 'Sistema di angle e asset per rendere più leggibili i test creativi e allinearli alla landing.',
                'challenge' => 'Il brand produceva molte creatività ma senza una logica chiara tra promessa, pubblico, pagina e apprendimento.',
                'solution' => 'Abbiamo creato una matrice di angle, claim, proof e destinazioni landing per separare test creativi da test casuali.',
                'result' => 'La produzione creativa è diventata più ordinata, leggibile e collegata alle prossime iterazioni della pagina.',
                'metric_one_label' => 'Angles',
                'metric_one_value' => '18',
                'metric_two_label' => 'Assets',
                'metric_two_value' => '36',
                'metric_three_label' => 'Learning loop',
                'metric_three_value' => 'On',
                'visual_label' => 'Creative testing board',
                'visual_caption' => 'Matrice angle, asset e landing match per rendere i test leggibili.',
                'before_state' => 'Tante creatività prodotte, pochi apprendimenti riutilizzabili e poca coerenza post-click.',
                'after_state' => 'Sistema di angle e asset collegato alla promessa della landing e ai prossimi test.',
                'problems_solved' => "Produzione creativa disordinata\nAngle non tracciati\nLanding mismatch\nApprendimento lento",
                'testimonial_quote' => 'Abbiamo smesso di produrre asset a volume e iniziato a capire cosa stavamo imparando.',
                'testimonial_author' => 'Davide Rinaldi',
                'testimonial_role' => 'Performance Manager, Forge Active',
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($caseStudies as $caseStudy) {
            CaseStudy::updateOrCreate(
                ['slug' => $caseStudy['slug']],
                $caseStudy
            );
        }
    }
}
