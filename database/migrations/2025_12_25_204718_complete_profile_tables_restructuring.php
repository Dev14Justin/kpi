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
            $table->string('gender')->nullable()->after('email');
            $table->string('professional_title')->nullable()->after('gender');
            $table->string('country')->nullable()->after('professional_title');
            $table->string('city')->nullable()->after('country');
            $table->string('phone')->nullable()->after('city');
            $table->text('bio')->nullable()->after('phone');
        });

        Schema::table('enterprise_profiles', function (Blueprint $table) {
            $table->string('manager_first_name')->nullable()->after('user_id');
            $table->string('manager_last_name')->nullable()->after('manager_first_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('influencer_profiles', function (Blueprint $table) {
            $table->dropColumn(['gender', 'professional_title', 'country', 'city', 'phone', 'bio']);
        });

        Schema::table('enterprise_profiles', function (Blueprint $table) {
            $table->dropColumn(['manager_first_name', 'manager_last_name']);
        });
    }
};
