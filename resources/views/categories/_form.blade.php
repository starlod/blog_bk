<fieldset class="form-group">
    <div class="col-xs-12">
        {{ Form::text('name', $category->name, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '255']) }}
    </div>
</fieldset>

<fieldset class="form-group">
    <div class="col-xs-12">
        {{ Form::text('slug', $category->slug, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
</fieldset>

<fieldset class="form-group">
    <div class="col-xs-12">
        {{ Form::select('parent_id', $categories, null, ['class' => 'form-control']) }}
    </div>
</fieldset>

<fieldset class="form-group">
    <div class="col-xs-12">
        {{ Form::textarea('description', $category->description, ['class' => 'form-control']) }}
    </div>
</fieldset>
