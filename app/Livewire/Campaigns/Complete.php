<?php

namespace App\Livewire\Campaigns;

use App\Models\Campaign;
use Illuminate\Support\Str;
use Livewire\Component;

class Complete extends Component
{
    public Campaign $campaign;

    public $currentStep = 1;

    public $step1Completed = false;

    public $step2Completed = false;

    // Step 1: Info & Links
    public $title;

    public $short_description;

    public $description;

    public $content_type;

    public $content_links = []; // [ 'tiktok' => '...', 'instagram' => '...' ]

    // Step 2: Form Builder
    public $formFields = []; // [ ['label' => '...', 'type' => '...', 'required' => true] ]

    // Step 3: Confirmation
    public $is_active;

    public $call_button_phone;

    public $public_link;

    public $platforms = [];

    public function mount(Campaign $campaign)
    {
        $this->authorize('update', $campaign);
        $this->campaign = $campaign;
        $this->title = $campaign->title;
        $this->short_description = $campaign->short_description;
        $this->description = $campaign->description;
        $this->content_type = $campaign->content_type?->value;
        $this->platforms = $campaign->platforms ?? [];

        $this->content_links = $campaign->content_links ?? [];
        // Ensure all active platforms have a link field
        foreach ($this->platforms as $platform) {
            if (! isset($this->content_links[$platform])) {
                $this->content_links[$platform] = '';
            }
        }

        $formSettings = $campaign->lead_form_settings;
        if ($formSettings) {
            $this->formFields = $formSettings['fields'] ?? [];
            $this->call_button_phone = $formSettings['call_button_phone'] ?? '';
        } else {
            // Default fields: Nom, Prénom, Email, Téléphone
            $this->formFields = [
                ['id' => Str::random(5), 'label' => 'Nom', 'type' => 'text', 'required' => true],
                ['id' => Str::random(5), 'label' => 'Prénom', 'type' => 'text', 'required' => true],
                ['id' => Str::random(5), 'label' => 'Email', 'type' => 'email', 'required' => true],
                ['id' => Str::random(5), 'label' => 'Numéro de téléphone', 'type' => 'tel', 'required' => true],
            ];
        }

        $this->is_active = $campaign->is_active;

        // Track completion status
        $this->step1Completed = ! empty($this->description);
        $this->step2Completed = $campaign->lead_form_settings !== null;

        if (! $campaign->slug) {
            $campaign->update(['slug' => Str::slug($campaign->title) . '-' . Str::random(6)]);
        }
        $this->public_link = route('campaigns.public-form', $campaign->slug);
    }

    public function addPlatform($platform)
    {
        if (! in_array($platform, $this->platforms)) {
            $this->platforms[] = $platform;
            if (! isset($this->content_links[$platform])) {
                $this->content_links[$platform] = '';
            }
        }
    }

    public function removePlatform($platform)
    {
        $this->platforms = array_filter($this->platforms, fn($p) => $p !== $platform);
        unset($this->content_links[$platform]);
    }

    public function addField()
    {
        $this->formFields[] = ['id' => Str::random(5), 'label' => 'Nouveau champ', 'type' => 'text', 'required' => false];
    }

    public function removeField($index)
    {
        unset($this->formFields[$index]);
        $this->formFields = array_values($this->formFields);
    }

    public function goToStep($step)
    {
        if ($step > $this->currentStep) {
            if (! $this->validateCurrentStep()) {
                return;
            }
            $this->saveCurrentStepData();
        }
        $this->currentStep = $step;
    }

    public function nextStep()
    {
        if (! $this->validateCurrentStep()) {
            return;
        }
        $this->saveCurrentStepData();
        $this->currentStep++;
    }

    public function prevStep()
    {
        $this->currentStep--;
    }

    public function saveOnly()
    {
        if (! $this->validateCurrentStep()) {
            return;
        }
        $this->saveCurrentStepData();
        session()->flash('message', 'Étape enregistrée avec succès.');
    }

    public function validateCurrentStep()
    {
        if ($this->currentStep === 1) {
            // Trim tags for validation check to handle Trix "empty" state like <div><br></div>
            $strippedDescription = trim(strip_tags($this->description));
            if (empty($strippedDescription)) {
                $this->description = '';
            }

            $rules = [
                'title' => 'required|string|min:3',
                'short_description' => 'required|string|min:5',
                'description' => 'required|string|min:10',
                'content_type' => 'required|string',
                'platforms' => 'required|array|min:1',
            ];

            foreach ($this->platforms as $platform) {
                $rules['content_links.' . $platform] = 'required|url';
            }

            $this->validate($rules, [
                'platforms.required' => 'Veuillez choisir au moins une plateforme.',
                'content_links.*.required' => 'Le lien est obligatoire.',
                'content_links.*.url' => 'Le lien doit être une URL valide.',
                'description.required' => 'La description détaillée est obligatoire.',
                'description.min' => 'La description doit faire au moins 10 caractères.',
            ]);
        }

        return true;
    }

    public function saveCurrentStepData()
    {
        if ($this->currentStep === 1) {
            $this->campaign->update([
                'title' => $this->title,
                'short_description' => $this->short_description,
                'description' => $this->description,
                'content_type' => $this->content_type,
                'platforms' => $this->platforms,
                'content_links' => $this->content_links,
            ]);
            $this->step1Completed = true;
        } elseif ($this->currentStep === 2) {
            $this->campaign->update([
                'lead_form_settings' => [
                    'fields' => $this->formFields,
                    'call_button_phone' => $this->call_button_phone,
                ],
            ]);
            $this->step2Completed = true;
        }
    }

    public function saveAndFinish()
    {
        $this->saveCurrentStepData();
        $this->campaign->update([
            'is_active' => $this->is_active,
            'lead_form_settings' => [
                'fields' => $this->formFields,
                'call_button_phone' => $this->call_button_phone,
            ],
        ]);

        return redirect()->route('campaigns.show', $this->campaign);
    }

    public function render()
    {
        return view('livewire.campaigns.complete');
    }
}
