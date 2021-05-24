<div class="form-group form-float">
    <div class="form-line">
       {!! Form::text('discipline', null, [
           'class' => 'form-control',
           'data-msg-required' => 'The Discipline Name field is required.',
           'required',
       ]) !!}
       @error('discipline')
           {!! Form::label('discipline', $message, ['class' => 'error', 'id' => 'discipline-error']) !!}
       @enderror
       {!! Form::label('discipline', 'Discipline Name', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::select('qualification_level_id', $qualificationLevels, null, [
            'class' => 'form-control show-tick',
            'label' => false,
            'placeholder' => 'Select Qualification Level',
            'data-msg-required' => 'The Qualification Level field is required.',
            'required'
        ]) !!}
        @error('qualification_level_id')
            {!! Form::label('qualification_level_id', $message, ['class' => 'error', 'id' => 'qualification_level_id-error']) !!}
        @enderror
    </div>
</div>