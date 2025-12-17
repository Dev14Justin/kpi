<?php

namespace App\Enums;

enum MainPlatform: string
{
    case Tiktok = 'tiktok';
    case Instagram = 'instagram';
    case Youtube = 'youtube';
    case Linkedin = 'linkedin';

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::Tiktok => 'TikTok',
            self::Instagram => 'Instagram',
            self::Youtube => 'YouTube',
            self::Linkedin => 'LinkedIn',
        };
    }
}
