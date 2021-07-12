@extends('layouts.auth')
@section('content')
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="box">
            <div class="content">
                <div class="col-lg-12">
                    <img src="{{ asset('img/logo.png') }}" class="img img-responsive" style="margin-top: 10px;">
                    <br/>
                </div>
                <h3 class="form-title" style="color: #057822;">{{ env('APP_NAME') }}</h3>
                <form action="{{route('password.email')}}" method="POST" class="form-horizontal login-form" id="login-form">
                    @csrf
                    <!-- Title -->
                    <h3 class="form-title" style="color: #057822;margin: 10px 0px;font-size: 15px;">Reset Password</h3>
                    @if(session()->has('status'))
                        <!-- Success Message -->
                        <div class="alert fade in alert-success">
                            <i class="icon-remove close" data-dismiss="alert"></i>
                            {{  session('status') }}
                        </div>
                        
                    @endif
                    <!-- Input Fields -->
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <div class="input-icon">
                            <i class="icon-envelope"></i>
                            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}" placeholder="Email address">
                            @error('email')
                                <label for="email" class="has-error help-block">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>
                    </div>
                    <!-- Form Actions -->
                    <div class="form-actions text-center">
                        <input type="submit" name="login" class="btn btn-success" value="Send Password Reset Link">
                    </div>
                </form>
            </div> 
        </div>
    </div>
    <div class="col-sm-3"></div>
@endsection