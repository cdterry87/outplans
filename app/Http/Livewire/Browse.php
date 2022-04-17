<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use App\Models\Friend;
use Livewire\Component;
use App\Models\PlanInvite;
use App\Models\PlanAttendee;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class Browse extends Component
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

    public function render()
    {
        $plans = Plan::query()
            ->where('user_id', '!=', auth()->id())
            ->where('start_datetime', '>=', Carbon::now())
            ->when(strlen($this->search) >= 3, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('location', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%');
            })
            ->where(function ($query) {
                // Get only the plans set to 'P' for Public 
                $query->where('privacy', 'P');
                // or get plans of friends that are set to 'F' for Friends Only
                $query->orWhere(function ($subquery) {
                    $subquery->where('privacy', 'F');
                    $subquery->whereIn('user_id', Friend::select('friend_user_id')->where('user_id', auth()->id()));
                });
            })
            ->with('user')
            ->withCount('attendees')
            ->orderBy($this->sortBy, $this->sortOrder ?? 'asc')
            ->paginate($this->show);

        $this->totalResults = $plans->total();
        $this->emit('updateTotalResults', $this->totalResults);

        return view('livewire.browse', [
            'plans' => $plans,
            'sortOptions' => $this->sortOptions,
            'totalResults' => $this->totalResults,
        ]);
    }

    public function attending($id, $status)
    {
        PlanAttendee::create([
            'status' => $status,
            'user_id' => auth()->user()->id,
            'plan_id' => $id
        ]);

        PlanInvite::where('plan_id', $id)
            ->where('invited_user_id', auth()->user()->id)
            ->delete();
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
