@extends('layouts.app')

@section('content')
<div class="container">
    <ul>
        @foreach ($posts as $post)
            <li>{{ link_to_route('blog.show', $post->title, $post->id) }}</li>
        @endforeach
    </ul>
</div>
@endsection
