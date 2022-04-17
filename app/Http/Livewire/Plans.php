<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class Plans extends Component
{
    use WithPagination;
    use WithFileUploads;

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
    public $plan_id;
    public $title, $description, $location, $address, $city, $state, $postal_code, $start_datetime, $end_datetime, $cost, $image;
    public $display_image;

    // Form properties
    public $isModalOpen = false;
    public $isDeleteConfirmationShown = false;
    protected $rules = [
        'title' => 'required|max:100',
        'location' => 'required|max:100',
        'address' => 'required|max:100',
        'city' => 'required|max:50',
        'state' => 'required|max:2',
        'postal_code' => 'required|max:10',
        'start_datetime' => 'required|date|after_or_equal:now',
        'end_datetime' => 'nullable|date|after_or_equal:start_datetime',
        'cost' => 'nullable|numeric',
        'image' => 'required_without:plan_id|nullable|sometimes|max:10000',
    ];

    protected $messages = [
        'image.required_without' => 'You must upload an image for this plan.',
        'start_datetime.after_or_equal' => 'The start date must be on or after the current date.',
        'end_datetime.after_or_equal' => 'The end date must be on or after the start date.',
    ];

    public function render()
    {
        $plans = auth()->user()->plans()
            ->where('start_datetime', '>=', Carbon::now())
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

        return view('livewire.plans', [
            'plans' => $plans,
            'sortOptions' => $this->sortOptions,
            'totalResults' => $this->totalResults,
        ]);
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);

        $this->plan_id = $id;
        $this->title = $plan->title;
        $this->description = $plan->description;
        $this->location = $plan->location;
        $this->address = $plan->address;
        $this->city = $plan->city;
        $this->state = $plan->state;
        $this->postal_code = $plan->postal_code;
        $this->start_datetime = $plan->start_datetime->format('Y-m-d\TH:i');
        $this->end_datetime = $this->end_datetime ? $plan->end_datetime->format('Y-m-d\TH:i') : null;
        $this->cost = $plan->cost;
        $this->display_image = $plan->getDisplayImage();

        $this->openModal();
    }

    public function submit()
    {
        $this->validate();

        $plan = Plan::updateOrCreate(['id' => $this->plan_id], [
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'cost' => $this->cost,
        ]);

        // If an image was selected, upload it
        if ($this->image) {
            $this->uploadImage($plan->id);
        }

        $this->count++;
        $this->emit('updateCount', $this->count);

        $this->closeModal();
    }

    public function uploadImage($planId)
    {
        $image = $this->image->store('plans/' . auth()->id() . '/' . $planId);

        Plan::findOrFail($planId)->update(['image' => $image]);
    }

    public function deleteConfirmation($id)
    {
        $this->plan_id = $id;
        $this->isDeleteConfirmationShown = true;
    }

    public function deleteCancellation()
    {
        $this->plan_id = null;
        $this->isDeleteConfirmationShown = false;
    }

    public function delete()
    {
        Plan::find($this->plan_id)->delete();
        $this->isDeleteConfirmationShown = false;
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

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->resetValidation();
        $this->isModalOpen = false;
    }

    public function resetForm()
    {
        $this->plan_id = null;
        $this->title = null;
        $this->description = null;
        $this->location = null;
        $this->address = null;
        $this->city = null;
        $this->state = null;
        $this->postal_code = null;
        $this->start_datetime = null;
        $this->end_datetime = null;
        $this->cost = null;
        $this->image = null;
        $this->display_image = null;
    }
}
