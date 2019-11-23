@extends('layouts.admin-auth')

@section('content')
    <div class="register-box">
        <div class="card">
            <div class="card-header">{{ __('Register') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="first_name" class="sr-only">{{ __('First Name') }}</label>
                        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="sr-only">{{ __('Last Name') }}</label>
                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password" class="sr-only">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
