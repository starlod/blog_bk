@extends('layouts.app')

@section('content')
<div id="post" class="container">
    <h1 class="title">{{ trans('messages.post') }} {{ trans('messages.actions.edit') }}</h1>

    {{ Form::open(['route' => ['admin.posts.update', $post->id], 'method' => 'POST', 'class' => 'form-horizontal']) }}
        {{ Form::hidden('_method', 'PUT') }}
        @include('admin.posts._form')

        {{ link_to("/posts", trans('messages.buttons.back'), ['class' => 'btn btn-secondary', 'role' => 'button']) }}
        {{ Form::submit(trans('messages.buttons.save'), ['class' => 'btn btn-success', 'role' => 'button']) }}
    {{ Form::close() }}
</div>
@endsection
