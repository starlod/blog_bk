@extends('layouts.app')

@section('content')

<div id="post" class="container">
    <h1 class="title">{{ $post->title }}</h1>

    <div>{{ $post->content }}</div>

    {{ link_to_route('admin.posts.edit', trans('messages.buttons.edit'), $post->id, ['class' => 'btn btn-secondary', 'role' => 'button']) }}
</div>

@endsection
