<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('User Profile | Payment App')]

class Profile extends Component
{
    public function render()
    {
        return view('livewire.pages.profile');
    }
}
