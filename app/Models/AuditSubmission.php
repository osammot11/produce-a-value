<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'brand_name',
        'website',
        'ecommerce_url',
        'role',
        'business_type',
        'market',
        'online_since',
        'product_audience',
        'average_order_value',
        'aov_range',
        'channels',
        'monthly_ad_budget',
        'monthly_ads_spend_range',
        'main_problem',
        'bottleneck',
        'monthly_revenue',
        'monthly_revenue_range',
        'conversion_rate',
        'monthly_sales',
        'monthly_orders_range',
        'ltv',
        'ads_profitability',
        'repeat_purchase_rate',
        'current_strategy',
        'goal_90_days',
        'biggest_obstacle',
        'project_budget',
        'timeline',
        'decision_maker',
        'ready_to_act',
        'notes',
        'crm_status',
        'internal_notes',
    ];

    public const CRM_STATUSES = [
        'nuovo' => 'Nuovo',
        'contattato' => 'Contattato',
        'qualificato' => 'Qualificato',
        'non_fit' => 'Non fit',
    ];

    protected function casts(): array
    {
        return [
            'channels' => 'array',
            'ready_to_act' => 'boolean',
        ];
    }
}
