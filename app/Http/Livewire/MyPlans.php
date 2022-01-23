<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class MyPlans extends Component
{
    use WithPagination;

    // Listeners
    protected $listeners = ['filterShow', 'filterSortBy', 'filterSortOrder', 'filterSearch'];

    // Filter options
    public $count, $search;
    public $show = 6;
    public $sortBy = 'when';
    public $sortOrder = 'desc';
    public $sortOptions = [
        'cost' => 'Cost',
        'when' => 'Date',
        'title' => 'Title',
    ];

    // Model properties
    public $title, $location, $address, $when, $cost;

    public function filterShow($value)
    {
        $this->show = $value;
    }

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
            ->orderBy($this->sortBy, $this->sortOrder ?? 'asc')
            ->paginate($this->show);

        $this->totalResults = $plans->total();
        $this->emit('updateTotalResults', $this->totalResults);

        return view('livewire.my-plans', [
            'plans' => $plans,
            'sortOptions' => $this->sortOptions,
            'totalResults' => $this->totalResults,
        ]);
    }
}
