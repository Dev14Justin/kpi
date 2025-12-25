<?php

namespace App\Enums;

enum ContentType: string
{
    case Video = 'video';
    case Visuel = 'visuel';
    case Texte = 'texte';
    case Article = 'article';
    case Podcast = 'podcast';

    public function label(): string
    {
        return match ($this) {
            self::Video => 'Vidéo',
            self::Visuel => 'Visuel',
            self::Texte => 'Texte',
            self::Article => 'Article (texte et visuel)',
            self::Podcast => 'Podcast',
        };
    }

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
