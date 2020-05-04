<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Settings extends Component
{
    public $name;
    public $email;

    public function mount()
    {
        $this->title = 'My Settings';
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function render()
    {
        return view('livewire.settings', [
            'user' => auth()->user()
        ]);
    }
}
