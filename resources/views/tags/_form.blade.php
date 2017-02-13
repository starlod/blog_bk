<fieldset class="form-group">
    <div class="col-xs-12">
        {{ Form::text('name', $tag->name, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']) }}
    </div>
</fieldset>

<fieldset class="form-group">
    <div class="col-xs-12">
        {{ Form::text('slug', $tag->slug, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
</fieldset>

<fieldset class="form-group">
    <div class="col-xs-12">
        {{ Form::textarea('description', $tag->description, ['class' => 'form-control']) }}
    </div>
</fieldset>
