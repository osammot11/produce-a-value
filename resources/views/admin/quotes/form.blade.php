@php
    $quoteItems = old('items');

    if (! is_array($quoteItems)) {
        $quoteItems = $quote->exists
            ? $quote->items->map(fn ($item) => [
                'title' => $item->title,
                'description' => $item->description,
                'price' => number_format($item->price_cents / 100, 2, ',', '.'),
            ])->all()
            : [['title' => '', 'description' => '', 'price' => '']];
    }
@endphp

@if ($errors->any())
    <div class="admin-error-brutal admin-form-field-wide">
        Controlla i campi: ci sono dati mancanti o non validi.
    </div>
@endif

<div class="admin-form-grid">
    <section class="admin-form-section">
        <h2>Documento</h2>
        <label>Titolo
            <input type="text" name="title" value="{{ old('title', $quote->title) }}" placeholder="Es. Funnel e CRO per Acme">
        </label>

        <label>Slug
            <input type="text" name="slug" value="{{ old('slug', $quote->slug) }}" placeholder="Generato automaticamente se vuoto">
        </label>

        <label>Status
            <select name="status" required>
                @foreach (['draft' => 'Bozza', 'sent' => 'Inviato', 'accepted' => 'Accettato', 'archived' => 'Archiviato'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $quote->status ?: 'draft') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>

        <label>Valido fino al
            <input type="date" name="valid_until" value="{{ old('valid_until', $quote->valid_until?->format('Y-m-d') ?: $quote->valid_until) }}">
        </label>
    </section>

    <section class="admin-form-section">
        <h2>Dati Produce a Value</h2>
        <label>Ragione sociale / nome
            <input type="text" name="company_name" value="{{ old('company_name', $quote->company_name) }}" required>
        </label>

        <label>P.IVA
            <input type="text" name="company_vat" value="{{ old('company_vat', $quote->company_vat) }}">
        </label>

        <label>Email
            <input type="email" name="company_email" value="{{ old('company_email', $quote->company_email) }}">
        </label>

        <label>Telefono
            <input type="text" name="company_phone" value="{{ old('company_phone', $quote->company_phone) }}">
        </label>

        <label class="admin-form-field-wide">Indirizzo
            <input type="text" name="company_address" value="{{ old('company_address', $quote->company_address) }}">
        </label>

        <label class="admin-form-field-wide">Sito
            <input type="text" name="company_website" value="{{ old('company_website', $quote->company_website) }}">
        </label>
    </section>

    <section class="admin-form-section">
        <h2>Cliente</h2>
        <label>Nome referente
            <input type="text" name="client_name" value="{{ old('client_name', $quote->client_name) }}" required>
        </label>

        <label>Azienda cliente
            <input type="text" name="client_company" value="{{ old('client_company', $quote->client_company) }}">
        </label>

        <label>Email
            <input type="email" name="client_email" value="{{ old('client_email', $quote->client_email) }}">
        </label>

        <label>Telefono
            <input type="text" name="client_phone" value="{{ old('client_phone', $quote->client_phone) }}">
        </label>

        <label>P.IVA / CF
            <input type="text" name="client_vat" value="{{ old('client_vat', $quote->client_vat) }}">
        </label>

        <label>Indirizzo
            <input type="text" name="client_address" value="{{ old('client_address', $quote->client_address) }}">
        </label>
    </section>

    <section class="admin-form-section">
        <h2>IVA</h2>
        <div class="admin-toggle-group">
            <label>
                <input type="radio" name="vat_type" value="22" @checked(old('vat_type', $quote->vat_type ?: '22') === '22')>
                <span>IVA 22%</span>
            </label>
            <label>
                <input type="radio" name="vat_type" value="exempt" @checked(old('vat_type', $quote->vat_type) === 'exempt')>
                <span>Esente IVA</span>
            </label>
        </div>
    </section>

    <section class="admin-form-section admin-form-field-wide" data-quote-items>
        <div class="admin-section-heading">
            <h2>Servizi e prezzi</h2>
            <button class="admin-danger-button" type="button" data-add-quote-item>Aggiungi servizio</button>
        </div>

        <div class="admin-repeater" data-quote-items-list>
            @foreach ($quoteItems as $index => $item)
                <div class="admin-repeater-row" data-quote-item>
                    <label>Titolo servizio
                        <input type="text" name="items[{{ $index }}][title]" value="{{ $item['title'] ?? '' }}" required>
                    </label>
                    <label>Prezzo
                        <input type="text" name="items[{{ $index }}][price]" value="{{ $item['price'] ?? '' }}" placeholder="1200,00" required inputmode="decimal">
                    </label>
                    <label class="admin-form-field-wide">Descrizione opzionale
                        <textarea name="items[{{ $index }}][description]" rows="3">{{ $item['description'] ?? '' }}</textarea>
                    </label>
                    <button class="admin-danger-button" type="button" data-remove-quote-item>Rimuovi servizio</button>
                </div>
            @endforeach
        </div>

        <template data-quote-item-template>
            <div class="admin-repeater-row" data-quote-item>
                <label>Titolo servizio
                    <input type="text" name="items[__INDEX__][title]" required>
                </label>
                <label>Prezzo
                    <input type="text" name="items[__INDEX__][price]" placeholder="1200,00" required inputmode="decimal">
                </label>
                <label class="admin-form-field-wide">Descrizione opzionale
                    <textarea name="items[__INDEX__][description]" rows="3"></textarea>
                </label>
                <button class="admin-danger-button" type="button" data-remove-quote-item>Rimuovi servizio</button>
            </div>
        </template>
    </section>

    <section class="admin-form-section admin-form-field-wide">
        <h2>Business plan opzionale</h2>
        <div class="admin-richtext-toolbar" aria-label="Toolbar business plan">
            <button type="button" data-richtext-command="bold">B</button>
            <button type="button" data-richtext-command="italic">I</button>
            <button type="button" data-richtext-command="insertUnorderedList">Lista</button>
            <button type="button" data-richtext-format="h3">H3</button>
            <button type="button" data-richtext-format="p">P</button>
        </div>
        <input type="hidden" name="business_plan" value="{{ old('business_plan', $quote->business_plan) }}" data-richtext-source>
        <div class="admin-richtext-area" contenteditable="true" data-richtext-input>{!! old('business_plan', $quote->business_plan) !!}</div>
    </section>

    <div class="admin-form-actions">
        <a class="admin-danger-button" href="{{ route('admin.quotes.index') }}">Annulla</a>
        <button class="brutal-button" type="submit">Salva preventivo</button>
    </div>
</div>
