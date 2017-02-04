@extends('layouts.app')

@section('content')
<div id="profile" class="container">
    <h2>パスワード変更</h2>
    {{ Form::open(['url' => ["/change_password"], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
        <div class="panel panel-default">
            <div class="panel-body">
                <fieldset class="form-group">
                    <label for="password" class="col-sm-2 control-label text-right">{{ trans('messages.users.current_password') }}</label>
                    <div class="col-sm-10">
                        {{ Form::password('current_password', ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']) }}
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <label for="password" class="col-sm-2 control-label text-right">{{ trans('messages.users.password') }}</label>
                    <div class="col-sm-10">
                        {{ Form::password('password', ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']) }}
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <label for="password_confirmation" class="col-sm-2 control-label text-right">{{ trans('messages.users.password_confirmation') }}</label>
                    <div class="col-sm-10">
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']) }}
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
