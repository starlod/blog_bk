<fieldset class="form-group">
    <label class="col-md-2 control-label required">{{ trans('model.posts.title') }}</label>
    <div class="col-md-10">
        {{ Form::text('title', $post->title, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']) }}
    </div>
</fieldset>

<fieldset class="form-group">
    <label class="col-md-2 control-label required">{{ trans('model.posts.body') }}</label>
    <div class="col-md-10">
        {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']) }}
    </div>
</fieldset>
