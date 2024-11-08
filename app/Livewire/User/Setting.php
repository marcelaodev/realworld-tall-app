<?php

namespace App\Livewire\User;

use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Setting extends Component
{
    public $user;

    public function mount()
    {
        $userId = auth()->user()->getAuthIdentifier();
        $this->user = User::find($userId)->toArray();

        SEOTools::setTitle('My setting', false);
    }

    protected function rules()
    {
        return [
            'user.name' => ['required'],
            'user.username' => [
                'required',
                Rule::unique('users', 'username')->ignore(auth()->user()->getAuthIdentifier()),
            ],
            'user.email' => [
                'required',
                Rule::unique('users', 'email')->ignore(auth()->user()->getAuthIdentifier()),
            ],
            'user.password' => [
                'sometimes',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'user.image' => ['required'],
            'user.bio' => ['string'],
        ];
    }

    public function render()
    {
        return view('livewire.user.setting');
    }

    public function saveSetting()
    {
        $this->validate();

        $userId = auth()->user()->getAuthIdentifier();
        $user = User::find($userId);

        $user->name = $this->user['name'];
        $user->username = $this->user['username'];
        $user->bio = $this->user['bio'];
        $user->image = $this->user['image'];
        $user->email = $this->user['email'];

        if (array_key_exists('password', $this->user)) {
            $user->password = Hash::make($this->user['password']);
        }

        $user->save();

        $this->user = $user->toArray();

        session()->flash('flash.banner', 'Your settings has been saved');

        return $this->redirect(route('user.show', ['user' => $user->username]), navigate: true);
    }
}
