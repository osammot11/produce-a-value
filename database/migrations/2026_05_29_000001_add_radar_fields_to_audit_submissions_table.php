<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('audit_submissions', function (Blueprint $table) {
            $table->string('brand_name')->nullable()->after('company');
            $table->string('ecommerce_url')->nullable()->after('website');
            $table->string('online_since')->nullable()->after('ecommerce_url');
            $table->text('product_audience')->nullable()->after('online_since');
            $table->string('monthly_revenue_range')->nullable()->after('product_audience');
            $table->string('monthly_ads_spend_range')->nullable()->after('monthly_revenue_range');
            $table->string('aov_range')->nullable()->after('monthly_ads_spend_range');
            $table->string('ads_profitability')->nullable()->after('aov_range');
            $table->string('monthly_orders_range')->nullable()->after('ads_profitability');
            $table->string('repeat_purchase_rate')->nullable()->after('monthly_orders_range');
            $table->string('current_strategy')->nullable()->after('repeat_purchase_rate');
            $table->string('bottleneck')->nullable()->after('current_strategy');
            $table->text('biggest_obstacle')->nullable()->after('goal_90_days');
            $table->string('phone')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_submissions', function (Blueprint $table) {
            $table->dropColumn([
                'brand_name',
                'ecommerce_url',
                'online_since',
                'product_audience',
                'monthly_revenue_range',
                'monthly_ads_spend_range',
                'aov_range',
                'ads_profitability',
                'monthly_orders_range',
                'repeat_purchase_rate',
                'current_strategy',
                'bottleneck',
                'biggest_obstacle',
                'phone',
            ]);
        });
    }
};
