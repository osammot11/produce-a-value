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
        Schema::table('case_studies', function (Blueprint $table) {
            $table->string('visual_image')->nullable()->after('status');
            $table->string('visual_label')->nullable()->after('visual_image');
            $table->string('visual_caption')->nullable()->after('visual_label');
            $table->text('before_state')->nullable()->after('visual_caption');
            $table->text('after_state')->nullable()->after('before_state');
            $table->text('problems_solved')->nullable()->after('after_state');
            $table->text('testimonial_quote')->nullable()->after('problems_solved');
            $table->string('testimonial_author')->nullable()->after('testimonial_quote');
            $table->string('testimonial_role')->nullable()->after('testimonial_author');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_studies', function (Blueprint $table) {
            $table->dropColumn([
                'visual_image',
                'visual_label',
                'visual_caption',
                'before_state',
                'after_state',
                'problems_solved',
                'testimonial_quote',
                'testimonial_author',
                'testimonial_role',
            ]);
        });
    }
};
