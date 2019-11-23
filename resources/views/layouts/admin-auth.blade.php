<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RBT Admin - {{ config('app.name', 'BD SOFT E-COMMERCE') }}</title>

    <meta name="keywords" content="Admin Panel, E-Commerce Admin Panel, CMS, E-Shop Admin, Online Shop Admin, RBT Admin, RightBrainTechBD Custom E-Commerce Admin Panel">
    <meta name="author" content="{{ config('app.developer') }}">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <!-- Styles -->
    <link href="{{ asset('assets/RBT_EMS/css/rbt-ems-admin.css') }}" rel="stylesheet">
</head>
<body style="background-color: #d2d6de;">

    <div id="rbtEMS">
        <div class="admin-auth">
            <div class="admin-auth-logo">
                <a class="admin-auth-logo" href="{{ url('/') }}" target="_blank">
                    @if(Route::currentRouteName() == 'admin.setup')
                        <img src="{{ asset('images/logos/bd_soft_it.png') }}" alt="BD SOFT IT" style="max-height: 200px; width: auto !important; max-width: 90%;">
                    @elseif(getSiteBasic('site_logo') != null)
                        <img src="{{ imageCache(getSiteBasic('site_logo')) }}" alt="{{ getSiteBasic('site_title') }}" style="max-height: 200px; width: auto !important; max-width: 90%;">
                    @elseif(getSiteBasic('site_title') != null)
{{--                        <h2>{{ getSiteBasic('site_title') }}</h2>--}}
                    @else
                        <img src="{{ asset('images/logos/bd_soft_it.png') }}" alt="BD SOFT IT" style="max-height: 200px; width: auto !important; max-width: 90%;">
                    @endif
                </a>
            </div>

            @yield('content')

            <div class="auth-footer text-center">
                Powered by: <br>
                <a href="http://bdsoftit.com" target="_blank">
                    <img src="{{ asset('images/logos/bd_soft_it_horizontal.png') }}" alt="BD SOFT IT" style="width: 375px !important;">
                </a>
            </div>
        </div>
    </div>

</body>
</html>
