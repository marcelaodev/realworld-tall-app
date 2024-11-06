<?php

namespace App\Http\Livewire\App;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Register extends Component
{
    public $credentials = [
        'name' => '',
        'username' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    protected function rules()
    {
        return [
            'credentials.name' => ['required', 'string'],
            'credentials.email' => ['required', 'email', 'unique:users,email'],
            'credentials.username' => ['required', 'email', 'unique:users,username'],
            'credentials.password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }

    public function mount()
    {
        SEOTools::setTitle('Sign Up', false);
    }

    public function render()
    {
        return view('livewire.app.register');
    }

    public function register()
    {
        $this->validate();

        $user = \App\Models\User::create([
            'name' => $this->credentials['name'],
            'username' => $this->credentials['username'],
            'password' => $this->credentials['password'],
            'email' => $this->credentials['email'],
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->route('front.index');
    }
}
