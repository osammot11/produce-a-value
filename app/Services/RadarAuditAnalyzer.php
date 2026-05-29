<?php

namespace App\Services;

class RadarAuditAnalyzer
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function analyze(array $data): array
    {
        $channels = $data['channels'] ?? [];
        $channelsCount = is_array($channels) ? count($channels) : 0;

        $scores = [
            'maturity' => $this->average([
                $this->scoreOnlineSince($data['online_since'] ?? null),
                $this->scoreRevenue($data['monthly_revenue_range'] ?? null),
                $this->scoreOrders($data['monthly_orders_range'] ?? null),
            ]),
            'acquisition' => $this->average([
                $this->scoreAdsSpend($data['monthly_ads_spend_range'] ?? null),
                $this->scoreAdsProfitability($data['ads_profitability'] ?? null),
                min(90, 20 + ($channelsCount * 12)),
            ]),
            'retention' => $this->scoreRepeatPurchase($data['repeat_purchase_rate'] ?? null),
            'strategy' => $this->scoreStrategy($data['current_strategy'] ?? null),
        ];

        $priority = $this->priorityArea($data);
        $profile = $this->profile($data, $scores);
        $score = (int) round($this->average($scores));

        return [
            'radar_score' => $score,
            'radar_profile' => $profile,
            'radar_priority' => $priority,
            'radar_summary' => $this->summary($profile, $priority, $score),
            'radar_recommendations' => $this->recommendations($priority),
            'radar_scores' => $scores,
        ];
    }

    /**
     * @param  array<int|string, int|float>  $values
     */
    private function average(array $values): int
    {
        $values = array_map('intval', $values);

        return (int) round(array_sum($values) / max(1, count($values)));
    }

    private function scoreOnlineSince(?string $value): int
    {
        return $this->scoreFromMap($value, [
            'Meno di 6 mesi' => 20,
            '6-12 mesi' => 40,
            '1-2 anni' => 65,
            'Più di 2 anni' => 80,
        ]);
    }

    private function scoreRevenue(?string $value): int
    {
        return $this->scoreFromMap($value, [
            '< 10k' => 15,
            '10 - 30k' => 35,
            '30 - 70k' => 55,
            '70 - 150k' => 75,
            '150k +' => 90,
        ]);
    }

    private function scoreAdsSpend(?string $value): int
    {
        return $this->scoreFromMap($value, [
            '0€' => 10,
            '< 1000€' => 25,
            '1000 - 5000€' => 45,
            '5000 - 15.000€' => 70,
            '15.000€ +' => 88,
        ]);
    }

    private function scoreOrders(?string $value): int
    {
        return $this->scoreFromMap($value, [
            '< 100' => 20,
            '100 - 300' => 45,
            '300 - 1000' => 70,
            '1000+' => 90,
        ]);
    }

    private function scoreAdsProfitability(?string $value): int
    {
        return $this->scoreFromMap($value, [
            'Profittevoli e scalabili' => 90,
            'Profittevoli ma instabili' => 65,
            'Break-even' => 45,
            'In perdita' => 25,
            'Non facciamo ads strutturate' => 20,
        ]);
    }

    private function scoreRepeatPurchase(?string $value): int
    {
        return $this->scoreFromMap($value, [
            'Sì, in modo costante' => 85,
            'Qualcuno torna, poco strutturato' => 55,
            'Quasi mai' => 25,
            'Non lo so/non monitoriamo' => 20,
        ]);
    }

    private function scoreStrategy(?string $value): int
    {
        return $this->scoreFromMap($value, [
            'Funziona, ma dipende troppo dalle ads' => 60,
            'Vendiamo, ma i margini sono il problema' => 55,
            'Abbiamo traffico, ma non converte' => 45,
            'Cresciamo ma in modo disordinato' => 40,
            'Non abbiamo una strategia chiara' => 20,
        ]);
    }

    /**
     * @param  array<string, int>  $map
     */
    private function scoreFromMap(?string $value, array $map): int
    {
        return $map[$value ?? ''] ?? 40;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function priorityArea(array $data): string
    {
        $bottleneck = $data['bottleneck'] ?? '';
        $strategy = $data['current_strategy'] ?? '';
        $profitability = $data['ads_profitability'] ?? '';
        $retention = $data['repeat_purchase_rate'] ?? '';

        if ($bottleneck === 'Struttura del funnel' || $strategy === 'Abbiamo traffico, ma non converte') {
            return 'Conversione e funnel';
        }

        if ($bottleneck === 'Margini' || $strategy === 'Vendiamo, ma i margini sono il problema' || in_array($profitability, ['Break-even', 'In perdita'], true)) {
            return 'Margini e ads economics';
        }

        if ($bottleneck === 'Retention / clienti che non tornano' || in_array($retention, ['Quasi mai', 'Non lo so/non monitoriamo'], true)) {
            return 'Retention e valore cliente';
        }

        if ($bottleneck === 'Acquisizione clienti') {
            return 'Acquisizione clienti';
        }

        return 'Direzione operativa';
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<string, int>  $scores
     */
    private function profile(array $data, array $scores): string
    {
        if ($scores['maturity'] < 40) {
            return 'Traction da validare';
        }

        if (($data['monthly_revenue_range'] ?? '') === '150k +' || ($data['monthly_orders_range'] ?? '') === '1000+') {
            return 'Scala bloccata';
        }

        if ($scores['retention'] < 35) {
            return 'Vendite senza ritorno';
        }

        if ($scores['strategy'] < 45) {
            return 'Growth disordinata';
        }

        return 'Growth con attrito';
    }

    private function summary(string $profile, string $priority, int $score): string
    {
        return "Profilo {$profile}. Priorità consigliata: {$priority}. Punteggio RADAR {$score}/100, da usare come indice interno di maturità operativa e chiarezza delle prossime mosse.";
    }

    /**
     * @return array<int, string>
     */
    private function recommendations(string $priority): array
    {
        return match ($priority) {
            'Conversione e funnel' => [
                'Mappare pagina, offerta e sequenza di conversione prima di toccare il traffico.',
                'Identificare le frizioni principali tra promessa, proof, CTA e checkout.',
                'Definire un test prioritario per aumentare conversion rate nei prossimi 30 giorni.',
            ],
            'Margini e ads economics' => [
                'Separare problema di creatività, offerta e margine prima di aumentare budget.',
                'Rivedere AOV, bundle, pricing e costi di acquisizione per capire dove si comprime il profitto.',
                'Costruire una dashboard minima per leggere ROAS, MER e margine insieme.',
            ],
            'Retention e valore cliente' => [
                'Capire perché il cliente non torna: prodotto, esperienza, email o assenza di incentivo.',
                'Disegnare un flusso post-acquisto per seconda vendita, referral o riattivazione.',
                'Misurare LTV e coorti prima di spingere solo nuova acquisizione.',
            ],
            'Acquisizione clienti' => [
                'Chiarire ICP, promessa e angle prima di moltiplicare i canali.',
                'Scegliere un canale primario da rendere stabile invece di disperdere test.',
                'Costruire creatività e landing coerenti con lo stesso messaggio.',
            ],
            default => [
                'Mettere in ordine numeri, obiettivo e vincoli prima di decidere nuove attività.',
                'Scegliere una sola priorità operativa per i prossimi 90 giorni.',
                'Trasformare il RADAR in una roadmap breve con owner, metrica e scadenza.',
            ],
        };
    }
}
