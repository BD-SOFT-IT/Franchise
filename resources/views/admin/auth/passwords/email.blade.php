@extends('layouts.admin-auth')

@section('content')
    <div class="forgot-password-box">
        <div class="card">
            <div class="card-header">{{ __('Reset Password') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.password.email') }}">
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
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
