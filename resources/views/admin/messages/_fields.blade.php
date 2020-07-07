<div class="form-group">
    <label for="subject">Subject:</label>
    <input type="text" name="subject"
           class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}"
           placeholder="Asundo del mensaje"
           value="{{ old('subject', $message->subject) }}">
    {!! $errors->first('subject', '<div class="invalid-feedback">:message</div>') !!}
</div>
