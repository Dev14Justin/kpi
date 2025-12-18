<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display a public profile.
     */
    public function publicShow(User $user): View
    {
        return view('profile.public', [
            'user' => $user,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        // Handle profile photo upload
        if ($request->hasFile('profile_photo_path')) {
            $path = $request->file('profile_photo_path')->store('profile-photos', 'public');
            $validated['profile_photo_path'] = $path;
        }

        // Synchronize 'name' with first_name and last_name
        if (isset($validated['first_name']) && isset($validated['last_name'])) {
            $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Handle Role Specific Data
        if ($user->role === \App\Enums\UserRole::Influencer) {
            $user->influencerProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'pseudo' => $validated['pseudo'] ?? null,
                    'niche' => $validated['niche'] ?? null,
                    'niche_other' => $validated['niche_other'] ?? null,
                    'social_links' => $validated['influencer_social_links'] ?? null,
                ]
            );
        } elseif ($user->role === \App\Enums\UserRole::Enterprise) {
            $user->enterpriseProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'company_name' => $validated['company_name'] ?? null,
                    'company_email' => $validated['company_email'] ?? null,
                    'company_phone' => $validated['company_phone'] ?? null,
                    'company_country' => $validated['company_country'] ?? null,
                    'company_city' => $validated['company_city'] ?? null,
                    'industry' => $validated['industry'] ?? null,
                    'description' => $validated['description'] ?? null,
                    'website' => $validated['website'] ?? null,
                    'social_links' => $validated['enterprise_social_links'] ?? null,
                ]
            );
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
