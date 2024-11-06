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

        <div class="container page">
            <div class="row">

                <div class="col-md-9">
                    <div class="feed-toggle">
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
                                <a href="{{ route('front.user.show', ['user' => $article->author->username]) }}"><img
                                        src="{{ $article->author->image }}" /></a>
                                <div class="info">
                                    <a href="{{ route('front.user.show', ['user' => $article->author->username]) }}"
                                        class="author">{{ $article->author->name }}</a>
                                    <span class="date">{{ $article->created_at }}</span>
                                </div>
                                {{-- <button class="btn btn-outline-primary btn-sm pull-xs-right">
                                    <i class="ion-heart"></i> {{ $article->favoritersCountReadable() }}
                                </button> --}}
                            </div>
                            <a href="{{ route('front.article.show', ['article' => $article->slug]) }}" class="preview-link">
                                <h1>{{ $article->title }}</h1>
                                <p>{{ $article->description }}</p>
                                <span>Read more...</span>
                            </a>
                        </div>
                    @empty
                        <div>No articles found. Why don't you start following someone?</div>
                    @endforelse

                    {{-- <div class="article-preview">
                        <div class="article-meta">
                            <a href="profile.html"><img src="http://i.imgur.com/N4VcUeJ.jpg" /></a>
                            <div class="info">
                                <a href="" class="author">Albert Pai</a>
                                <span class="date">January 20th</span>
                            </div>
                            <button class="btn btn-outline-primary btn-sm pull-xs-right">
                                <i class="ion-heart"></i> 32
                            </button>
                        </div>
                        <a href="" class="preview-link">
                            <h1>The song you won't ever stop singing. No matter how hard you try.</h1>
                            <p>This is the description for the post.</p>
                            <span>Read more...</span>
                        </a>
                    </div> --}}

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
                            {{-- <a href="" class="tag-pill tag-default">programming</a>
                            <a href="" class="tag-pill tag-default">javascript</a>
                            <a href="" class="tag-pill tag-default">emberjs</a>
                            <a href="" class="tag-pill tag-default">angularjs</a>
                            <a href="" class="tag-pill tag-default">react</a>
                            <a href="" class="tag-pill tag-default">mean</a>
                            <a href="" class="tag-pill tag-default">node</a>
                            <a href="" class="tag-pill tag-default">rails</a> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
