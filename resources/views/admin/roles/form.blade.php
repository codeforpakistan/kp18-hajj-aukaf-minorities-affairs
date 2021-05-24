<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('name', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Role Name is required.',
            'required',
        ]) !!}
        {!! Form::label('name', 'Role Name', ['class' => 'form-label']) !!}
        @error('name')
            {!! Form::label('name', $message, ['class' => 'error', 'id' => 'name-error']) !!}
        @enderror
    </div>
</div>