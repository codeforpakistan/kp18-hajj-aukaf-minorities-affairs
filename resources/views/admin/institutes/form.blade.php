<div class="form-group form-float">
    <div class="form-line">
        {!! Form::select('institute_type_id', $instituteTypes, old('institute_type_id'), [
            'class' => 'form-control show-tick',
            'label' => false,
            'placeholder' => 'Select Institute Type',
            'data-msg-required' => 'The Institute Type field is required.',
            'required'
        ]) !!}
        @error('institute_type_id')
            {!! Form::label('institute_type_id', $message, ['class' => 'error', 'id' => 'institute_type_id-error']) !!}
        @enderror
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('name', old('name'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Institute Name field is required.',
            'required',
        ]) !!}
        @error('name')
            {!! Form::label('name', $message, ['class' => 'error', 'id' => 'name-error']) !!}
        @enderror
        {!! Form::label('name', 'Institute Name', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::select('city_id', $cities, old('city_id'), [
            'class' => 'form-control show-tick',
            'label' => false,
            'placeholder' => 'Select City',
            'data-msg-required' => 'The City field is required.',
            'required'
        ]) !!}
        @error('city_id')
            {!! Form::label('city_id', $message, ['class' => 'error', 'id' => 'city_id-error']) !!}
        @enderror
    </div>
</div>

<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('institute_sector', old('institute_sector'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Institute Sector field is required.',
            'required',
        ]) !!}
        @error('institute_sector')
            {!! Form::label('institute_sector', $message, ['class' => 'error', 'id' => 'institute_sector-error']) !!}
        @enderror
        {!! Form::label('institute_sector', 'Institute Sector', ['class' => 'form-label']) !!}
    </div>
</div>

<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('address', old('address'), [
            'class' => 'form-control',
        ]) !!}
        @error('address')
            {!! Form::label('address', $message, ['class' => 'error', 'id' => 'address-error']) !!}
        @enderror
        {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}
    </div>
</div>