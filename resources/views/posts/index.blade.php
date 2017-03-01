@extends('layouts.app')

@section('content')
<div class="container">

    {{--@include('posts._form_search', [
        'form' => [
            'action' => 'PostController@index',
            'method' => 'GET',
            'class'  => 'form-horizontal',
        ]
    ])--}}

    <items url="/posts"></items>
</div>

@endsection
