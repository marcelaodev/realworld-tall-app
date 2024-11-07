<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\On;
use Livewire\Component;

class Menu extends Component
{
    public $currentRouteName;

    public function mount()
    {
        $this->currentRouteName = Route::currentRouteName();
    }

    public function render()
    {
        return view('menu');
    }

    #[On('logout')]
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return $this->redirect(route('front.index'), navigate: true);
    }
}
