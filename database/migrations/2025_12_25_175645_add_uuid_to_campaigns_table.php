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
            $table->uuid('uuid')->after('id')->nullable()->unique();
        });

        // Populate existing campaigns with UUIDs
        \App\Models\Campaign::all()->each(function ($campaign) {
            $campaign->uuid = (string) \Illuminate\Support\Str::uuid();
            $campaign->save();
        });

        // After populating, make it NOT NULL (optional, but good for data integrity if you want)
        // Note: For SQLite or some DBs, changing to NOT NULL might require more steps, 
        // but for now, we'll keep it nullable or just mark it as unique.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
