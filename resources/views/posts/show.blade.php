@extends('app')

@section('content')
<div id="post" class="container">
    <div class="well form-horizontal">
        <h1>{{ trans('model.post') }} {{ trans('common.actions.show') }}</h1>
        <fieldset class="form-post form-inline">
            <label class="col-md-2 control-label">{{ trans('model.posts.title') }}</label>
            <div class="col-md-10">
                <p class="form-control-static">{{ $post->title }}</p class="form-control-static">
            </div>
        </fieldset>

        <fieldset class="form-post form-inline">
            <label class="col-md-2 control-label">{{ trans('model.posts.body') }}</label>
            <div class="col-md-10">
                <p class="form-control-static">{{ $post->body }}</p class="form-control-static">
            </div>
        </fieldset>

        {{ link_to("/posts", trans('common.buttons.back'), ['class' => 'btn btn-default']) }}
        {{ link_to("/posts/$post->id/edit", trans('common.buttons.edit'), ['class' => 'btn btn-warning']) }}
    </div>
</div>
@endsection
