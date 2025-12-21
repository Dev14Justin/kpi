<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use App\Enums\MainPlatform;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'profile_photo_path',
        'password',
        'role',
        'main_platform',
        'profile_url',
        'gender',
        'city',
        'country',
        'phone',
        'professional_title',
        'bio',
        'social_links',
        'privacy_settings',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'main_platform' => MainPlatform::class,
            'social_links' => 'array',
            'privacy_settings' => 'array',
        ];
    }

    public function hasRole(UserRole $role): bool
    {
        return $this->role === $role;
    }

    public function influencerProfile()
    {
        return $this->hasOne(InfluencerProfile::class);
    }

    public function enterpriseProfile()
    {
        return $this->hasOne(EnterpriseProfile::class);
    }

    public function isAdmin(): bool
    {
        return $this->role->isAdmin();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'admin' && $this->email === 'admin@kpihub.test';
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function participations()
    {
        return $this->belongsToMany(Campaign::class)
            ->withPivot('status')
            ->withTimestamps();
    }
}
