<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Livewire\Component;

class PlanIndex extends Component
{
    public $isModalOpen = false;

    public $plan;
    public $selectedFriends = [];

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
            'friends' => auth()->user()->friends_with_details()->get(),
        ]);
    }

    public function submit()
    {
        dd($this->selectedFriends);
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }
}
