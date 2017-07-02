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

    @if (auth()->user())
        <span>
            {{ link_to_route('admin.posts.edit', __('messages.buttons.edit'), $post->id, ['class' => 'btn btn-warning btn-sm', 'role' => 'button']) }}
        </span>
    @endif

    <div>
        {!! $post->parse() !!}
    </div>

    <h2>コメント</h2>

    <div class="comments">
        <div class="comment-list">
            @foreach ($post->comments as $comment)
                <div class="comment">
                    <span>{{ $comment->name }}</span>
                    {!! $comment->parse() !!}
                </div>
            @endforeach
        </div>
        <div class="comment-form">
            {{ Form::open(['route' => ['comments.store', $post->id]]) }}
                <div>{{ Form::hidden('post_id', $post->id) }}</div>
                <div>{{ Form::text('name') }}</div>
                <div>{{ Form::textarea('content') }}</div>
                {{ Form::submit(__('messages.buttons.write_comment')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection
