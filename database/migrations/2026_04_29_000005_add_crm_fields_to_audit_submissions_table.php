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
            $table->string('crm_status')->default('nuovo')->after('notes');
            $table->text('internal_notes')->nullable()->after('crm_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_submissions', function (Blueprint $table) {
            $table->dropColumn(['crm_status', 'internal_notes']);
        });
    }
};
