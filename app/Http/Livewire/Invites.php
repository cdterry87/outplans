<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class Invites extends Component
{
    use WithPagination;

    // Listeners
    protected $listeners = ['edit', 'filterShow', 'filterSortBy', 'filterSortOrder', 'filterSearch'];

    // Filter options
    public $count, $search;
    public $show = 30;
    public $sortBy = 'start_datetime';
    public $sortOrder = 'desc';
    public $sortOptions = [
        'cost' => 'Cost',
        'start_datetime' => 'Date',
        'created_at' => 'Created',
        'title' => 'Title',
    ];

    // Model properties

    // Form properties

    public function render()
    {
        $plans = auth()->user()->plans_invited()
            ->when(strlen($this->search) >= 3, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('location', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%');
            })
            ->withCount('attendees')
            ->orderBy($this->sortBy, $this->sortOrder ?? 'asc')
            ->paginate($this->show);

        $this->totalResults = $plans->total();
        $this->emit('updateTotalResults', $this->totalResults);

        return view('livewire.invites', [
            'plans' => $plans,
            'sortOptions' => $this->sortOptions,
            'totalResults' => $this->totalResults,
        ]);
    }

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
}
