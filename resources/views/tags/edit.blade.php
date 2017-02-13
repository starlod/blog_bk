@extends('layouts.app')

@section('content')
<div id="tag" class="container">
    <h1 class="title">{{ trans('messages.tag') }} {{ trans('messages.actions.edit') }}</h1>

    {{ Form::open(['url' => "/tags/$tag->id", 'method' => 'tag', 'class' => 'well form-horizontal']) }}
        {{ Form::hidden('_method', 'PUT') }}
        @include('tags._form')

        {{ link_to("/tags", trans('messages.buttons.back'), ['class' => 'btn btn-default']) }}
        {{ Form::submit(trans('messages.buttons.save'), ['class' => 'btn btn-success']) }}
    {{ Form::close() }}
</div>
@endsection
