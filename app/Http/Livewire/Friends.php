<?php

namespace App\Http\Livewire;

use App\Models\Friend;
use Livewire\Component;
use Livewire\WithPagination;

class Friends extends Component
{
    use WithPagination;

    // Listeners
    protected $listeners = ['filterShow', 'filterSortBy', 'filterSortOrder', 'filterSearch'];

    // Filter options
    public $count, $search;
    public $show = 6;
    public $sortBy = 'created_at';
    public $sortOrder = 'asc';
    public $sortOptions = [
        'name' => 'Name',
        'created_at' => 'Friends Since',
    ];

    public $friend_id;
    public $email;

    // Form properties
    public $isModalOpen = false;
    public $isDeleteConfirmationShown = false;
    protected $rules = [
        'email' => 'required|email',
    ];

    public function render()
    {
        $friends = auth()->user()->friends_with_details()
            ->when(strlen($this->search) >= 3, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortOrder ?? 'asc')
            ->paginate($this->show);

        $this->totalResults = $friends->total();
        $this->emit('updateTotalResults', $this->totalResults);

        return view('livewire.friends', [
            'friends' => $friends,
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
        $this->friend_id = null;
        $this->email = null;
    }

    public function deleteConfirmation($id)
    {
        $this->friend_id = $id;
        $this->isDeleteConfirmationShown = true;
    }

    public function deleteCancellation()
    {
        $this->friend_id = null;
        $this->isDeleteConfirmationShown = false;
    }

    public function delete()
    {
        auth()->user()->friends()
            ->where('friend_user_id', $this->friend_id)
            ->delete();
        $this->isDeleteConfirmationShown = false;
    }
}
