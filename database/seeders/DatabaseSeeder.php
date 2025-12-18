<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\MainPlatform;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Supprime tous les utilisateurs sauf l'Admin
        User::where('role', '!=', UserRole::Admin)
            ->where('email', '!=', 'admin@kpihub.test') // Sécurité supplémentaire
            ->delete();

        // 4 Standard Users
        User::factory(4)->create([
            'role' => UserRole::User,
        ]);

        // 4 Influencers
        User::factory(4)->influencer()->create([
            'main_platform' => MainPlatform::Tiktok,
        ])->each(function (User $user) {
            \App\Models\InfluencerProfile::factory()->create(['user_id' => $user->id]);
        });

        // 4 Enterprises
        User::factory(4)->create([
            'role' => UserRole::Enterprise,
        ])->each(function (User $user) {
            \App\Models\EnterpriseProfile::factory()->create(['user_id' => $user->id]);
        });

        // S'assurer que l'Admin existe toujours
        if (!User::where('role', UserRole::Admin)->exists()) {
            User::factory()->create([
                'first_name' => 'Admin',
                'last_name' => 'KpiHub',
                'name' => 'Admin KpiHub',
                'email' => 'admin@kpihub.test',
                'password' => \Illuminate\Support\Facades\Hash::make('passwordadmin'),
                'role' => UserRole::Admin,
            ]);
        }
    }
}
