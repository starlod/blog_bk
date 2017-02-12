@extends('layouts.app')

@section('content')
<div class="container">

    {{--@include('categories._form_search', [
        'form' => [
            'action' => 'categoryController@index',
            'method' => 'GET',
            'class'  => 'form-horizontal',
        ]
    ])--}}

    @if ($categories->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ trans('messages.categories.id') }}</th>
                    <th>{{ trans('messages.categories.name') }}</th>
                    <th>{{ trans('messages.categories.slug') }}</th>
                    <th>{{ trans('messages.categories.count') }}</th>
                    <th>{{ trans('messages.categories.parent_id') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ link_to("/categories/$category->id/edit", $category->name) }}</td>
                        <td>{{ link_to("/categories/$category->slug", $category->slug, ['target' => '_blank']) }}</td>
                        <td>{{ $category->count() }}</td>
                        <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
