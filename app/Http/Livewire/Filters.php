<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Filters extends Component
{
    protected $listeners = ['updateTotalResults'];

    public $show, $sortBy, $sortOrder, $sortOptions, $totalResults;

    public function updateShow()
    {
        $this->emit('filterShow', $this->show);
    }

    public function updateSortBy()
    {
        $this->emit('filterSortBy', $this->sortBy);
    }

    public function updateSortOrder()
    {
        $this->emit('filterSortOrder', $this->sortOrder);
    }

    public function updateTotalResults($value)
    {
        $this->totalResults = $value;
    }

    public function render()
    {
        return view('livewire.filters');
    }
}
