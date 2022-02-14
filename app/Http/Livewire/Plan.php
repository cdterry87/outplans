<?php

namespace App\Http\Livewire;

use App\Models\Plan as PlanModel;
use Livewire\Component;

class Plan extends Component
{
    protected $listeners = ['filterSearch'];

    public $isModalOpen = false;

    public $plan;
    public $selectedFriends = [];
    public $search;

    public function mount(PlanModel $plan)
    {
        $this->plan = $plan;
    }

    public function render()
    {
        return view('livewire.plan', [
            'plan' => $this->plan,
            'attendees_count' => $this->plan->attendees()->count(),
            'invites' => $this->plan->invites()->pluck('invited_user_id')->toArray(),
            'friends' => auth()->user()
                ->friends_with_details()
                ->when(strlen($this->search) >= 3, function ($query) {
                    return $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->get(),
        ]);
    }

    public function invite($invitedUserId)
    {
        $this->plan->invites()->create([
            'invited_user_id' => $invitedUserId,
            'user_id' => auth()->user()->id,
            'plan_id' => $this->plan->id
        ]);
    }

    public function uninvite($invitedUserId)
    {
        $this->plan->invites()
            ->where('invited_user_id', $invitedUserId)
            ->delete();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function filterSearch($search)
    {
        $this->search = $search;
    }
}
