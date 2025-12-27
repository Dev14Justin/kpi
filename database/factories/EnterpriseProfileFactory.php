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
            'company_email' => fake()->unique()->companyEmail(),
            'company_phone' => fake()->phoneNumber(),
            'company_country' => 'Sénégal',
            'company_city' => fake()->city(),
            'industry' => fake()->randomElement(['Agroalimentaire', 'Automobile', 'Banque / Assurance', 'BTP / Construction', 'Commerce / Retail', 'Communication / Médias', 'Éducation / Formation', 'Électronique / Tech', 'Énergie / Environnement', 'Finance / Conseil', 'Hôtellerie / Restauration', 'Immobilier', 'Industrie Pharmaceutique', 'Informatique / Télécoms', 'Luxe / Cosmétique', 'Mode / Textile', 'Santé / Médical', 'Services aux entreprises', 'Sport / Loisirs', 'Transport / Logistique', 'Voyage / Tourisme', 'E-commerce']),
            'description' => fake()->paragraph(),
            'website' => 'https://' . fake()->domainName(),
            'manager_first_name' => fake()->firstName(),
            'manager_last_name' => fake()->lastName(),
            'manager_phone' => fake()->phoneNumber(),
            'social_links' => [
                'linkedin' => 'https://linkedin.com/company/' . fake()->slug(),
                'twitter' => 'https://twitter.com/' . fake()->slug(),
                'facebook' => 'https://facebook.com/' . fake()->slug(),
            ],
        ];
    }
}
