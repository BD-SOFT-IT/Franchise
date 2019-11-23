@extends('layouts.admin-auth')

@section('content')
    <div class="login-box">
        @if(Session::has('sa_status') && Session::get('sa_status') == 'created')
            <div class="alert alert-success text-center" role="alert">
                Super Admin successfully created. <br>
                Please login to continue...
            </div>
        @endif
        {{-- Session Timeout Error Message --}}
        @if(isset($timeout_status) && $timeout_status)
            <div class="alert alert-warning text-center text-danger" style="font-size: 14px; font-weight: 600;" role="alert">
                Your session has been expired due to inactivity for 90 minutes. <br>
                Please login to again to continue...
            </div>
        @endif

        <div class="card">
            <div class="card-header text-center">
                Login to <strong>"{{ $site_title }}"</strong> Admin Panel
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="sr-only">Email address</label>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}"
                                   placeholder="Email" aria-label="Email" aria-describedby="basic-addon2" id="email" required autofocus>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-envelope"></i></span>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="Password" aria-label="Password" aria-describedby="basic-addon3" id="password" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon3"><i class="fa fa-key"></i></span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customCheck1">Remember Me</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        <a class="btn btn-link" href="{{ route('admin.password.email') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
