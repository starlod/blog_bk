@extends('layouts.app')

@section('content')
<div id="post" class="container">
    <h1>{{ $post->title }}</h1>
    <div class="panel panel-default">
        <div class="panel-body">{!! nl2br($post->content) !!}</div>
        <div class="panel-footer">
            {{ Form::open(['url' => ["/posts/$post->id"], 'method' => 'DELETE']) }}
                {{ link_to("/posts", trans('messages.buttons.back'), ['class' => 'btn btn-default']) }}
                @can ('update', $post)
                    {{ link_to("/posts/$post->id/edit", trans('messages.buttons.edit'), ['class' => 'btn btn-warning']) }}
                @endcan
                @can ('destroy', $post)
                    {{ Form::submit(trans('messages.buttons.delete'), ['class' => 'btn btn-danger']) }}
                @endcan
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
