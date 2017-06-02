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

    <div id="posts">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>タイトル</th>
                    <th>内容</th>
                    <th>投稿者</th>
                    <th>更新日</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ link_to_route('admin.posts.show', $post->title, $post->id) }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td>{{ $post->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>

@endsection
