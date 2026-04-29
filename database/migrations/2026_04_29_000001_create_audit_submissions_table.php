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
        Schema::create('audit_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('company');
            $table->string('website')->nullable();
            $table->string('role')->nullable();
            $table->string('business_type');
            $table->string('market')->nullable();
            $table->string('average_order_value')->nullable();
            $table->json('channels')->nullable();
            $table->string('monthly_ad_budget')->nullable();
            $table->string('main_problem');
            $table->string('monthly_revenue')->nullable();
            $table->string('conversion_rate')->nullable();
            $table->string('monthly_sales')->nullable();
            $table->string('ltv')->nullable();
            $table->text('goal_90_days');
            $table->string('project_budget');
            $table->string('timeline');
            $table->string('decision_maker');
            $table->boolean('ready_to_act')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_submissions');
    }
};
