<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InfluencerProfile>
 */
class InfluencerProfileFactory extends Factory
{
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
            'email' => fake()->unique()->safeEmail(),
            'pseudo' => fake()->userName(),
            'gender' => fake()->randomElement(['male', 'female']),
            'professional_title' => fake()->randomElement(['Créateur de contenu', 'Vloggeur', 'Photographe', 'Globe-trotter', 'Expert Fitness']),
            'country' => 'Sénégal',
            'city' => fake()->city(),
            'phone' => fake()->phoneNumber(),
            'bio' => fake()->paragraph(),
            'niche' => fake()->randomElement(['Education', 'Humour/Comédie', 'Cuisine/Food', 'Art/Design', 'Technologie', 'Voyage', 'Mode/Beauté', 'Fitness/Sport', 'Gaming']),
            'niche_other' => null,
            'main_platform' => fake()->randomElement(\App\Enums\MainPlatform::cases()),
            'profile_url' => 'https://' . fake()->randomElement(['tiktok.com/@', 'instagram.com/', 'youtube.com/@']) . fake()->userName(),
            'social_links' => [
                'tiktok' => 'https://tiktok.com/@' . fake()->userName(),
                'instagram' => 'https://instagram.com/' . fake()->userName(),
                'youtube' => 'https://youtube.com/@' . fake()->userName(),
                'facebook' => 'https://facebook.com/' . fake()->userName(),
            ],
        ];
    }
}
