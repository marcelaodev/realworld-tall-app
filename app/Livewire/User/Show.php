<?php

namespace App\Livewire\User;

use App\Models\Article;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\Component;

class Show extends Component
{
    public $user;

    public $articles;

    public $loggedInUser;

    public $viewingFavoriteArticles = false;

    public function updatedViewingFavoriteArticles()
    {
        if ($this->viewingFavoriteArticles) {
            $this->articles = $this->user->favorites(Article::class)->with(['author'])->get();
        }

        if (!$this->viewingFavoriteArticles) {
            $this->articles = Article::where('user_id', '=', $this->user->id)->with(['author'])->get();
        }
    }

    public function mount(User $user)
    {
        $this->articles = Article::where('user_id', '=', $this->user->id)->with(['author'])->get();
        $this->user = $user;
        $this->loggedInUser = User::find(auth()->id());

        SEOTools::setTitle($this->user['name'], false);
        SEOTools::setDescription($this->user['bio']);
    }

    public function render()
    {
        return view('livewire.user.show');
    }

}
