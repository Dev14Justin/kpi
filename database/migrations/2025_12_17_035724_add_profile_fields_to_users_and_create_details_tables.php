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
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('professional_title')->nullable();
            $table->text('bio')->nullable();
            $table->json('social_links')->nullable();
        });

        Schema::create('influencer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('pseudo')->nullable();
            $table->string('niche')->nullable();
            $table->string('niche_other')->nullable();
            $table->timestamps();
        });

        Schema::create('enterprise_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_city')->nullable();
            $table->string('industry')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->json('social_links')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enterprise_profiles');
        Schema::dropIfExists('influencer_profiles');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'city', 'country', 'phone', 'professional_title', 'bio', 'social_links']);
        });
    }
};
