<?php

namespace App\Livewire\Campaigns;

use App\Models\Campaign;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\CampaignStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Campaign $campaign;
    public $newStatus;

    public function mount(Campaign $campaign)
    {
        $this->campaign = $campaign;
        $this->newStatus = $campaign->status->value;
    }

    public function updateStatus()
    {
        $this->authorize('update', $this->campaign);

        $this->campaign->update([
            'status' => $this->newStatus,
        ]);

        session()->flash('message', 'Statut mis à jour avec succès.');
    }

    public function render()
    {
        return view('livewire.campaigns.show');
    }
}
