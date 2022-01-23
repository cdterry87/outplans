<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Filters extends Component
{
    public $sortBy, $sortOrder, $search;

    public function updateSortBy()
    {
        $this->emit('filterSortBy', $this->sortBy);
    }

    public function updateSortOrder()
    {
        $this->emit('filterSortOrder', $this->sortOrder);
    }

    public function updateSearch()
    {
        $this->emit('filterSearch', $this->search);
    }

    public function render()
    {
        return view('livewire.filters');
    }
}
