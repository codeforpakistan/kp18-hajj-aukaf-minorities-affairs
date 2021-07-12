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
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
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