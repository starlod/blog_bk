@extends('app')

@section('content')
<div id="post" class="container">
    <h1>{{ $post->title }}</h1>
    <div class="panel panel-default">
        <div class="panel-body">{!! $post->body !!}</div>
        <div class="panel-footer">
            {{ Form::open(['url' => ["/posts/$post->id"], 'method' => 'POST']) }}
                {{ link_to("/posts", trans('common.buttons.back'), ['class' => 'btn btn-default']) }}
                {{ link_to("/posts/$post->id/edit", trans('common.buttons.edit'), ['class' => 'btn btn-warning']) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit(trans('common.buttons.delete'), ['class' => 'btn btn-danger']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
