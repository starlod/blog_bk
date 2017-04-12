@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>ログイン</h1>
    </div>
</div>

<div class="container">
    {{ Form::open(['url' => ["/login"], 'method' => 'POST', 'class' => 'form-horizontal']) }}

        @include('components._form_row', [
            'title' => 'メールアドレス',
            'content' => '<input type="email" class="form-control" id="email" name="email" placeholder="メールアドレス" value="' . old('email') . '" required autofocus>',
        ])

        @include('components._form_row', [
            'title' => 'パスワード',
            'content' => '<input type="password" class="form-control" id="password" name="password" placeholder="パスワード" required>',
        ])

        @include('components._form_row_no_label', [
            'content' => '
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> ログイン情報を保持する
                    </label>
                </div>
            ',
        ])

        @include('components._form_row_no_label', [
            'content' => '
                <button type="submit" class="btn btn-secondary">Sign in</button>
            ',
        ])

    {{ Form::close() }}
</div>

@endsection
