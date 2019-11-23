@extends('theme::layouts.app')

@section('title', 'Update Password :: ')
@section('description', getSiteBasic('site_description'))
@section('keywords', getSiteBasic('site_keywords'))

@section('breadcrumb')
    @component('theme::components.breadcrumb', [
            'data'  => [
                //['url' => '#', 'title' => 'Shop']
            ],
            'active'   => 'Update Password'
        ])
    @endcomponent
@endsection

@section('content')
    <section class="auth-view">
        <div class="container my-3 my-md-5">
            <div class="row justify-content-center">

                <div class="col-12 col-lg-10 px-0">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                </div>

                <div class="col-md-6 col-lg-5" style="background-color: #1b1b1b;">
                    <div class="login-side">
                        <h3 class="d-none d-md-block">Shop With Confidence</h3>
                        <img src="{{ asset("images/shop_circle.png") }}" alt="" class="mw-100 d-none d-md-block hvr-grow-rotate">

                        <h4>
                            Get Started
                        </h4>

                        <span class="d-block">with</span>

                        <a href="{{ route('login.social', ['provider' => 'facebook']) }}" v-tooltip.top-bottom="'Login With Facebook'"
                           class="btn btn-light hvr-grow-rotate" style="background-color: #365dad;">
                            <i class="icon ion-logo-facebook"></i>
                        </a>
                        <a href="{{ route('login.social', ['provider' => 'google']) }}" v-tooltip.top-bottom="'Login With Google+'"
                           class="btn btn-light hvr-grow-rotate" style="background-color: #dd4e40;">
                            <i class="icon ion-logo-googleplus"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5" style="border: 2px solid #1b1b1b;">
                    <div class="card bsoft-card">
                        <div class="card-header">{{ __('Reset Password') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}" id="password-reset">
                                @csrf
                                @method('PATCH')

                                @if($token === 'mobile')
                                    <div class="form-group">
                                        <label for="token" class="sr-only">Verification Code</label>
                                        <div class="input-group @error('token') invalid @enderror">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2">
                                                    <i class="icon ion-ios-lock hvr-grow"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="token" class="form-control @error('token') is-invalid @enderror" value="{{ old('token') }}"
                                                   placeholder="Verification Code" id="token" required autofocus>
                                            @error('token')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="mobile" value="{{ $email }}">
                                @else
                                    <input type="hidden" name="token" value="{{ $token }}">
                                @endif

                                <div class="form-group">
                                    <label for="email" class="sr-only">E-Mail Or Mobile</label>
                                    <div class="input-group @error('email') invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="icon ion-ios-contact hvr-grow"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="email" class="form-control disabled @error('email') is-invalid @enderror" value="{{ old('email', $email) }}"
                                               placeholder="Email or Mobile" aria-label="Email" aria-describedby="basic-addon2" id="email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                                    <div class="input-group @error('password') invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">
                                                <i class="icon ion-md-key hvr-grow"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Password" aria-label="Password" aria-describedby="basic-addon3" id="password" required>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
                                    <div class="input-group @error('password_confirmation') invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">
                                                <i class="icon ion-md-key hvr-grow"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                               placeholder="Repeat Password" aria-label="Password" aria-describedby="basic-addon3" id="password-confirm" required>

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group secured-btn">
                                    {{--<button type="submit" class="btn btn-primary">
                                        {{ __('Update Password') }}
                                    </button>--}}
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::displaySubmit('password-reset', 'Update Password', ['data-theme' => 'dark']) !!}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
