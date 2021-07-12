@extends('admin.layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Change Password
                            </h2>
                        </div>
                        <div class="body">
                            {!! Form::open(['route' => ['admin.users.change.password.submit'], 'method' => 'PUT']) !!}
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form::password('old_password', [
                                                'class' => 'form-control',
                                                'id' => 'password-confirm',
                                            ]) !!}
                                            {!! Form::label('old_password', 'Old Password', ['class' => 'form-label']) !!}
                                        </div>
                                        @error('old_password')
                                            {!! Form::label('old_password', $message, ['class' => 'error', 'id' => 'password-error']) !!}
                                        @enderror
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form::password('password', [
                                                'class' => 'form-control',
                                            ]) !!}
                                            {!! Form::label('password', 'New Password', ['class' => 'form-label']) !!}
                                        </div>
                                        @error('password')
                                            {!! Form::label('password', $message, ['class' => 'error', 'id' => 'password-error']) !!}
                                        @enderror
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            {!! Form::password('password_confirmation', [
                                                'class' => 'form-control',
                                                'id' => 'password-confirm',
                                            ]) !!}
                                            {!! Form::label('password', 'Confirm Password', ['class' => 'form-label']) !!}
                                        </div>
                                        @error('password')
                                            {!! Form::label('password', $message, ['class' => 'error', 'id' => 'password-error']) !!}
                                        @enderror
                                    </div>
                                <button class="btn btn-primary waves-effect" type="submit">Update</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>
@endsection