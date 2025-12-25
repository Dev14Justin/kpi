<?php

namespace App\Livewire\Campaigns;

use App\Models\Campaign;
use App\Models\Lead;
use Livewire\Component;

class PublicLeadForm extends Component
{
    public Campaign $campaign;

    public $formData = [];

    public $submitted = false;

    public function mount(Campaign $campaign)
    {
        $this->campaign = $campaign;

        // Initialize form data based on settings
        $settings = $campaign->lead_form_settings;
        if (isset($settings['fields'])) {
            foreach ($settings['fields'] as $field) {
                $this->formData[$field['label']] = '';
            }
        }
    }

    public function submit()
    {
        $rules = [];
        $settings = $this->campaign->lead_form_settings;

        if (isset($settings['fields'])) {
            foreach ($settings['fields'] as $field) {
                $rule = $field['required'] ? 'required' : 'nullable';
                if ($field['type'] === 'email') {
                    $rule .= '|email';
                }
                if ($field['type'] === 'number') {
                    $rule .= '|numeric';
                }

                $rules['formData.'.$field['label']] = $rule;
            }
        }

        $this->validate($rules);

        Lead::create([
            'campaign_id' => $this->campaign->id,
            'data' => $this->formData,
        ]);

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.campaigns.public-lead-form');
    }
}
