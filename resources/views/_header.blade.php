<header>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">管理TOP</a>
        </div>

        <div class="collapse navbar-collapse" id="navbarEexample">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('/posts') }}">記事一覧</a></li>
                <li><a href="{{ url('/posts/create') }}">記事投稿</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right hidden-sm">
                @if(Auth::check())
                        <li><a href="{{ url('home') }}">ダッシュボード</a></li>
                @endif
                @if(Auth::guest())
                        <li><a href="{{ url('auth/login') }}">ログイン</a></li>
                @endif
                @if(Auth::guest())
                        <li><a href="{{ url('auth/register') }}">サインアップ</a></li>
                @endif
                @if(Auth::check())
                        <li><a href="{{ url('auth/logout') }}">ログアウト</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
</header>
