<?php

namespace App\Http\Requests\Auth;

use App\Enums\MainPlatform;
use App\Enums\UserRole;
use App\Models\User;
use App\Rules\ValidPlatformProfileUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                Rule::requiredIf(fn() => $this->input('role') !== UserRole::Enterprise->value),
                'nullable',
                'string',
                'max:255',
            ],
            'last_name' => [
                Rule::requiredIf(fn() => $this->input('role') !== UserRole::Enterprise->value),
                'nullable',
                'string',
                'max:255',
            ],
            'company_name' => [
                Rule::requiredIf(fn() => $this->input('role') === UserRole::Enterprise->value),
                'nullable',
                'string',
                'max:255',
            ],
            'industry' => [
                Rule::requiredIf(fn() => $this->input('role') === UserRole::Enterprise->value),
                'nullable',
                'string',
                'max:255',
            ],
            'industry_other' => [
                Rule::requiredIf(fn() => $this->input('role') === UserRole::Enterprise->value && $this->input('industry') === 'Autre'),
                'nullable',
                'string',
                'max:255',
            ],
            'website' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => [
                'nullable',
                'string',
                Rule::in(UserRole::values()),
            ],
            'main_platform' => [
                'nullable',
                Rule::requiredIf(fn() => $this->input('role') === UserRole::Influencer->value),
                'string',
                Rule::in(MainPlatform::values()),
            ],
            'profile_url' => [
                'nullable',
                Rule::requiredIf(fn() => $this->input('role') === UserRole::Influencer->value),
                'string',
                'max:255',
                new ValidPlatformProfileUrl($this->all()),
            ],
            'pseudo' => [
                Rule::requiredIf(fn() => $this->input('role') === UserRole::Influencer->value),
                'nullable',
                'string',
                'max:255',
            ],
            'niche' => [
                Rule::requiredIf(fn() => $this->input('role') === UserRole::Influencer->value),
                'nullable',
                'string',
                'max:255',
            ],
            'niche_other' => [
                Rule::requiredIf(fn() => $this->input('role') === UserRole::Influencer->value && $this->input('niche') === 'Autre'),
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'role' => $this->input('role') ?: UserRole::default()->value,
            'main_platform' => $this->input('main_platform'),
            'profile_url' => $this->input('profile_url'),
        ]);
    }
}
