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
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'name' => $firstName . ' ' . $lastName,
            'email' => fake()->unique()->safeEmail(),
            'profile_photo_path' => null,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => UserRole::default(),
            'main_platform' => null,
            'profile_url' => null,
            'gender' => fake()->randomElement(['male', 'female']),
            'city' => fake()->city(),
            'country' => 'Sénégal',
            'phone' => fake()->phoneNumber(),
            'professional_title' => fake()->jobTitle(),
            'bio' => fake()->paragraph(),
            'social_links' => [
                'tiktok' => 'https://tiktok.com/@' . fake()->userName(),
                'instagram' => 'https://instagram.com/' . fake()->userName(),
                'facebook' => 'https://facebook.com/' . fake()->userName(),
            ],
            'remember_token' => Str::random(10),
            'privacy_settings' => [
                'show_email' => true,
                'show_phone' => true,
                'show_location' => true,
                'show_social' => true,
                'show_bio' => true,
                'show_professional_title' => true,
            ],
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

    public function enterprise(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => UserRole::Enterprise,
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
