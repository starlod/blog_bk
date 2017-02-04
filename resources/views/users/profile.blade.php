@extends('layouts.app')

@section('content')
<div id="profile" class="container">
    <h2>プロフィールの編集</h2>
    {{ Form::open(['url' => ["/profile"], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
        <div class="panel panel-default">
            <div class="panel-body">
                <fieldset class="form-group">
                    <label for="name" class="col-sm-2 control-label text-right">{{ trans('messages.users.name') }}</label>
                    <div class="col-sm-10">
                        {{ Form::text('name', $user->name, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']) }}
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <label for="email" class="col-sm-2 control-label text-right">{{ trans('messages.users.email') }}</label>
                    <div class="col-sm-10">
                        {{ Form::text('email', $user->email, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']) }}
                    </div>
                </fieldset>
            </div>
            <div class="panel-footer">
                {{ link_to("/", trans('messages.buttons.home'), ['class' => 'btn btn-default']) }}
                {{ Form::submit(trans('messages.buttons.update'), ['class' => 'btn btn-warning']) }}
            </div>
        </div>
    {{ Form::close() }}
</div>
@endsection
