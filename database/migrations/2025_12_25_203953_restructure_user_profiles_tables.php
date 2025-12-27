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
        Schema::table('influencer_profiles', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('user_id');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('email')->nullable()->after('last_name');
            $table->string('main_platform')->nullable()->after('pseudo');
            $table->string('profile_url')->nullable()->after('main_platform');
        });

        Schema::table('enterprise_profiles', function (Blueprint $table) {
            $table->string('manager_phone')->nullable()->after('company_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('influencer_profiles', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'email', 'main_platform', 'profile_url']);
        });

        Schema::table('enterprise_profiles', function (Blueprint $table) {
            $table->dropColumn(['manager_phone']);
        });
    }
};
