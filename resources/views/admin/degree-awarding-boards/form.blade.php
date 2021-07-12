<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('name', old('name'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Degree Awarding Board Name field is required.',
            'required',
        ]) !!}
        @error('name')
            {!! Form::label('name', $message, ['class' => 'error', 'id' => 'name-error']) !!}
        @enderror
        {!! Form::label('name', 'Degree Awarding Board Name', ['class' => 'form-label']) !!}
    </div>
</div>