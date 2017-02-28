@extends('layouts.app')

@section('content')
<div class="container">

    {{--@include('images._form_search', [
        'form' => [
            'action' => 'imageController@index',
            'method' => 'GET',
            'class'  => 'form-horizontal',
        ]
    ])--}}

    <items url="/images"></items>
</div>

@endsection
