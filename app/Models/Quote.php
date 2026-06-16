<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quote extends Model
{
    public const VAT_TYPE_STANDARD = '22';
    public const VAT_TYPE_EXEMPT = 'exempt';

    protected $fillable = [
        'title',
        'slug',
        'status',
        'valid_until',
        'company_name',
        'company_vat',
        'company_email',
        'company_phone',
        'company_address',
        'company_website',
        'client_name',
        'client_company',
        'client_email',
        'client_phone',
        'client_vat',
        'client_address',
        'business_plan',
        'vat_type',
        'subtotal_cents',
        'vat_cents',
        'total_cents',
    ];

    protected function casts(): array
    {
        return [
            'valid_until' => 'date',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class)->orderBy('sort_order');
    }

    public function isVatExempt(): bool
    {
        return $this->vat_type === self::VAT_TYPE_EXEMPT;
    }

    public function publicUrl(): string
    {
        return route('quotes.show', $this);
    }

    public static function formatMoney(int $cents): string
    {
        return '€ '.number_format($cents / 100, 2, ',', '.');
    }
}
