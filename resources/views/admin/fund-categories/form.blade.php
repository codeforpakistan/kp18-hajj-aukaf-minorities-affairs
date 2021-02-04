<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('type_of_fund', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Fund Category Name field is required.',
            'required',
        ]) !!}
        @error('type_of_fund')
            {!! Form::label('type_of_fund', $message, ['class' => 'error', 'id' => 'type_of_fund-error']) !!}
        @enderror
        {!! Form::label('type_of_fund', 'Fund Category Name', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('description', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Description field is required.',
            'required',
        ]) !!}
        @error('description')
            {!! Form::label('description', $message, ['class' => 'error', 'id' => 'description-error']) !!}
        @enderror
        {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
    </div>
</div>