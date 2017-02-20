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

    {{ Form::open(['url' => "/images", 'method' => 'POST', 'class' => 'well form-horizontal', 'files' => true]) }}
        <upload></upload>
    {{ Form::close() }}

    @if ($images->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ trans('messages.images.id') }}</th>
                    <th>{{ trans('messages.images.name') }}</th>
                    <th>{{ trans('messages.images.thumbnail') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($images as $image)
                    <tr>
                        <td>{{ $image->id }}</td>
                        <td>{{ $image->name }}</td>
                        <td><img src="{{ $image->url() }}" alt="{{ $image->name }}" width="200" height="150"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
