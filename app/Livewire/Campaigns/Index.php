<?php

namespace App\Livewire\Campaigns;

use App\Enums\UserRole;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showCreateModal = false;

    // Form inputs
    public $title = '';

    public $short_description = '';

    public $content_type = '';

    public $platforms = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'short_description' => 'required|string|max:255',
        'content_type' => 'required|string',
        'platforms' => 'required|array|min:1',
    ];

    public function openCreateModal()
    {
        $this->reset(['title', 'short_description', 'content_type', 'platforms']);
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
    }

    public function save()
    {
        // Check authorization
        if (Auth::user()->role === UserRole::Enterprise) {
            session()->flash('error', 'Les entreprises ne peuvent pas créer de campagnes.');

            return;
        }

        $this->validate();

        Auth::user()->campaigns()->create([
            'title' => $this->title,
            'short_description' => $this->short_description,
            'content_type' => $this->content_type,
            'platforms' => $this->platforms,
        ]);

        $this->showCreateModal = false;
        $this->reset(['title', 'short_description', 'content_type', 'platforms']);

        session()->flash('message', 'Campagne créée avec succès !');
    }

    public function acceptInvitation(Campaign $campaign)
    {
        $user = Auth::user();
        $user->participations()->updateExistingPivot($campaign->id, ['status' => 'accepted']);
        session()->flash('message', 'Vous avez accepté la collaboration.');
        $this->dispatch('refresh-campaigns');
    }

    public function rejectInvitation(Campaign $campaign)
    {
        $user = Auth::user();
        $user->participations()->detach($campaign->id);
        session()->flash('message', 'Vous avez refusé la collaboration.');
        $this->dispatch('refresh-campaigns');
    }

    public function render()
    {
        $user = Auth::user();
        $pendingInvitations = collect();

        $pendingInvitations = $user->participations()
            ->wherePivot('status', 'pending')
            ->get();

        // If enterprise, see campaigns they are invited to.
        // If user/influencer, see campaigns they created OR were invited to and accepted
        if ($user->role === UserRole::Enterprise) {
            $campaigns = $user->participations()
                ->wherePivot('status', 'accepted')
                ->latest()
                ->paginate(10);
        } else {
            // Influencer/User sees owned campaigns + accepted participations
            $ownedCampaignIds = $user->campaigns()->pluck('id');
            $acceptedParticipationIds = $user->participations()->wherePivot('status', 'accepted')->pluck('campaign_id');

            $campaigns = \App\Models\Campaign::whereIn('id', $ownedCampaignIds->concat($acceptedParticipationIds))
                ->latest()
                ->paginate(10);
        }

        $enterprises = User::where('role', UserRole::Enterprise)->get();

        return view('livewire.campaigns.index', [
            'campaigns' => $campaigns,
            'enterprises' => $enterprises,
            'pendingInvitations' => $pendingInvitations,
        ]);
    }
}
