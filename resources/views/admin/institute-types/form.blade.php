<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('type', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Institute Type field is required.',
            'required',
        ]) !!}
        {!! Form::label('type', 'Institute Type', ['class' => 'form-label']) !!}
        @error('type')
            {!! Form::label('type', $message, ['class' => 'error', 'id' => 'type-error']) !!}
        @enderror
    </div>
</div>