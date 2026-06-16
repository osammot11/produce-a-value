<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>{{ $quote->title ?: 'Preventivo' }}</title>
    <style>
        @page {
            margin: 32px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #ffffff;
            color: #111111;
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        h1,
        h2,
        h3,
        p {
            margin: 0;
        }

        .header {
            padding: 18px;
            background: #111111;
            color: #f5efe4;
            border: 2px solid #111111;
        }

        .kicker {
            margin-bottom: 10px;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        h1 {
            font-size: 34px;
            line-height: 0.95;
            text-transform: uppercase;
        }

        .meta {
            margin-top: 12px;
            color: #d9d0c1;
        }

        .grid {
            width: 100%;
            margin-top: 18px;
            border-spacing: 0;
        }

        .grid td {
            width: 50%;
            vertical-align: top;
        }

        .box {
            min-height: 150px;
            padding: 16px;
            background: #f5efe4;
            border: 2px solid #111111;
        }

        .box-spacer {
            width: 14px !important;
            border: 0;
        }

        .label {
            display: block;
            margin-bottom: 10px;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        h2 {
            margin-bottom: 10px;
            font-size: 22px;
            line-height: 1;
            text-transform: uppercase;
        }

        .muted {
            color: #4a463f;
        }

        .section {
            margin-top: 18px;
            padding: 16px;
            background: #f5efe4;
            border: 2px solid #111111;
        }

        table.items {
            width: 100%;
            margin-top: 14px;
            border-collapse: collapse;
        }

        .items th,
        .items td {
            padding: 11px 0;
            border-bottom: 2px solid #111111;
            text-align: left;
            vertical-align: top;
        }

        .items th:last-child,
        .items td:last-child {
            width: 140px;
            text-align: right;
        }

        .items strong {
            display: block;
            font-size: 13px;
        }

        .totals {
            width: 270px;
            margin: 18px 0 0 auto;
            border-collapse: collapse;
            background: #111111;
            color: #f5efe4;
        }

        .totals td {
            padding: 8px 10px;
        }

        .totals td:last-child {
            text-align: right;
            font-weight: 700;
        }

        .totals .grand td {
            color: #ffe600;
            font-size: 16px;
            font-weight: 700;
        }

        .business-plan {
            background: #ffe600;
        }

        .business-plan h3 {
            margin: 16px 0 6px;
            font-size: 15px;
            text-transform: uppercase;
        }

        .business-plan p,
        .business-plan ul,
        .business-plan ol {
            margin: 8px 0;
        }

        .footer {
            margin-top: 18px;
            font-size: 10px;
            color: #4a463f;
        }
    </style>
</head>

<body>
    <header class="header">
        <p class="kicker">Preventivo riservato</p>
        <h1>{{ $quote->title ?: 'Proposta per '.$quote->client_name }}</h1>
        <p class="meta">{{ $quote->client_company ?: $quote->client_name }} · {{ $quote->valid_until ? 'Valido fino al '.$quote->valid_until->format('d/m/Y') : 'Validità da confermare' }}</p>
    </header>

    <table class="grid">
        <tr>
            <td>
                <div class="box">
                    <span class="label">Da</span>
                    <h2>{{ $quote->company_name }}</h2>
                    <p class="muted">{{ $quote->company_address ?: 'Indirizzo non indicato' }}</p>
                    <p class="muted">{{ $quote->company_vat ? 'P.IVA '.$quote->company_vat : 'P.IVA non indicata' }}</p>
                    <p class="muted">{{ $quote->company_email ?: 'Email non indicata' }}</p>
                    @if ($quote->company_phone)
                        <p class="muted">{{ $quote->company_phone }}</p>
                    @endif
                </div>
            </td>
            <td class="box-spacer"></td>
            <td>
                <div class="box">
                    <span class="label">Per</span>
                    <h2>{{ $quote->client_company ?: $quote->client_name }}</h2>
                    <p class="muted">{{ $quote->client_name }}</p>
                    <p class="muted">{{ $quote->client_address ?: 'Indirizzo non indicato' }}</p>
                    <p class="muted">{{ $quote->client_vat ? 'P.IVA / CF '.$quote->client_vat : 'P.IVA / CF non indicata' }}</p>
                    <p class="muted">{{ $quote->client_email ?: 'Email non indicata' }}</p>
                </div>
            </td>
        </tr>
    </table>

    <section class="section">
        <span class="label">Servizi</span>
        <table class="items">
            <thead>
                <tr>
                    <th>Dettaglio</th>
                    <th>Prezzo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quote->items as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->title }}</strong>
                            @if ($item->description)
                                <span class="muted">{{ $item->description }}</span>
                            @endif
                        </td>
                        <td>{{ $item->formattedPrice() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals">
            <tr>
                <td>Subtotale</td>
                <td>{{ \App\Models\Quote::formatMoney($quote->subtotal_cents) }}</td>
            </tr>
            <tr>
                <td>IVA</td>
                <td>{{ $quote->isVatExempt() ? 'Esente' : \App\Models\Quote::formatMoney($quote->vat_cents) }}</td>
            </tr>
            <tr class="grand">
                <td>Totale</td>
                <td>{{ \App\Models\Quote::formatMoney($quote->total_cents) }}</td>
            </tr>
        </table>
    </section>

    @if ($quote->business_plan)
        <section class="section business-plan">
            <span class="label">Business plan</span>
            {!! $quote->business_plan !!}
        </section>
    @endif

    <p class="footer">
        Documento generato da Produce a Value. Importi espressi in EUR. Il preventivo è riservato al destinatario indicato.
    </p>
</body>

</html>
