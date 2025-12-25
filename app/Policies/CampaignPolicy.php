<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\User;
use App\Enums\UserRole;

class CampaignPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Campaign $campaign): bool
    {
        // Creator can view
        if ($user->id === $campaign->user_id) {
            return true;
        }

        // Invited enterprises can view
        return $campaign->participants->contains($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role !== UserRole::Enterprise;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Campaign $campaign): bool
    {
        // Creator can update
        if ($user->id === $campaign->user_id) {
            return true;
        }

        // Accepted influencers can also update
        return $user->role === UserRole::Influencer &&
            $campaign->participants()
            ->where('user_id', $user->id)
            ->wherePivot('status', 'accepted')
            ->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Campaign $campaign): bool
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can manage participants.
     */
    public function manageParticipants(User $user, Campaign $campaign): bool
    {
        // Only owner can invite/remove people
        return $user->id === $campaign->user_id;
    }
}
