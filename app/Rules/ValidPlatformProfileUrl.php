<?php

namespace App\Rules;

use App\Enums\MainPlatform;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class ValidPlatformProfileUrl implements ValidationRule
{
    /**
     * @param array<string, string|null> $data
     */
    public function __construct(
        private readonly array $data
    ) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $platform = Arr::get($this->data, 'main_platform');
        $url = (string) $value;

        // Using Enum values for keys if possible, or fallback strings matching the enum values
        $patterns = [
            'tiktok' => '#^https://www\\.tiktok\\.com/@[\\w\\.-]+/?$#i',
            'instagram' => '#^https://(www\\.)?instagram\\.com/[A-Za-z0-9._]+/?$#i',
            'youtube' => '#^https://(www\\.)?youtube\\.com/(@[A-Za-z0-9._-]+|channel/[A-Za-z0-9_-]+)(/.*)?$#i',
            'linkedin' => '#^https://(www\\.)?linkedin\\.com/in/[A-Za-z0-9_-]+/?$#i',
        ];

        // If MainPlatform enum exists, we could use MainPlatform::Tiktok->value, etc.
        // For safety, checking if the platform key exists in patterns.

        if (! isset($patterns[$platform])) {
            // If platform is not in the list (or not selected), we might skip specific URL regex 
            // or fail if it was required. Since 'main_platform' has its own 'required' rule, we can skip if null.
            if (!$platform) return;

            // If platform is selected but unknown?
            // usually handled by validation 'in:...' rules on the platform field itself.
            return;
        }

        if (! preg_match($patterns[$platform], $url)) {
            $fail('Le lien de profil ne correspond pas au format attendu pour la plateforme sélectionnée.');
        }
    }
}
