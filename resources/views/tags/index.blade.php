@extends('layouts.app')

@section('content')
<div class="container">

    {{--@include('tags._form_search', [
        'form' => [
            'action' => 'tagController@index',
            'method' => 'GET',
            'class'  => 'form-horizontal',
        ]
    ])--}}

    @if ($tags->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ trans('messages.tags.id') }}</th>
                    <th>{{ trans('messages.tags.name') }}</th>
                    <th>{{ trans('messages.tags.slug') }}</th>
                    <th>{{ trans('messages.tags.count') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ link_to("/tags/$tag->id/edit", $tag->name) }}</td>
                        <td>{{ link_to("/tags/$tag->slug", $tag->slug, ['target' => '_blank']) }}</td>
                        <td>{{ $tag->count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
