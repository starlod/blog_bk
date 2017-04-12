<header>
<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ active('/posts') }}">
                <a class="nav-link" href="{{ url('/posts') }}"><i class="fa fa-list" aria-hidden="true"></i> {{ trans('messages.menu.posts_index') }}</a>
            </li>
            <li class="nav-item {{ active('/gallery') }}">
                <a class="nav-link" href="{{ url('/gallery') }}"><i class="fa fa-picture-o" aria-hidden="true"></i> {{ trans('messages.menu.gallery') }}</a>
            </li>
            @can('create', 'App\Post')
                <li class="nav-item {{ active('/posts/create') }}">
                    <a class="nav-link" href="{{ url('/posts/create') }}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ trans('messages.menu.posts_create') }}
                    </a>
                </li>
            @endcan
            @can('create', App\Link::class)
                <li class="nav-item {{ active('/gallery') }}">
                    <a class="nav-link" href="{{ url('/images') }}">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> {{ trans('messages.menu.images_index') }}
                    </a>
                </li>
            @endcan
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="nav navbar-nav pull-xs-right">
            @if (Auth::guest())
                <li><a class="nav-link" href="{{ url('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> {{ trans('messages.menu.login') }}</a></li>
                <li><a class="nav-link" href="{{ url('register') }}"><i class="fa fa-heart" aria-hidden="true"></i> {{ trans('messages.menu.signup') }}</a></li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ trans('messages.common.welcome', ['name' => Auth::user()->name]) }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a href="{{ url('/profile') }}" class="dropdown-item {{ active('/profile') }}">
                            <i class="fa fa-user-circle" aria-hidden="true"></i> {{ trans('messages.menu.profile') }}
                        </a>
                        <a href="{{ url('/change_password') }}" class="dropdown-item {{ active('/change_password') }}">
                            <i class="fa fa-cog" aria-hidden="true"></i> {{ trans('messages.menu.change_password') }}
                        </a>
                        <a href="{{ url('/logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> {{ trans('messages.menu.logout') }}
                        </a>
                        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
</header>
