@extends('layouts.app')

@section('content')
<div id="post" class="container">
    <h1 class="title">{{ trans('messages.post') }} {{ trans('messages.actions.create') }}</h1>

    {{ Form::open(['route' => 'admin.posts.store', 'method' => 'POST', 'class' => 'form-horizontal']) }}
        @include('admin.posts._form')

        {{ link_to_route('admin.posts.index', trans('messages.buttons.back'), [], ['class' => 'btn btn-secondary', 'role' => 'button']) }}
        {{ Form::submit(trans('messages.buttons.save'), ['class' => 'btn btn-success']) }}
    {{ Form::close() }}
</div>
@endsection
