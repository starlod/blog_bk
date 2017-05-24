<!-- きさま！見ているなッ! -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset_ver('css/app.css') }}">
    @yield('stylesheets')
</head>
<body>

<div id="app" v-cloak>
    @include('_header')
    @include('_messages')
    <div class="content">
        @yield('content')
    </div>
    @include('_footer')
</div>

@yield('pre_javascripts')
<script id="script" type="text/javascript" src="{{ asset_ver('js/app.js') }}"></script>
@yield('post_javascripts')
</body>
</html>
