<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserIndex extends Component
{
    public $user;
    public $private = false;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user');
    }
}
