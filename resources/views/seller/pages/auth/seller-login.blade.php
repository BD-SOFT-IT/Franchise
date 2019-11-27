<!doctype html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>@yield('loginTitle')</title>


    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/seller/css/bootstrap.css')}}">
</head>
<body style="background-color: #3B3D40;">
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 pt-5">
            <h2 class="text-center text-info">Merchant Admin Panel</h2>
            <div class="login-box mt-3">
                <div class="card">
                    @if(session()->has('errorEmail'))
                        <div class="alert bg-danger">
                            {{ session()->get('errorEmail') }}

                        </div>
                    @endif
                        @if(session()->has('errorPassword'))
                            <div class="alert bg-danger">
                                {{ session()->get('errorPassword') }}
                            </div>
                        @endif

                    <div class="card-body do-card-body">
                        <form method="POST" action="{{ route('seller.test-login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="sellerEmail">Email address</label>
                                <input type="email" class="form-control" id="sellerEmail" name="seller_email" aria-describedby="emailHelp"
                                       placeholder="Enter your email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="sellerPassword">Password</label>
                                <input type="password" class="form-control" id="sellerPassword" name="seller_password" placeholder="Password">
                            </div>
{{--                            <div class="form-group form-check">--}}
{{--                                <input type="checkbox" class="form-check-input" id="sellerForgotPassword" name="seller_forgot_password">--}}
{{--                                <label class="form-check-label" for="sellerForgotPassword">Forgot Password</label>--}}
{{--                            </div>--}}
                            <div class="form-group custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="seller_forgot_password">
                                <label class="custom-control-label" for="customCheck1">Forgot Password?</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Log In</button>
                            <p class="do-seller-registration pt-5 text-center lead">
                                Don't have account yet?
                                <a href="{{ route('seller.registration') }}" class="do-seller-registration-link">
                                    Become A Merchant
                                </a>
                            </p>
                        </form>
                        <a href="" >
                            <img class="text-right offset-4" src="{{ asset('images/logos/bd_soft_it_horizontal.png') }}" alt="" width="150" height="50">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('seller_dashboard/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('seller/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('seller/js/bootstrap.js') }}"></script>
</body>
</html>
