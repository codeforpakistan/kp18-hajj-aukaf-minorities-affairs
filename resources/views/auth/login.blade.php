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
                <form action="{{route('login')}}" method="POST" class="form-horizontal login-form" id="login-form">
                    @csrf
                    <!-- Title -->
                    <h3 class="form-title" style="color: #057822;margin: 10px 0px;font-size: 15px;">Sign In</h3>
                    @if(session()->has('status'))
                        <!-- Success Message -->
                        <div class="alert fade in alert-success">
                            <i class="icon-remove close" data-dismiss="alert"></i>
                            {{  session('status') }}
                        </div>
                        
                    @endif
                    <!-- Error Message -->
                    <div class="alert fade in alert-danger" id="error-alert" style="display: none;">
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        <span id="error-text"></span>
                    </div>
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
                    <div class="form-group">
                        <div class="input-icon">
                            <i class="icon-lock"></i>
                            <input type="password" name="password" id="password" class="form-control" required placeholder="Password">
                        </div>
                    </div>
                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a class="pull-left" href="{{route('password.request')}}" style="padding: 6px 0px;text-decoration:underline;font-size:14px;color:green;">Forgot Password?</a>
                            <input type="submit" name="login" class="btn btn-success pull-right" value="Sign In">
                    </div>
                </form>
            </div> 
            <!-- /.content -->
        </div>
    </div>
    <div class="col-sm-3"></div>
@endsection