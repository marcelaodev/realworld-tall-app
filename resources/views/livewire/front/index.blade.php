<div>
    <div class="home-page">

        <div class="banner">
            <div class="container">
                <h1 class="logo-font">conduit X Ricardo Sawir</h1>
                <p>A place to share your knowledge.</p>
                <p>Implemented by <a style="color:white;text-decoration:underline" target="_blank"
                        href="https://github.com/sawirricardo">Ricardo
                        Sawir</a></p>
            </div>
        </div>

        @if (session()->has('flash.banner'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('flash.banner') }}
                </div>
            </div>
        @endif

        <div class="container page">
            <div class="row">

                <div class="col-md-9">
                    <div class="feed-toggle d-inline-block">
                        <ul class="nav nav-pills outline-active">
                            @auth
                                <li class="nav-item">
                                    <a wire:click="$set('viewingPrivateFeed', true)"
                                        class="nav-link {{ $viewingPrivateFeed && empty($viewingTag) ? 'active' : '' }}"
                                        href="#">Your Feed</a>
                                </li>
                            @endauth
                            <li class="nav-item">
                                <a wire:click="$set('viewingPrivateFeed', false)"
                                    class="nav-link {{ $viewingPrivateFeed || !empty($viewingTag) ? '' : 'active' }}"
                                    href="#">Global Feed</a>
                            </li>
                            @if (!empty($viewingTag))
                                <li class="nav-item">
                                    <a class="nav-link {{ empty($viewingTag) ? '' : 'active' }}"
                                        href="#">{{$viewingTag}}</a>
                                </li>
                            @endif
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
                        <div class="article-preview">
                        </div>
                        <div>No articles found.</div>
                    @endforelse

                </div>

                <div class="col-md-3">
                    <div class="sidebar">
                        <p>Popular Tags</p>

                        <div class="tag-list">
                            @forelse ($tags as $tag)
                                <a wire:click="$set('viewingTagID', {{$tag->id}})" href="#"
                                    class="tag-pill tag-default">{{ $tag->name }}</a>
                            @empty

                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>