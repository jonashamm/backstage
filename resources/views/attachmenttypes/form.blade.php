<div class="{{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name">Name</label>
    <input type="text" name="name">
    {!! $errors->first('name', '<p>:message</p>') !!}
</div>

<button type="submit">{{isset($submitButtonText) ? $submitButtonText : 'Create'}}</button>
