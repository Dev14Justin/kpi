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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'user',
                'influencer',
                'enterprise',
                'admin',
            ])->default('user')->index()->after('email');

            $table->enum('main_platform', [
                'tiktok',
                'instagram',
                'youtube',
                'linkedin',
            ])->nullable()->after('role')->index();

            $table->string('profile_url')->nullable()->after('main_platform');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['profile_url', 'main_platform', 'role']);
        });
    }
};
