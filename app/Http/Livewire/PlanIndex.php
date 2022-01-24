<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Livewire\Component;

class PlanIndex extends Component
{
    public $plan;

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function render()
    {
        return view('livewire.plan', [
            'plan' => $this->plan,
            'attendees_count' => $this->plan->attendees()->count(),
            'invites_count' => $this->plan->invites()->count(),
        ]);
    }
}
