<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('status', old('status'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Status field is required.',
            'required',
        ]) !!}
        @error('status')
            {!! Form::label('status', $message, ['class' => 'error', 'id' => 'status-error']) !!}
        @enderror
        {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
    </div>
</div>