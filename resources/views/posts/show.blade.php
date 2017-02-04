@extends('layouts.app')

@section('content')
<div id="post" class="container">
    <h1>{{ $post->title }}</h1>
    <div class="panel panel-default">
        <div class="panel-body">{!! nl2br($post->body) !!}</div>
        <div class="panel-footer">
            {{ Form::open(['url' => ["/posts/$post->id"], 'method' => 'POST']) }}
                {{ link_to("/posts", trans('messages.buttons.back'), ['class' => 'btn btn-default']) }}
                @can('update', $post)
                    {{ link_to("/posts/$post->id/edit", trans('messages.buttons.edit'), ['class' => 'btn btn-warning']) }}
                @endcan
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit(trans('messages.buttons.delete'), ['class' => 'btn btn-danger']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
