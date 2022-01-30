<?php

namespace App\Http\Livewire;

use App\Models\Friend;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\DB;

class FriendRequests extends Component
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
        'created_at' => 'Date Sent',
    ];

    public $requesting_id;
    public $isDeleteConfirmationShown = false;

    public function render()
    {
        $friend_requests = auth()->user()->friends_requests_received_with_details()
            ->when(strlen($this->search) >= 3, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortOrder ?? 'asc')
            ->paginate($this->show);

        $this->totalResults = $friend_requests->total();
        $this->emit('updateTotalResults', $this->totalResults);

        return view('livewire.friend-requests', [
            'friendRequests' => $friend_requests,
            'sortOptions' => $this->sortOptions,
            'totalResults' => $this->totalResults,
        ]);
    }

    public function acceptFriendRequest($id)
    {
        $this->requesting_id = $id;

        // Add the requesting user to the auth user's friends list
        Friend::create([
            'friend_user_id' => $this->requesting_id,
            'user_id' => auth()->user()->id,
        ]);

        // Add the auth user to the requesting user's friends list
        Friend::create([
            'user_id' => $this->requesting_id,
            'friend_user_id' => auth()->user()->id,
        ]);

        $this->delete();
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

    public function deleteConfirmation($id)
    {
        $this->requesting_id = $id;
        $this->isDeleteConfirmationShown = true;
    }

    public function deleteCancellation()
    {
        $this->requesting_id = null;
        $this->isDeleteConfirmationShown = false;
    }

    public function delete()
    {
        // Delete the friend request from the requestor
        FriendRequest::where('user_id', $this->requesting_id)
            ->where('requested_user_id', auth()->user()->id)
            ->delete();

        // Delete the friend request from the auth user
        FriendRequest::where('requested_user_id', $this->requesting_id)
            ->where('user_id', auth()->user()->id)
            ->delete();

        $this->isDeleteConfirmationShown = false;
    }
}
