<?php

namespace App\Enums;

enum UserRole: string
{
    case User = 'user';
    case Influencer = 'influencer';
    case Enterprise = 'enterprise';
    case Admin = 'admin';

    public static function default(): self
    {
        return self::User;
    }

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function isAdmin(): bool
    {
        return $this === self::Admin;
    }

    public function label(): string
    {
        return match ($this) {
            self::User => 'Utilisateur',
            self::Influencer => 'Influenceur',
            self::Enterprise => 'Entreprise',
            self::Admin => 'Admin',
        };
    }
}
