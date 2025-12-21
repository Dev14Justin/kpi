<?php

namespace App\Livewire\Campaigns;

use App\Enums\CampaignStatus;
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
    public $description = '';
    public $budget = '';
    public $start_date = '';
    public $end_date = '';
    public $invited_enterprise_ids = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'budget' => 'nullable|numeric|min:0',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'invited_enterprise_ids' => 'array',
        'invited_enterprise_ids.*' => 'exists:users,id',
    ];

    public function openCreateModal()
    {
        $this->reset(['title', 'description', 'budget', 'start_date', 'end_date', 'invited_enterprise_ids']);
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
            session()->flash('error', "Les entreprises ne peuvent pas créer de campagnes.");
            return;
        }

        $this->validate();

        $campaign = Auth::user()->campaigns()->create([
            'title' => $this->title,
            'description' => $this->description,
            'budget' => $this->budget ?: null,
            'status' => CampaignStatus::Draft,
            'start_date' => $this->start_date ?: null,
            'end_date' => $this->end_date ?: null,
        ]);

        if (!empty($this->invited_enterprise_ids)) {
            $campaign->participants()->attach($this->invited_enterprise_ids);
        }

        $this->showCreateModal = false;
        $this->reset(['title', 'description', 'budget', 'start_date', 'end_date', 'invited_enterprise_ids']);

        session()->flash('message', 'Campagne créée avec succès !');
    }

    public function render()
    {
        $user = Auth::user();

        // If enterprise, see campaigns they are invited to.
        // If user/influencer, see campaigns they created.
        if ($user->role === UserRole::Enterprise) {
            $campaigns = $user->participations()->latest()->paginate(10);
        } else {
            $campaigns = $user->campaigns()->latest()->paginate(10);
        }

        $enterprises = User::where('role', UserRole::Enterprise)->get();

        return view('livewire.campaigns.index', [
            'campaigns' => $campaigns,
            'enterprises' => $enterprises,
        ]);
    }
}
