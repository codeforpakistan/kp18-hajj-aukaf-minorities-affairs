<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('name', old('name'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Qualification Level field is required.',
            'required',
        ]) !!}
        @error('name')
            {!! Form::label('name', $message, ['class' => 'error', 'id' => 'name-error']) !!}
        @enderror
        {!! Form::label('name', 'Qualification Level', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    {{-- <div class="form-line"> --}}
        {!! Form::select('institute_type_id', $instituteTypes, old('institute_type_id'), [
            'class' => 'form-control show-tick',
            'label' => false,
            'placeholder' => 'Select Institute',
            'data-msg-required' => 'The Institute Type field is required.',
            'required'
        ]) !!}
        @error('institute_type_id')
            {!! Form::label('institute_type_id', $message, ['class' => 'error', 'id' => 'institute_type_id-error']) !!}
        @enderror
    {{-- </div> --}}
</div>