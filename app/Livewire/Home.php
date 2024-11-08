<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Tag;
use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\Component;

class Home extends Component
{
    public $viewingPrivateFeed = false;

    public $viewingTag = '';

    public $viewingTagID = '';

    public $articles;

    public function mount()
    {
        SEOTools::setTitle('Conduit X Ricardo Sawir', false);
        SEOTools::setDescription('Real world application, implemented in Laravel Livewire by Ricardo Sawir.');

        $this->articles = \App\Models\Article::with(['author'])->orderBy('created_at', 'DESC')
            ->get();
    }

    public function updatedViewingPrivateFeed()
    {
        $this->viewingTag = '';
        $this->viewingTagID = '';

        if ($this->viewingPrivateFeed) {
            $user = \App\Models\User::find(auth()->id());

            $followings = $user->followings()->get();

            $this->articles = \App\Models\Article::with(['author'])->whereIn('user_id', $followings->map(function (\App\Models\User $user) {
                return $user->id;
            }))->get();
        }

        if (! $this->viewingPrivateFeed) {
            $this->articles = \App\Models\Article::with(['author'])->orderBy('created_at', 'DESC')->get();
        }
    }

    public function updatedViewingTagID()
    {
        if ($this->viewingTagID != '') {
            $tag = Tag::find($this->viewingTagID);
            $this->articles = $tag->articles;
            $this->viewingTag = $tag->name;

            SEOTools::setTitle("{$this->viewingTag} | Conduit X Ricardo Sawir", false);
            SEOTools::setDescription($this->viewingTag);
        }
    }

    public function render()
    {
        return view('livewire.home', [
            'tags' => Tag::all(),
        ]);
    }
}
