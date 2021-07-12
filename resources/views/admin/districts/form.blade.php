<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('name', old('name'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Name field is required.',
            'required',
        ]) !!}
        {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
        @error('name')
            {!! Form::label('name', $message, ['class' => 'error', 'id' => 'name-error']) !!}
        @enderror
    </div>
</div>
        
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('latitude', ('laoldtitude'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Latitude field is required.',
            'required',
        ]) !!}
        {!! Form::label('latitude', 'Latitude', ['class' => 'form-label']) !!}
        @error('latitude')
            {!! Form::label('latitude', $message, ['class' => 'error', 'id' => 'latitude-error']) !!}
        @enderror
    </div>
</div>

<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('longitude', ('lonoldgitude'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Longitude field is required.',
            'required',
        ]) !!}
        {!! Form::label('longitude', 'Longitude', ['class' => 'form-label']) !!}
        @error('longitude')
            {!! Form::label('longitude', $message, ['class' => 'error', 'id' => 'longitude-error']) !!}
        @enderror
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('province', ('proldovince'), [
            'class' => 'form-control',
            'data-msg-required' => 'The Province field is required.',
            'required',
        ]) !!}
        @error('province')
            {!! Form::label('province', $message, ['class' => 'error', 'id' => 'province-error']) !!}
        @enderror
        {!! Form::label('province', 'Province', ['class' => 'form-label']) !!}
    </div>
</div>