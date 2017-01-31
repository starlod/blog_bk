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
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>

        <div class="collapse navbar-collapse" id="navbarEexample">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('/posts') }}">{{ trans('messages.menu.posts_index') }}</a></li>
                <li><a href="{{ url('/posts/create') }}">{{ trans('messages.menu.posts_create') }}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right hidden-sm">
                @if (Auth::check())
                    <li><a href="{{ url('home') }}">{{ trans('messages.menu.dashboard') }}</a></li>
                @endif
                @if (Auth::guest())
                    <li><a href="{{ url('login') }}">{{ trans('messages.menu.login') }}</a></li>
                    <li><a href="{{ url('register') }}">{{ trans('messages.menu.signup') }}</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ trans('messages.common.welcome', ['name' => Auth::user()->name]) }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ trans('messages.menu.logout') }}
                                </a>

                                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
</header>
