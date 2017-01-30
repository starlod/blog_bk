@extends('app')

@section('content')
<div id="post" class="container">
    <h1 class="title">{{ trans('model.post') }} {{ trans('common.actions.create') }}</h1>

    {{ Form::open(['url' => "/posts", 'method' => 'POST', 'class' => 'well form-horizontal']) }}
        @include('posts._form')

        {{ link_to("/posts", trans('common.buttons.back'), ['class' => 'btn btn-default']) }}
        {{ Form::submit(trans('common.buttons.save'), ['class' => 'btn btn-success']) }}
    {{ Form::close() }}
</div>
@endsection
