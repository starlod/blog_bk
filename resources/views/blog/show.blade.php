@extends('layouts.app')

@section('content')

<div class="container markdown-body">
    <h1>{{ $post->title }}</h1>

    <span>
        <i class="fa fa-calendar" aria-hidden="true"></i>
        {{ $post->published_at->format('Y.m.d') }}
    </span>
    <span>
        <i class="fa fa-clock-o" aria-hidden="true"></i>
        {{ $post->updated_at->format('Y.m.d') }}
    </span>
    <span>
        <i class="fa fa-user" aria-hidden="true"></i>
        {{ $post->author->name() }}
    </span>

    <span>
        <i class="fa fa-folder-open" aria-hidden="true"></i>
        {{ $post->category->name }}
    </span>
    <span>
        <i class="fa fa-tags" aria-hidden="true"></i>
        @foreach($post->tags as $tag)
            {{ $tag->name }}
        @endforeach
    </span>

    <div>
        {!! Markdown::convertToHtml($post->content) !!}
    </div>
</div>

@endsection
