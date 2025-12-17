<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            // Common Info
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'professional_title' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'social_links' => ['nullable', 'array'],
            'social_links.tiktok' => ['nullable', 'url'],
            'social_links.instagram' => ['nullable', 'url'],
            'social_links.youtube' => ['nullable', 'url'],
            'social_links.linkedin' => ['nullable', 'url'],
            'social_links.twitter' => ['nullable', 'url'],

            // Legacy fields (optional, keep if used)
            'main_platform' => ['nullable', 'string'],
            'profile_url' => ['nullable', 'url'],

            // Influencer Specific
            'pseudo' => ['nullable', 'string', 'max:255'],
            'niche' => ['nullable', 'string', 'max:255'],
            'niche_other' => ['nullable', 'string', 'max:255'],

            // Enterprise Specific
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_email' => ['nullable', 'email', 'max:255'],
            'company_phone' => ['nullable', 'string', 'max:20'],
            'company_country' => ['nullable', 'string', 'max:255'],
            'company_city' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'website' => ['nullable', 'url', 'max:255'],
            // Reuse social_links array structure for enterprise if needed, or mapped fields
        ];
    }
}
