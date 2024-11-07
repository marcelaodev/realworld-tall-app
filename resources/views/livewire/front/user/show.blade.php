<div>
    <div class="profile-page">

        <div class="user-info">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 col-md-10 offset-md-1">
                        <img src="{{ $user->image }}" class="user-img" />
                        <h4>{{ $user->name }}</h4>
                        <p>
                            {{ $user->bio }}
                        </p>
                        @guest
                            <a wire:navigate href="{{ route('app.login') }}"
                                class="btn btn-sm btn-outline-secondary action-btn">
                                <i class="ion-plus-round"></i>
                                &nbsp;
                                Follow <span class="counter">({{ intval($user->followersCountReadable()) }})</span>
                            </a>
                        @endguest

                        @auth
                            @if (auth()->id() !== $user->id)
                                <button wire:click='followUser' class="btn btn-sm btn-outline-secondary action-btn">
                                    @if ($loggedInUser->isFollowing($user))
                                        <i class="ion-minus-round"></i>
                                        &nbsp;
                                        Unfollow <span class="counter">({{ intval($user->followersCountReadable()) }})</span>
                                    @endif

                                    @if (!$loggedInUser->isFollowing($user))
                                        <i class="ion-plus-round"></i>
                                        &nbsp;
                                        Follow <span class="counter">({{ intval($user->followersCountReadable()) }})</span>
                                    @endif
                                </button>
                            @endif

                            @if (session()->has('flash.banner'))
                                <div class="alert alert-success">
                                    {{ session('flash.banner') }}
                                </div>
                            @endif
                        @endauth
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-md-10 offset-md-1">
                    <div class="articles-toggle">
                        <ul class="nav nav-pills outline-active">
                            <li class="nav-item">
                                <button class="nav-link {{ $viewingFavoriteArticles ? '' : 'active' }}"
                                    wire:click="$toggle('viewingFavoriteArticles')">
                                    Articles</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link {{ $viewingFavoriteArticles ? 'active' : '' }}"
                                    wire:click="$toggle('viewingFavoriteArticles')">Favorited
                                    Articles</button>
                            </li>
                        </ul>
                    </div>

                    @forelse ($articles as $article)
                        <div class="article-preview">
                            <div class="article-meta">
                                <a wire:navigate
                                    href="{{ route('front.user.show', ['user' => $article->author->username]) }}"><img
                                        src="{{ $article->author->image }}" /></a>
                                <div class="info">
                                    <a wire:navigate
                                        href="{{ route('front.user.show', ['user' => $article->author->username]) }}"
                                        class="author">{{ $article->author->name }}</a>
                                    <span class="date">{{ $article->created_at }}</span>
                                </div>

                            </div>
                            <a wire:navigate href="{{ route('front.article.show', ['article' => $article->slug]) }}"
                                class="preview-link">
                                <h1>{{ $article->title }}</h1>
                                <p>{{ $article->description }}</p>
                                <span>Read more...</span>
                            </a>
                        </div>
                    @empty
                        <div class="article-preview"></div>
                        <div>{{ $user->name }} has not favorited any article yet.</div>
                    @endforelse


                </div>

            </div>
        </div>

    </div>
</div>