<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class MyPlans extends Component
{
    use WithPagination;

    // Listeners
    protected $listeners = ['filterSortBy', 'filterSortOrder', 'filterSearch'];

    // Filter options
    public $sortBy = 'when';
    public $sortOrder = 'desc';
    public $search;

    // Model properties
    public $title, $location, $address, $when, $cost;

    public function filterSortBy($value)
    {
        $this->sortBy = $value;
    }

    public function filterSortOrder($value)
    {
        $this->sortOrder = $value;
    }

    public function filterSearch($value)
    {
        $this->search = $value;
        $this->resetPage();
    }

    public function render()
    {
        $plans = auth()->user()->plans()
            ->when(strlen($this->search) >= 3, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('location', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%');
            })
            ->with('user')
            ->withCount('attendees')
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate(10);

        return view('livewire.my-plans', [
            'plans' => $plans,
        ]);
    }
}
