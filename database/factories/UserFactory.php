<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Enums\MainPlatform;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'profile_photo_path' => 'https://ui-avatars.com/api/?name=' . urlencode(fake()->name()) . '&color=7F9CF5&background=EBF4FF',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => UserRole::default(),
            'main_platform' => null,
            'profile_url' => null,
            'gender' => fake()->randomElement(['male', 'female']),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'phone' => fake()->phoneNumber(),
            'professional_title' => fake()->jobTitle(),
            'bio' => fake()->paragraph(),
            'social_links' => [
                'tiktok' => 'https://tiktok.com/@' . fake()->userName(),
                'instagram' => 'https://instagram.com/' . fake()->userName(),
            ],
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function influencer(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => UserRole::Influencer,
            'main_platform' => MainPlatform::Tiktok,
            'profile_url' => 'https://www.tiktok.com/@' . Str::slug(fake()->userName()),
        ]);
    }

    public function brand(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => UserRole::Brand,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => UserRole::Admin,
        ]);
    }

    public function superAdmin(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => UserRole::Superadmin,
        ]);
    }
}
