@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>プロフィールの編集</h1>
    </div>
</div>

<div id="profile" class="container">
    {{ Form::open(['url' => ["/profile"], 'method' => 'PUT', 'class' => 'form-horizontal']) }}

        @include('components._form_row', [
            'title' => trans('messages.users.name'),
            'content' => Form::text('name', $user->name, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']),
        ])

        @include('components._form_row_word', [
            'title' => trans('messages.roles.name'),
            'content' => trans('messages.roles.names.' . $user->role->name),
        ])

        @include('components._form_row', [
            'title' => trans('messages.users.email'),
            'content' => Form::text('email', $user->email, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']),
        ])

        <div class="actions">
            {{ link_to("/", trans('messages.buttons.home'), ['class' => 'btn btn-secondary']) }}
            {{ Form::submit(trans('messages.buttons.update'), ['class' => 'btn btn-primary', 'role' => 'button']) }}
        </div>

    {{ Form::close() }}
</div>
@endsection
