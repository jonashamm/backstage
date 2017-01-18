<div class="{{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name">Name</label>
    <input type="text" name="name">
    <label for="typical_extension">Endung</label>
    <input type="text" name="typical_extension">
    {!! $errors->first('name', '<p>:message</p>') !!}
</div>

<button type="submit">{{isset($submitButtonText) ? $submitButtonText : 'Create'}}</button>
