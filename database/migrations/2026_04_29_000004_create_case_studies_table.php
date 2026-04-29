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
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client_name');
            $table->string('industry')->nullable();
            $table->string('service');
            $table->text('summary');
            $table->text('challenge');
            $table->text('solution');
            $table->text('result');
            $table->string('metric_one_label')->nullable();
            $table->string('metric_one_value')->nullable();
            $table->string('metric_two_label')->nullable();
            $table->string('metric_two_value')->nullable();
            $table->string('metric_three_label')->nullable();
            $table->string('metric_three_value')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};
