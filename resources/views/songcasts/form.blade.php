<div class="{{ $errors->has('song_id') ? 'has-error' : ''}}">
    <label for="song_id">'Song Id'</label>
    <input type="number" name="song_id">
    {!! $errors->first('song_id', '<p>:message</p>') !!}
</div><div class="{{ $errors->has('instrument_user_id') ? 'has-error' : ''}}">
    <label for="instrument_user_id">'Instrument User Id'</label>
    <input type="number" name="instrument_user_id">
    {!! $errors->first('instrument_user_id', '<p>:message</p>') !!}
</div>

<button type="submit">{{isset($submitButtonText) ? $submitButtonText : 'Create'}}</button>
