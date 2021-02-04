<div class="form-group form-float">                             
    <div class="form-line">
        {!! Form::select('fund_category_id', $fundCategories, null, [
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
        {!! Form::text('type', null, [
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
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::hidden('status', '0') !!}
        {!! Form::checkbox('status', '1', isset($subCategory) ? null : true , [
            'class' => 'filled-in',
            'id' => 'status',
        ]) !!}
        {!! Form::label('status', 'Status') !!}
    </div>
</div>