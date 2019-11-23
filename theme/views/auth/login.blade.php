@extends('theme::layouts.app')

@section('title', 'Login :: ')
@section('description', getSiteBasic('site_description'))
@section('keywords', getSiteBasic('site_keywords'))

@section('breadcrumb')
    @component('theme::components.breadcrumb', [
            'data'  => [
                //['url' => '#', 'title' => 'Shop']
            ],
            'active'   => 'Login'
        ])
    @endcomponent
@endsection

@section('content')
    <section class="login-view auth-view">
        <div class="container my-3 my-md-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    @if(session(('error')))
                        <div class="alert alert-danger" role="alert">
                            <span class="h5 font-weight-bold">{{ session('error') }}</span>
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

                        <a href="{{ route('login.social', ['driver' => 'facebook']) }}" v-tooltip.top-bottom="'Login With Facebook'"
                           class="btn btn-light hvr-grow-rotate" style="background-color: #365dad;">
                            <i class="icon ion-logo-facebook"></i>
                        </a>
                        <a href="{{ route('login.social', ['driver' => 'google']) }}" v-tooltip.top-bottom="'Login With Google+'"
                           class="btn btn-light hvr-grow-rotate" style="background-color: #dd4e40;">
                            <i class="icon ion-logo-googleplus"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5" style="border: 2px solid #1b1b1b;">
                    <div class="card bsoft-card">
                        <div class="card-header text-center">
                            Login OR Register
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" id="login-form">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email/Mobile</label>
                                    <div class="input-group @error('email') invalid @enderror @error('mobile') invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="icon ion-ios-contact hvr-grow"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror @error('mobile') is-invalid @enderror" value="{{ old('email') }}"
                                               placeholder="Email or Mobile Number" aria-label="Email" aria-describedby="basic-addon2" id="email" required autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <div class="input-group @error('password') invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">
                                                <i class="icon ion-md-lock hvr-grow"></i>
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

                                <div class="form-group secured-btn text-center">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::displaySubmit('login-form', 'Continue', ['data-theme' => 'dark']) !!}
                                    {{--<button type="submit">Continue</button>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                    <a class="btn btn-link forgot-btn" href="{{ route('password.request') }}" v-tooltip.top-bottom="'Click to Reset Your Password'">
                        {{ __('Forgot Password?') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
