<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('sellerTitle')</title>

    {{-- Stylesheets linked section started  --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('seller/css/seller_main.css') }}">
    <link href="{{ asset('seller_dashboard/plugins/summernote/summernote-bs4.css/summernote-bs4.min.css') }}">

</head>
<body class="do-seller-regi-homepage">
    {{-- This section for the Seller Registration --}}
    @yield('sellerRegistration')

    {{-- This section for seller approval--}}
    @yield('seller_approval')




    {{--    Script File linked section started --}}
    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('seller/js/seller_main.js') }}"></script>
    <script src="{{ asset('seller_dashboard/plugins/summernote/summernote-bs4.js/summernote-bs4.min.js') }}"></script>


</body>
</html>
