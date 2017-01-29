@extends('app')

@section('content')
<div class="container">
    <h1>{{ trans('model.post') }} {{ trans('common.actions.index') }}</h1>

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
                <th>{{ trans('model.posts.id') }}</th>
                <th>{{ trans('model.posts.title') }}</th>
                <th>{{ trans('model.posts.body') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>
                        {{ link_to("/posts/$post->id", trans('common.buttons.show'), ['class' => 'btn btn-primary']) }}
                        {{ link_to("/posts/$post->id/edit", trans('common.buttons.edit'), ['class' => 'btn btn-warning']) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->render() }}
</div>

@endsection
