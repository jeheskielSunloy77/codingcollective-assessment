<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Avatar extends Component
{
    public function render()
    {
        return view('livewire.avatar', [
            'user' => User::query()->first(),
        ]);
    }
}
