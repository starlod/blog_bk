@extends('app')

@section('content')
<div id="post" class="container">
    <h1>{{ trans('model.post') }} {{ trans('common.actions.edit') }}</h1>
    {{ Form::open(['url' => "/posts/$post->id", 'method' => 'POST', 'class' => 'form-horizontal']) }}
        {{ Form::hidden('_method', 'PUT') }}
        @include('posts._form')

        {{ link_to("/posts", trans('common.buttons.back'), ['class' => 'btn btn-default']) }}
        {{ Form::submit(trans('common.buttons.save'), ['class' => 'btn btn-success']) }}
    {{ Form::close() }}
</div>
@endsection
