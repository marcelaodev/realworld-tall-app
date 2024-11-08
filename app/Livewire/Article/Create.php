<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public Article $article;

    public $title;

    public $body;

    public $description;

    public $tag;

    public $article_tags = [];

    public function mount()
    {
        $this->article = new \App\Models\Article;
        $this->article->description = '';

        SEOTools::setTitle('Create new article', false);
        SEOTools::setDescription('New article created here.');
    }

    protected $rules = [
        'title' => ['required', 'string'],
        'body' => ['required', 'string'],
        'description' => ['string'],
    ];

    public function render()
    {
        return view('livewire.article.create', [
            'tags' => \App\Models\Tag::all(),
        ]);
    }

    public function saveArticle()
    {
        $this->validate();

        $this->article->user_id = auth()->id();
        $this->article->title = $this->title;
        $this->article->body = $this->body;
        $this->article->description = $this->description;

        $this->article->save();

        $this->article->tags()->sync($this->article_tags);

        session()->flash('flash.banner', 'Your article has been published!');

        return $this->redirect(route('article.show', ['article' => $this->article->slug]), navigate: true);
    }

    public function createTag()
    {
        $slug = Str::slug($this->tag);
        $tag = \App\Models\Tag::where('slug', '=', $slug)->first();
        if ($tag) {
            session()->flash('message-tag', 'Tag already exists.');

            return;
        }

        $this->validate(['tag' => ['required']]);

        if (!empty($this->tag)) {
            \App\Models\Tag::create(['name' => $this->tag]);

            $this->reset('tag');

            session()->flash('message-tag', 'Tag has been created');
        }
    }
}
