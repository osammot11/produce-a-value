<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'company',
        'website',
        'role',
        'business_type',
        'market',
        'average_order_value',
        'channels',
        'monthly_ad_budget',
        'main_problem',
        'monthly_revenue',
        'conversion_rate',
        'monthly_sales',
        'ltv',
        'goal_90_days',
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
