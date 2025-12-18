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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => [
                'nullable',
                'string',
                Rule::in([
                    UserRole::User->value,
                    UserRole::Influencer->value,
                    UserRole::Enterprise->value
                ]),
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
