@extends('layouts.auth')

@section('content')
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        {{-- <?= $this->Flash->render() ?> --}}
        <!-- Login Box -->
        <div class="box">
            <div class="content">
                <div class="col-lg-12">
                    <img src="{{ asset('img/logo.png') }}" class="img img-responsive" style="margin-top: 10px;">
                    <br/>
                </div>

                <h3 class="form-title" style="color: #057822;">{{ env('APP_NAME') }}</h3>
                {!! Form::open(['route' => 'login', 'method' => 'POST', 'files' => true, 'class' => 'form-horizontal login-form']) !!}
                    <!-- Title -->
                    <h3 class="form-title" style="color: #057822;margin: 10px 0px;">Sign In</h3>
                    <!-- Error Message -->
                    <div class="alert fade in alert-danger" style="display: none;">
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        Enter any email and password.
                    </div>

                    <!-- Input Fields -->
                    <div class="form-group">
                        {!! Form::email('email', old('email'), ['id' => 'login_email', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Email address', "data-rule-required" => "true", 'data-rule-email' => 'true']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Password', 'data-rule-required' => 'true']) !!}
                    </div>
                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a class="back pull-left" data-toggle="modal" data-target="#myModal" href="#" style="padding: 6px 0px;text-decoration:underline;font-size:14px;color:green;">Forgot Password?</a>
                        {!! Form::submit('Sign In', ['name' => 'login', 'escape' => false, 'class' => 'btn btn-success pull-right']) !!}
                    </div>
                {!! Form::close() !!}
                {!! Form::open(['route' => 'login', 'method' => 'POST', 'files' => true, 'class' => 'form-horizontal register-form', 'id' => 'register_form', 'style' => "display: none;"]) !!}
                    <h3 class="form-title">Sign Up</h3>
                    <div class="form-group">
                        {!! Form::email('email', old('email'), ['id' => 'email', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Email address', "data-rule-required" => "true", 'data-rule-email' => 'true']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Password', 'id' => 'register_password', 'data-rule-required' => 'true']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password_confirmation', ['label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => 'Confirm Password', 'id' => 'password-confirm', "data-rule-equalTo" => "#register_password", 'data-rule-required' => 'true']) !!}
                    </div>
                    {!! Form::hidden('error', null, ['secure' => false, 'id' => 'error_field']) !!}
                    <div class="form-actions">
                        <a class="back pull-left" style="padding: 8px 0px;text-decoration:underline;font-size:14px;color:green;cursor: pointer">
                            <!--<i class="icon-angle-left"></i>--> 
                            Login to your Account
                        </a>
                        {!! Form::submit('Sign Up', ['name' => 'register', 'escape' => false, 'class' => 'btn btn-success pull-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div> 
            <!-- /.content -->
        </div>
        <!-- Footer -->
        <div class="footer" style="background-color:#F9F9F9;padding: unset;">
            <a href="#" class="sign-up">
                <br/>
                Don't have an account yet? <strong>Sign Up</strong>
                <br/><br/>
            </a>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                    <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding: 10px 15px;">
                        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                        <h4 class="modal-title" style="font-size: 13px;">Enter an email address</h4>
                    </div>
                    {!! Form::open(['route' => 'password.email', 'method' => 'POST', 'files' => true]) !!}
                        <div class="modal-body" style="padding: 10px 20px;">
                            <div class="form-group">
                                {!! Form::email('email', old('email'), ['label' => false, 'class' => 'form-control', 'placeholder' => 'Email address', "data-rule-required" => "true", 'data-rule-email' => 'true', 'style' => 'margin-top:10px;']) !!}
                            </div>
                        </div>
                        <div class="modal-footer" style="padding:10px 20px 15px;">
                            {!! Form::submit('Submit', ['name' => 'register', 'forgot' => false, 'class' => 'btn btn-success btn-sm']) !!}
                            {!! Form::button('Close', ['data-dismiss' => 'modal', 'class' => 'btn btn-success btn-sm']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3"></div>
    <script>
        $(function () {
            $('#register_form').submit(function () {
                var email = $('#error_field').val();
                var pass = $('#register_password').val();
                if (email == 1) {
                    return false;
                }
                if (pass.length < 8) {
                    $('#pass_error').text('Password must be at least 8 characters long.');
                    return false;
                }
                return(true);
            });
        });
    </script>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
