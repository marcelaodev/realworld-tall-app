<?php

namespace App\Http\Livewire\App\Article;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Str;
use Livewire\Component;

class Edit extends Component
{
    public \App\Models\Article $article;

    public $tag;

    public $article_tags = [];

    public function mount(\App\Models\Article $article)
    {
        $this->article = $article;
        $this->article_tags = $article->tags->map(function ($tag) {
            return $tag->id;
        });

        SEOTools::setTitle('Edit article', false);
        SEOTools::setDescription('Article is being edited.');
    }

    protected $rules = [
        'article.title' => ['required', 'string'],
        'article.body' => ['required', 'string'],
        'article.description' => ['string'],
        'article_tags' => []
    ];

    public function render()
    {
        return view('livewire.app.article.edit', [
            'tags' => \App\Models\Tag::all(),
        ]);
    }

    public function saveArticle()
    {
        $this->validate();

        $this->article->save();

        $this->article->tags()->sync($this->article_tags);

        session()->flash('flash.banner', 'Your article has been saved!');

        return redirect()->route('front.article.show', ['article' => $this->article->slug]);
    }

    public function createTag()
    {
        $slug = Str::slug($this->tag);
        $tag = \App\Models\Tag::where('slug', '=', $slug)->first();
        if ($tag) {
            session()->flash('message-tag', 'Tag has existed.');

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
