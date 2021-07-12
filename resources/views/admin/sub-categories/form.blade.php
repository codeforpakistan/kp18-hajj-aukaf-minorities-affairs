<div class="form-group form-float">                             
    <div class="form-line">
        {!! Form::select('fund_category_id', $fundCategories, old('fund_category_id'), [
            'class' => 'form-control show-tick',
            'label' => false,
            'placeholder' => 'Select Fund Category',
            'data-msg-required' => 'The Fund Category Name field is required.',
            'required',
        ]) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('type', old('type'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Fund Sub Category Name field is required.',
            'required',
        ]) !!}
        @error('type')
            {!! Form::label('type', $message, ['class' => 'error', 'id' => 'type-error']) !!}
        @enderror
        {!! Form::label('type', 'Fund Sub Category Name', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('description', old('description'), [
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
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::checkbox('status', '1', old('status'), [
            'class' => 'filled-in',
            'id' => 'status',
        ]) !!}
        {!! Form::label('status', 'Status') !!}
    </div>
</div>