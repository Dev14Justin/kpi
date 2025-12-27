<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $role = UserRole::from($data['role']);

        $user = User::create([
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'name' => $role === UserRole::Enterprise
                ? $data['company_name']
                : ($data['first_name'] . ' ' . $data['last_name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $role,
        ]);

        if ($role === UserRole::Influencer) {
            $user->influencerProfile()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'pseudo' => $data['pseudo'] ?? null,
                'niche' => $data['niche'] ?? null,
                'niche_other' => $data['niche_other'] ?? null,
                'main_platform' => $data['main_platform'],
                'profile_url' => $data['profile_url'],
            ]);
        } elseif ($role === UserRole::Enterprise) {
            $user->enterpriseProfile()->create([
                'company_name' => $data['company_name'],
                'company_email' => $data['email'],
                'industry' => $data['industry'],
                'industry_other' => $data['industry'] === 'Autre' ? ($data['industry_other'] ?? null) : null,
                'website' => $data['website'] ?? null,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('influencers.index', absolute: false));
    }
}
