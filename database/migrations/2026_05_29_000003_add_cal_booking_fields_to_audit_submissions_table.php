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
            $table->unsignedBigInteger('cal_booking_id')->nullable()->after('radar_recommendations');
            $table->string('cal_booking_uid')->nullable()->after('cal_booking_id');
            $table->string('cal_booking_status')->nullable()->after('cal_booking_uid');
            $table->timestamp('cal_booking_start_at')->nullable()->after('cal_booking_status');
            $table->timestamp('cal_booking_end_at')->nullable()->after('cal_booking_start_at');
            $table->json('cal_booking_payload')->nullable()->after('cal_booking_end_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_submissions', function (Blueprint $table) {
            $table->dropColumn([
                'cal_booking_id',
                'cal_booking_uid',
                'cal_booking_status',
                'cal_booking_start_at',
                'cal_booking_end_at',
                'cal_booking_payload',
            ]);
        });
    }
};
