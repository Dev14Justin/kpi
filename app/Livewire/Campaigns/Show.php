<?php

namespace App\Livewire\Campaigns;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Campaign $campaign;

    public $inviteEmail;
    public $is_active;

    public function mount(Campaign $campaign)
    {
        $this->campaign = $campaign;
        $this->is_active = (bool) $campaign->is_active;
    }

    public function invitePartner()
    {
        $this->authorize('manageParticipants', $this->campaign);

        $this->validate([
            'inviteEmail' => 'required|email|exists:users,email',
        ], [
            'inviteEmail.exists' => 'Cet utilisateur n\'existe pas sur la plateforme.',
        ]);

        $userToInvite = User::where('email', $this->inviteEmail)->first();

        // Check if already invited
        if ($this->campaign->participants()->where('user_id', $userToInvite->id)->exists()) {
            $this->addError('inviteEmail', 'Cet utilisateur est déjà partenaire de cette campagne.');

            return;
        }

        $this->campaign->participants()->attach($userToInvite->id, [
            'status' => 'pending',
        ]);

        $userToInvite->notify(new \App\Notifications\CampaignInvitationNotification($this->campaign, Auth::user()));

        $this->inviteEmail = '';
        $this->campaign->load('participants');

        session()->flash('message', 'Invitation envoyée avec succès à ' . $userToInvite->name);
    }

    public function removeParticipant($userId)
    {
        $this->authorize('manageParticipants', $this->campaign);

        $this->campaign->participants()->detach($userId);

        $this->campaign->load('participants');
        session()->flash('message', 'Partenaire retiré de la campagne.');
    }

    public function getLeadsCountProperty(): int
    {
        return $this->campaign->leads()->count();
    }

    public function getIsCompleteProperty(): bool
    {
        // Check if all mandatory fields from "complete" steps are filled
        return !empty($this->campaign->description) &&
            ($this->campaign->content_type !== null) &&
            !empty($this->campaign->platforms) &&
            !empty($this->campaign->content_links) &&
            $this->campaign->lead_form_settings !== null;
    }

    public function toggleStatus(): void
    {
        $this->authorize('update', $this->campaign);

        if (!$this->isComplete) {
            session()->flash('error', 'Vous devez compléter toutes les étapes avant d\'activer la campagne.');
            return;
        }

        $this->campaign->update([
            'is_active' => !$this->is_active
        ]);

        $this->campaign->refresh();
        $this->is_active = (bool) $this->campaign->is_active;

        session()->flash('message', $this->is_active ? 'Campagne activée !' : 'Campagne désactivée.');
    }

    public function connectGoogle(): void
    {
        // Simulate Google OAuth connection
        session()->flash('message', 'Redirection vers l\'authentification Google...');
        // In a real app, this would redirect to Socialite
    }

    public function exportToGoogleSheets(): void
    {
        $count = $this->leadsCount;

        if ($count === 0) {
            session()->flash('error', 'Aucune donnée à exporter.');

            return;
        }

        // Simulate export
        session()->flash('message', "Exportation de {$count} leads vers Google Sheets réussie !");
    }

    public function render()
    {
        return view('livewire.campaigns.show', [
            'leadsCount' => $this->leadsCount,
        ]);
    }
}
