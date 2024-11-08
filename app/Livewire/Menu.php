<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\On;
use Livewire\Component;

class Menu extends Component
{
    public $currentRouteName;

    public $currentRouteUsername;

    public function mount()
    {
        $this->currentRouteName = Route::currentRouteName();
        $this->currentRouteUsername = @Route::getCurrentRoute()->originalParameters()['user'];

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

        return $this->redirect(route('home'), navigate: true);
    }
}
