<div>
    <div>
        <div class="editor-page">
            <div class="container page">
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-xs-12">
                        <x-validation-errors />

                        @if (session()->has('flash.banner'))
                            <div class="alert alert-success">
                                {{ session('flash.banner') }}
                            </div>
                        @endif
                        <form>
                            <fieldset class="form-group">
                                <input wire:model.live='article.title' type="text" class="form-control form-control-lg"
                                    placeholder="Article Title">
                            </fieldset>
                            <fieldset class="form-group">
                                <input wire:model.live='article.description' type="text" class="form-control"
                                    placeholder="What's this article about?">
                            </fieldset>
                            <fieldset class="form-group">
                                <textarea wire:model.live='article.body' class="form-control" rows="8"
                                    placeholder="Write your article (in markdown)"></textarea>
                            </fieldset>
                            <div class="row">
                                @forelse ($tags as $tag)
                                    <div wire:key='{{ $tag->id }}' class="col-xs-4 col-md-2">
                                        <fieldset class="form-group">
                                            <label for="tag_{{ $tag->slug }}">
                                                <input id="tag_{{ $tag->slug }}" class="form-checkbox" type="checkbox"
                                                    name="tag" value="{{ $tag->id }}" wire:model.live='article_tags' />
                                                {{ $tag->name }}
                                            </label>
                                        </fieldset>
                                    </div>
                                @empty

                                @endforelse
                            </div>
                            <fieldset class="form-group">
                                @if (session()->has('message-tag'))
                                    <div class="alert alert-success">
                                        {{ session('message-tag') }}
                                    </div>
                                @endif
                                <input type="text" class="form-control" placeholder="Enter new tag"
                                    wire:model.live='tag'>
                                <button class="btn btn-secondary my-2" type="button" wire:click="createTag">Create
                                    Tag</button>
                            </fieldset>

                            <button class="btn btn-lg pull-xs-right btn-primary mx-1" type="button"
                                wire:click='saveArticle'>
                                Save Article
                            </button>
                            <a wire:navigate class="btn btn-lg pull-xs-right btn-secondary mx-1"
                                href="{{ route('article.show', ['article' => $article->slug]) }}">
                                Cancel
                            </a>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>