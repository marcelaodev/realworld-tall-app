<?php

namespace App\Livewire\Article;

use App\Models\Article;
use App\Models\Tag;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Str;
use Livewire\Component;

class Edit extends Component
{
    public Article $article;

    public $title;

    public $body;

    public $description;

    public $tag;

    public $article_tags = [];

    public function mount(Article $article)
    {
        $this->article = $article;
        $this->title = $article->title;
        $this->body = $article->body;
        $this->description = $article->description;

        if (!$article->tags->isEmpty()) {
            $this->article_tags = $article->tags->map(function ($tag) {
                return $tag->id;
            });
        }

        SEOTools::setTitle('Edit article', false);
        SEOTools::setDescription('Article is being edited.');
    }

    protected $rules = [
        'title' => ['required', 'string'],
        'body' => ['required', 'string'],
        'description' => ['string'],
    ];

    public function render()
    {
        return view('livewire.article.edit', [
            'tags' => Tag::all(),
        ]);
    }

    public function saveArticle()
    {
        $this->validate();

        $this->article->title = $this->title;
        $this->article->body = $this->body;
        $this->article->description = $this->description;
        $this->article->save();

        $this->article->tags()->sync($this->article_tags);

        session()->flash('flash.banner', 'Your article has been saved!');

        return $this->redirect(route('article.show', ['article' => $this->article->slug]), navigate: true);
    }

    public function createTag()
    {
        $slug = Str::slug($this->tag);
        $tag = Tag::where('slug', '=', $slug)->first();
        if ($tag) {
            session()->flash('message-tag', 'Tag has existed.');

            return;
        }

        $this->validate(['tag' => ['required']]);

        if (!empty($this->tag)) {
            Tag::create(['name' => $this->tag]);

            $this->reset('tag');

            session()->flash('message-tag', 'Tag has been created');
        }
    }
}
