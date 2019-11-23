@extends('layouts.admin-auth')

@section('content')
    <div class="register-box">
        <div class="card">
            <div class="card-header">Setup Web Admin</div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.setup.save') }}">
                    @csrf

                    <div class="form-group">
                        <label for="site_title" class="sr-only">{{ __('Shop Title') }}</label>
                        <input id="site_title" type="text" placeholder="Shop Title" class="form-control{{ $errors->has('site_title') ? ' is-invalid' : '' }}" name="site_title" value="{{ old('site_title') }}" required autofocus>

                        @if ($errors->has('site_title'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('site_title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="first_name" class="sr-only">{{ __('First Name') }}</label>
                        <input id="first_name" type="text" placeholder="Admin's First Name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>

                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="sr-only">{{ __('Last Name') }}</label>
                        <input id="last_name" type="text" placeholder="Admin's Last Name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>

                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" placeholder="Admin's Email Address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password" class="sr-only">{{ __('Password') }}</label>
                        <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" placeholder="Repeat Password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Setup') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
