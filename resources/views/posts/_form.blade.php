<fieldset class="form-group">
    <div class="col-xs-12">
        {{ Form::text('title', $post->title, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']) }}
    </div>
</fieldset>

<fieldset class="form-group">
    <div class="col-xs-12">
        {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
</fieldset>
