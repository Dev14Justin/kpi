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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->json('content_links')->nullable()->after('platforms');
            $table->json('lead_form_settings')->nullable()->after('content_links');
            $table->boolean('is_active')->default(false)->after('status');
            $table->string('slug')->unique()->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['content_links', 'lead_form_settings', 'is_active', 'slug']);
        });
    }
};
