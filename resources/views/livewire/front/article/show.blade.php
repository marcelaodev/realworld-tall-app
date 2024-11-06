<div>
    <div class="article-page">

        <div class="banner">
            <div class="container">

                <h1>{{ $article->title }}</h1>

                <div class="article-meta">
                    <a href="{{ route('front.user.show', ['user' => $article->author->username]) }}"><img
                            src="{{ $article->author->image }}" /></a>
                    <div class="info">
                        <a href="{{ route('front.user.show', ['user' => $article->author->username]) }}"
                            class="author">{{ $article->author->name }}</a>
                        <span class="date">{{ $article->created_at }}</span>
                    </div>

                    @guest
                        <a href="{{ route('app.login') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="ion-plus-round"></i>
                            &nbsp;
                            Follow <span class="counter">({{ intval($article->author->followersCountReadable()) }})</span>
                        </a>
                    @endguest

                    @auth
                        @if (auth()->id() !== $article->author->id)
                            <button wire:click='followAuthor' class="btn btn-sm btn-outline-secondary">
                                @if ($user->isFollowing($article->author))
                                    <i class="ion-minus-round"></i>
                                    &nbsp;
                                    Unfollow <span class="counter">({{ intval($article->author->followersCountReadable()) }})</span>
                                @endif

                                @if (!$user->isFollowing($article->author))
                                    <i class="ion-plus-round"></i>
                                    &nbsp;
                                    Follow <span class="counter">({{ intval($article->author->followersCountReadable()) }})</span>
                                @endif
                            </button>
                            &nbsp;&nbsp;
                            <button wire:click='favoriteArticle'
                                class="btn btn-sm {{ $user->hasFavorited($article) ? 'btn-outline-danger' : 'btn-outline-primary' }}">
                                @if ($user->hasFavorited($article))
                                    <i class="ion-thumbsdown"></i>
                                    &nbsp;
                                    Unfavorite Article <span
                                        class="counter">({{ intval($article->favoritersCountReadable()) }})</span>
                                @endif

                                @if (!$user->hasFavorited($article))
                                    <i class="ion-heart"></i>
                                    &nbsp;
                                    Favorite Article <span
                                        class="counter">({{ intval($article->favoritersCountReadable()) }})</span>
                                @endif
                            </button>
                        @endif
                    @endauth

                    @auth
                        @if ($article->author->id === auth()->user()->getAuthIdentifier())
                            <a class="btn btn-sm btn-outline-secondary"
                                href="{{ route('app.article.edit', ['article' => $article->id]) }}">
                                <i class="ion-edit"></i>
                                Edit Article</a>
                            <button type="button" class="btn btn-sm btn-outline-danger" wire:click="deleteArticle"
                                onclick="confirm('Are you sure you want to delete this article?') || event.stopImmediatePropagation()">
                                <i class="ion-trash-a"></i>
                                Delete Article</button>
                        @endif
                    @endauth
                </div>

            </div>
        </div>

        <div class="container page">

            <div class="row article-content">
                <div class="col-md-12">
                    <p>
                        {{ $article->description }}
                    </p>
                    <h2 id="introducing-ionic">{{ $article->title }}</h2>
                    <p>{!! Str::of($article->body)->markdown() !!}</p>
                </div>
            </div>

            <hr />

            <div class="article-actions">
                <div class="article-meta">
                    <a href="{{ route('front.user.show', ['user' => $article->author->username]) }}"><img
                            src="{{ $article->author->image }}" /></a>
                    <div class="info">
                        <a href="{{ route('front.user.show', ['user' => $article->author->username]) }}"
                            class="author">{{ $article->author->name }}</a>
                        <span class="date">{{ $article->created_at }}</span>
                    </div>

                    @guest
                        <a href="{{ route('app.login') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="ion-plus-round"></i>
                            &nbsp;
                            Follow <span class="counter">({{ intval($article->author->followersCountReadable()) }})</span>
                        </a>
                    @endguest

                    @auth
                        @if (auth()->id() !== $article->author->id)
                            <button wire:click='followAuthor' class="btn btn-sm btn-outline-secondary">
                                @if ($user->isFollowing($article->author))
                                    <i class="ion-minus-round"></i>
                                    &nbsp;
                                    Unfollow <span class="counter">({{ intval($article->author->followersCountReadable()) }})</span>
                                @endif

                                @if (!$user->isFollowing($article->author))
                                    <i class="ion-plus-round"></i>
                                    &nbsp;
                                    Follow <span class="counter">({{ intval($article->author->followersCountReadable()) }})</span>
                                @endif
                            </button>
                            &nbsp;&nbsp;
                            <button wire:click='favoriteArticle'
                                class="btn btn-sm  {{ $user->hasFavorited($article) ? 'btn-outline-danger' : 'btn-outline-primary' }}">
                                @if ($user->hasFavorited($article))
                                    <i class="ion-thumbsdown"></i>
                                    &nbsp;
                                    Unfavorite Article <span
                                        class="counter">({{ intval($article->favoritersCountReadable()) }})</span>
                                @endif

                                @if (!$user->hasFavorited($article))
                                    <i class="ion-heart"></i>
                                    &nbsp;
                                    Favorite Article <span
                                        class="counter">({{ intval($article->favoritersCountReadable()) }})</span>
                                @endif
                            </button>
                        @endif
                    @endauth

                    @auth
                        @if ($article->author->id === auth()->id())
                            <a class="btn btn-sm btn-outline-secondary"
                                href="{{ route('app.article.edit', ['article' => $article->id]) }}">
                                <i class="ion-edit"></i>
                                Edit Article</a>
                            <button type="button" class="btn btn-sm btn-outline-danger" wire:click="deleteArticle"
                                onclick="confirm('Are you sure you want to delete this article?') || event.stopImmediatePropagation()">
                                <i class="ion-trash-a"></i>
                                Delete Article</button>
                        @endif
                    @endauth
                </div>
            </div>

            @if (session()->has('flash.banner'))
                <div class="alert alert-success">
                    {{ session('flash.banner') }}
                </div>
            @endif

            <div class="row">

                <div class="col-xs-12 col-md-8 offset-md-2">
                    @auth
                        <x-validation-errors />
                        <form wire:submit.prevent='saveComment' class="card comment-form">
                            <div class="card-block">
                                <textarea wire:model='comment' class="form-control" placeholder="Write a comment..."
                                    rows="3"></textarea>
                            </div>
                            <div class="card-footer">
                                <img src="{{ $user['image'] }}" class="comment-author-img" alt="{{ $user['name'] }}" />
                                <button class="btn btn-sm btn-primary">
                                    Post Comment
                                </button>
                            </div>
                        </form>
                    @endauth
                    @guest
                        <div class="card comment-form p-2">
                            <div class="card-block">
                                <a href="{{ route('app.login') }}">Login</a> to comment this article.
                            </div>
                        </div>
                    @endguest

                    @forelse ($article->comments as $comment)
                        <div class="card">
                            <div class="card-block">
                                <p class="card-text">{{ $comment->body }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-9 align-content-center">
                                        <a href="{{ route('front.user.show', ['user' => $comment->author->username]) }}"
                                            class="comment-author">
                                            <img src="{{ $comment->author->image }}" class="comment-author-img" />
                                        </a>
                                        &nbsp;
                                        <a href="{{ route('front.user.show', ['user' => $comment->author->username]) }}"
                                            class="comment-author">{{ $comment->author->name }}</a>
                                        <span class="date-posted">{{ $comment->created_at }}</span>
                                    </div>
                                    @auth
                                        @if ($comment->author->id === auth()->id())
                                            <div class="class col-md-3">
                                                <button wire:click="deleteComment({{ $comment->id }})"
                                                    class="btn btn-outline-danger float-end">Delete</button>

                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse

                </div>

            </div>

        </div>

    </div>
</div>