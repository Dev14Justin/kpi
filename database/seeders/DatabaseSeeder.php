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
        // 4 Standard Users
        User::factory(4)->create([
            'role' => UserRole::User,
        ]);

        // 4 Influencers
        User::factory(4)->create([
            'role' => UserRole::Influencer,
            'main_platform' => MainPlatform::Tiktok,
            'profile_url' => fn() => 'https://www.tiktok.com/@' . fake()->userName(),
        ])->each(function (User $user) {
            \App\Models\InfluencerProfile::factory()->create(['user_id' => $user->id]);
        });

        // 4 Enterprises
        User::factory(4)->create([
            'role' => UserRole::Enterprise,
        ])->each(function (User $user) {
            \App\Models\EnterpriseProfile::factory()->create(['user_id' => $user->id]);
        });

        // Keep Admin
        if (!User::where('email', 'admin@kpihub.test')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@kpihub.test',
                'password' => 'passwordadmin',
                'role' => UserRole::Admin,
            ]);
        }
    }
}
