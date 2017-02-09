<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
    <main class="top-posts">
        @foreach($posts as $post)
            <div class="posts">
                <h2 class="post-title">{{ link_to("/posts/$post->id", $post->title) }}</h2>
                <div class="post-meta">
                    <ul class="list-inline">
                        <li><i class="fa fa-pencil" aria-hidden="true"></i> {{ $post->author->name() }}</li>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> <time pubdate="{{ $post->created_at }}">{{ $post->created_at->format('Y.m.d') }}</time></li>
                        <li><i class="fa fa-folder-open" aria-hidden="true"></i> ブログ</li>
                    </ul>
                </div>
                <div class="post-content">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ url('/posts/' . $post->id) }}">
                                <img src="https://placehold.jp/250x150.png" alt="">
                            </a>
                        </div>
                        <div class="col-md-8">
                            {{ $post->body }}
                            <div class="rmlink">
                                {{ link_to("/posts/$post->id", 'もっと見る') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
</div>
