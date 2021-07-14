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
                <h3 class="form-title" style="color: #057822; margin: 10px 0;font-size: 15px;">Reset Password</h3>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="modal-body" style="padding: 10px 20px;">
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
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <div class="input-icon">
                                <i class="icon-lock"></i>
                                <input type="password" name="password" id="password" class="form-control" required placeholder="Password">
                                @error('password')
                                    <label for="password" class="has-error help-block">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="icon-lock"></i>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-actions text-center">
                            <input type="submit" class="btn btn-success" value="Reset Password">
                        </div>
                    </div>
                </form>
            </div> 
            <!-- /.content -->
        </div>
    </div>
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
@endsection