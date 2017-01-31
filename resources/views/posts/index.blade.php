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

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{{ trans('messages.posts.id') }}</th>
                <th>{{ trans('messages.posts.title') }}</th>
                <th>{{ trans('messages.posts.body') }}</th>
                <th class="c-w-8">{{ trans('messages.common.created_at') }}</th>
                <th class="c-w-8">{{ trans('messages.common.updated_at') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ link_to("/posts/$post->id", $post->title) }}</td>
                    <td>{{ strip_tags($post->body) }}</td>
                    <td>{{ fuzzy_time($post->created_at) }}</td>
                    <td>{{ fuzzy_time($post->updated_at) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->render() }}

</div>

@endsection
