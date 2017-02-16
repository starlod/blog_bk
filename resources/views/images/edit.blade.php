@extends('layouts.app')

@section('content')
<div id="category" class="container">
    <h1 class="title">{{ trans('messages.category') }} {{ trans('messages.actions.edit') }}</h1>

    {{ Form::open(['url' => "/categories/$category->id", 'method' => 'category', 'class' => 'well form-horizontal']) }}
        {{ Form::hidden('_method', 'PUT') }}
        @include('categories._form')

        {{ link_to("/categories", trans('messages.buttons.back'), ['class' => 'btn btn-default']) }}
        {{ Form::submit(trans('messages.buttons.save'), ['class' => 'btn btn-success']) }}
    {{ Form::close() }}
</div>
@endsection
