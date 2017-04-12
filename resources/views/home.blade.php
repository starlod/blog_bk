@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>ダッシュボード</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('messages.title.dashboard') }}</div>
                <div class="panel-body">
                    {{ trans('messages.common.welcome', ['name' => Auth::user()->name]) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
