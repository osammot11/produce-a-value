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
            $table->unsignedTinyInteger('radar_score')->nullable()->after('biggest_obstacle');
            $table->json('radar_scores')->nullable()->after('radar_score');
            $table->string('radar_profile')->nullable()->after('radar_scores');
            $table->string('radar_priority')->nullable()->after('radar_profile');
            $table->text('radar_summary')->nullable()->after('radar_priority');
            $table->json('radar_recommendations')->nullable()->after('radar_summary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_submissions', function (Blueprint $table) {
            $table->dropColumn([
                'radar_score',
                'radar_scores',
                'radar_profile',
                'radar_priority',
                'radar_summary',
                'radar_recommendations',
            ]);
        });
    }
};
