<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EnterpriseProfile>
 */
class EnterpriseProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'company_email' => fake()->companyEmail(),
            'company_phone' => fake()->phoneNumber(),
            'company_country' => fake()->country(),
            'company_city' => fake()->city(),
            'industry' => fake()->bs(),
            'description' => fake()->catchPhrase(),
            'website' => fake()->url(),
            'social_links' => [
                'linkedin' => 'https://linkedin.com/company/' . fake()->slug(),
                'twitter' => 'https://twitter.com/' . fake()->slug(),
            ],
        ];
    }
}
