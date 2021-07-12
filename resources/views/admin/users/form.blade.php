<div class="form-group form-float">
    <div class="form-line">
        {!! Form::select('role_id', $roles, null, [
            'class' => 'form-control show-tick',
            'label' => false,
            'placeholder' => 'Select Role',
            'data-msg-required' => 'The Role field is required.',
            'required'
        ]) !!}
        @error('role_id')
            {!! Form::label('role_id', $message, ['class' => 'error', 'id' => 'role_id-error']) !!}
        @enderror
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('name', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Name field is required.',
            'required',
        ]) !!}
        @error('name')
            {!! Form::label('name', $message, ['class' => 'error', 'id' => 'name-error']) !!}
        @enderror
        {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('email', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Email field is required.',
            'required',
        ]) !!}
        @error('email')
            {!! Form::label('email', $message, ['class' => 'error', 'id' => 'email-error']) !!}
        @enderror
        {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('phone', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Phone No is required.',
            'required',
        ]) !!}
        @error('phone')
            {!! Form::label('phone', $message, ['class' => 'error', 'id' => 'phone-error']) !!}
        @enderror
        {!! Form::label('phone', 'Phone No', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('address', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Address is required.',
            'required',
        ]) !!}
        @error('address')
            {!! Form::label('address', $message, ['class' => 'error', 'id' => 'address-error']) !!}
        @enderror
        {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        <?php
            $_rules = [
                'class' => 'form-control',
                'data-msg-required' => 'The Password is required.',
            ];

            if(@$user_create){
                $_rules[] = 'required';
            }

        ?>
        {!! Form::password('password', $_rules) !!}
        @error('password')
            {!! Form::label('password', $message, ['class' => 'error', 'id' => 'password-error']) !!}
        @enderror
        {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
    </div>
</div>