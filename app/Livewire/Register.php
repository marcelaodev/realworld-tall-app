<?php

namespace App\Livewire;

use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Hash;
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
            'credentials.username' => ['required', 'unique:users,username'],
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
        return view('livewire.register');
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->credentials['name'],
            'username' => $this->credentials['username'],
            'password' => Hash::make($this->credentials['password']),
            'email' => $this->credentials['email'],
        ]);

        Auth::loginUsingId($user->id);

        return $this->redirect(route('home'), navigate: true);
    }
}
