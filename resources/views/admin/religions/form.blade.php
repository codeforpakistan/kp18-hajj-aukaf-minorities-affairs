<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('religion_name', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Religion Name field is required.',
            'required',
        ]) !!}
        {!! Form::label('religion_name', 'Religion Name', ['class' => 'form-label']) !!}
        @error('religion_name')
            {!! Form::label('religion_name', $message, ['class' => 'error', 'id' => 'religion_name-error']) !!}
        @enderror
    </div>
</div>