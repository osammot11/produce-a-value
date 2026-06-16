<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminQuoteController extends Controller
{
    public function index(): View
    {
        return view('admin.quotes.index', [
            'quotes' => Quote::withCount('items')->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        $quote = new Quote(array_merge($this->companyDefaults(), [
            'status' => 'draft',
            'vat_type' => Quote::VAT_TYPE_STANDARD,
            'valid_until' => now()->addDays(15)->toDateString(),
        ]));

        return view('admin.quotes.create', [
            'quote' => $quote,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        [$data, $items] = $this->validatedPayload($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'] ?: $data['client_name']);
        $data = array_merge($data, $this->totalsFor($items, $data['vat_type']));

        $quote = Quote::create($data);
        $this->syncItems($quote, $items);

        return redirect()
            ->route('admin.quotes.show', $quote)
            ->with('status', 'Preventivo creato.');
    }

    public function show(Quote $quote): View
    {
        return view('admin.quotes.show', [
            'quote' => $quote->load('items'),
        ]);
    }

    public function edit(Quote $quote): View
    {
        return view('admin.quotes.edit', [
            'quote' => $quote->load('items'),
        ]);
    }

    public function update(Request $request, Quote $quote): RedirectResponse
    {
        [$data, $items] = $this->validatedPayload($request, $quote);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'] ?: $data['client_name'], $quote);
        $data = array_merge($data, $this->totalsFor($items, $data['vat_type']));

        $quote->update($data);
        $this->syncItems($quote, $items);

        return redirect()
            ->route('admin.quotes.show', $quote)
            ->with('status', 'Preventivo aggiornato.');
    }

    public function destroy(Quote $quote): RedirectResponse
    {
        $quote->delete();

        return redirect()
            ->route('admin.quotes.index')
            ->with('status', 'Preventivo eliminato.');
    }

    /**
     * @return array{0: array<string, mixed>, 1: array<int, array<string, mixed>>}
     */
    private function validatedPayload(Request $request, ?Quote $quote = null): array
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:180'],
            'slug' => [
                'nullable',
                'string',
                'max:180',
                Rule::unique('quotes', 'slug')->ignore($quote?->id),
            ],
            'status' => ['required', Rule::in(['draft', 'sent', 'accepted', 'archived'])],
            'valid_until' => ['nullable', 'date'],
            'company_name' => ['required', 'string', 'max:180'],
            'company_vat' => ['nullable', 'string', 'max:80'],
            'company_email' => ['nullable', 'email', 'max:160'],
            'company_phone' => ['nullable', 'string', 'max:80'],
            'company_address' => ['nullable', 'string', 'max:255'],
            'company_website' => ['nullable', 'string', 'max:180'],
            'client_name' => ['required', 'string', 'max:180'],
            'client_company' => ['nullable', 'string', 'max:180'],
            'client_email' => ['nullable', 'email', 'max:160'],
            'client_phone' => ['nullable', 'string', 'max:80'],
            'client_vat' => ['nullable', 'string', 'max:80'],
            'client_address' => ['nullable', 'string', 'max:255'],
            'business_plan' => ['nullable', 'string', 'max:20000'],
            'vat_type' => ['required', Rule::in([Quote::VAT_TYPE_STANDARD, Quote::VAT_TYPE_EXEMPT])],
            'items' => ['required', 'array', 'min:1'],
            'items.*.title' => ['required', 'string', 'max:180'],
            'items.*.description' => ['nullable', 'string', 'max:1200'],
            'items.*.price' => ['required', 'string', 'max:40', 'regex:/^[\d\s.,€]+$/u'],
        ]);

        $items = collect($data['items'])
            ->values()
            ->map(function (array $item, int $index): array {
                return [
                    'title' => $item['title'],
                    'description' => $item['description'] ?? null,
                    'price_cents' => $this->moneyToCents($item['price']),
                    'sort_order' => $index,
                ];
            })
            ->all();

        unset($data['items']);
        $data['business_plan'] = $this->cleanRichText($data['business_plan'] ?? null);

        return [$data, $items];
    }

    /**
     * @param array<int, array<string, mixed>> $items
     * @return array{subtotal_cents: int, vat_cents: int, total_cents: int}
     */
    private function totalsFor(array $items, string $vatType): array
    {
        $subtotal = collect($items)->sum('price_cents');
        $vat = $vatType === Quote::VAT_TYPE_STANDARD ? (int) round($subtotal * 0.22) : 0;

        return [
            'subtotal_cents' => $subtotal,
            'vat_cents' => $vat,
            'total_cents' => $subtotal + $vat,
        ];
    }

    /**
     * @param array<int, array<string, mixed>> $items
     */
    private function syncItems(Quote $quote, array $items): void
    {
        $quote->items()->delete();

        foreach ($items as $item) {
            $quote->items()->create($item);
        }
    }

    private function moneyToCents(string $value): int
    {
        $clean = preg_replace('/[^\d,.\-]/', '', trim($value)) ?: '0';

        if (str_contains($clean, ',') && str_contains($clean, '.')) {
            $clean = str_replace('.', '', $clean);
            $clean = str_replace(',', '.', $clean);
        } elseif (str_contains($clean, ',')) {
            $clean = str_replace(',', '.', $clean);
        }

        return max(0, (int) round(((float) $clean) * 100));
    }

    private function cleanRichText(?string $html): ?string
    {
        if (! $html) {
            return null;
        }

        $html = strip_tags($html, '<p><br><strong><b><em><i><ul><ol><li><h2><h3><a>');

        return trim($html) ?: null;
    }

    /**
     * @return array<string, string|null>
     */
    private function companyDefaults(): array
    {
        return [
            'company_name' => config('quotes.company.name'),
            'company_vat' => config('quotes.company.vat'),
            'company_email' => config('quotes.company.email'),
            'company_phone' => config('quotes.company.phone'),
            'company_address' => config('quotes.company.address'),
            'company_website' => config('quotes.company.website'),
        ];
    }

    private function uniqueSlug(string $value, ?Quote $quote = null): string
    {
        $baseSlug = Str::slug($value) ?: Str::random(10);
        $slug = $baseSlug;
        $index = 2;

        while (Quote::where('slug', $slug)->when($quote, function ($query) use ($quote) {
            $query->whereKeyNot($quote->id);
        })->exists()) {
            $slug = $baseSlug.'-'.$index;
            $index++;
        }

        return $slug;
    }
}
