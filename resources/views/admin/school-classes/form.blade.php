<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('class_number', old('class_number'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Class Number field is required.',
            'required',
        ]) !!}
        @error('class_number')
            {!! Form::label('class_number', $message, ['class' => 'error', 'id' => 'class_number-error']) !!}
        @enderror
        {!! Form::label('class_number', 'Class Number', ['class' => 'form-label']) !!}
    </div>
</div>