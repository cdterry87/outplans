<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PlanAttendee;
use Livewire\WithPagination;

class Attended extends Component
{
    use WithPagination;

    // Listeners
    protected $listeners = ['edit', 'filterShow', 'filterSortBy', 'filterSortOrder', 'filterSearch'];

    // Filter options
    public $count, $search;
    public $show = 30;
    public $sortBy = 'plans.start_datetime';
    public $sortOrder = 'asc';
    public $sortOptions = [
        'plans.cost' => 'Cost',
        'plans.start_datetime' => 'Date',
        'plans.created_at' => 'Created',
        'plans.title' => 'Title',
    ];

    public function render()
    {
        $attendedPlans = PlanAttendee::query()
            ->where('plans_attendees.user_id', auth()->id())
            ->where('plans_attendees.status', 'A')
            ->join('plans', 'plans.id', '=', 'plans_attendees.plan_id')
            ->where('plans.start_datetime', '<=', now())
            ->orderBy($this->sortBy, $this->sortOrder ?? 'asc')
            ->paginate($this->show);

        $this->totalResults = $attendedPlans->total();
        $this->emit('updateTotalResults', $this->totalResults);

        return view('livewire.attended', [
            'attendedPlans' => $attendedPlans,
            'sortOptions' => $this->sortOptions,
            'totalResults' => $this->totalResults,
        ]);
    }
}
