<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>RBT Admin - @yield('sub-title')</title>
    {{-- Meta --}}
    <meta name="description" content="@yield('page-description')">
    <meta name="keywords" content="Admin Panel, E-Commerce Admin Panel, CMS, E-Shop Admin, Online Shop Admin, RBT Admin, RightBrainTechBD Custom E-Commerce Admin Panel">
    <meta name="author" content="{{ config('app.developer') }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="copyright" content="{{ config('app.developer') }}">
    <meta name="language" content="{{ app()->getLocale() }}">
    <meta name="revised" content="{{ \Carbon\Carbon::now() }}">
    <meta name="Classification" content="Online CMS Software">
    <meta name="designer" content="{{ config('app.developer') }}">
    <meta name="reply-to" content="{{ config('app.developer_email') }}">
    <meta name="url" content="{{ url()->current() }}">
    <meta name="identifier-URL" content="{{ url('/') }}">
    <meta name="category" content="Web Software">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preload" href="{{ asset('assets/RBT_EMS/css/rbt-ems-admin.css') }}" as="style">
    <!-- Scripts -->
    <script src="{{ asset('assets/RBT_EMS/js/manifest.js') }}" defer></script>
    <script src="{{ asset('assets/RBT_EMS/js/vendor.js') }}" defer></script>
    <script src="{{ asset('assets/RBT_EMS/js/rbt-ems-admin.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('assets/RBT_EMS/css/rbt-ems-admin.css') }}" rel="stylesheet">
    {{-- custom-header-style-scripts --}}
    @yield('custom-header-style-scripts')
</head>
<body style="height: auto; min-height: 100%;">
    <div id="rbtEMS" style="height: auto; min-height: 100%;">
        {{-- Header Content --}}
        <header class="admin-header">
            <a class="logo" href="{{ url('/') }}" :class="{ 'main-sidebar-toggled': mainSidebarToggled }" target="_blank">
                <strong v-if="!mainSidebarToggled">{{ getSiteBasic('site_title') }}</strong>
                <img class="img-fluid" src="{{ asset('images/icons/bsoft_icon.png') }}" alt="{{ config('app.developer') }}" v-if="mainSidebarToggled">
            </a>
            <nav class="navbar navbar-expand navbar-light" :class="{ 'main-sidebar-toggled': mainSidebarToggled }">
                <div class="container-fluid">
                    <a href="#" class="sidebar-toggle" role="button" @click.prevent="mainSidebarPcToggler">
                        <i class="fa fa-bars"></i>
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            {{-- Mail Nav Item --}}
                            {{--<header-nav-mail></header-nav-mail>--}}

                            {{-- Notification Nav Item --}}
                            <header-nav-notifications></header-nav-notifications>

                            {{-- Task Nav Item --}}
                            @if(!auth('admin')->user()->isShipper())
                                <header-nav-task></header-nav-task>
                            @endif

                            <li class="nav-item dropdown user-dropdown">
                                <a id="navbarUserDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="{{ auth('admin')->user()->name }}">
                                    @if(auth('admin')->user()->img_url && strlen(auth('admin')->user()->img_url) > 10)
                                        <img src="{{ imageCache(auth('admin')->user()->img_url, '80') }}" alt="{{ auth('admin')->user()->name }}">
                                    @else
                                        <img src="{{ asset('assets/images/user.png') }}" alt="{{ auth('admin')->user()->name }}">
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarUserDropdown">

                                    <div class="card">
                                        <div class="card-header text-center">
                                            @if(auth('admin')->user()->img_url && strlen(auth('admin')->user()->img_url) > 10)
                                                <img src="{{ imageCache(auth('admin')->user()->img_url, 'original') }}" alt="{{ auth('admin')->user()->name }}" class="img-fluid">
                                            @else
                                                <img src="{{ asset('assets/images/user.png') }}" alt="{{ auth('admin')->user()->name }}" class="img-fluid">
                                            @endif
                                            <p>
                                                {{ auth('admin')->user()->name }}
                                                <br>
                                                <span>
                                                    {{ auth('admin')->user()->role->ar_title }}
                                                    since {{ auth('admin')->user()->created_at->format('F, Y') }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="card-body">

                                            <p class="card-text">
                                                <a href="{{ route('admin.profile') }}" class="btn btn-light">{{ __('Profile') }}</a>

                                                <a href="{{ route('admin.logout') }}" class="btn btn-light pull-right"
                                                   onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                            </p>
                                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                @if(auth('admin')->user()->isFranchise())
                                    <a class="nav-link" href="#" role="button" data-toggle="control-sidebar" @click.prevent="toggleControlSidebar">
                                        <i class="fa fa-shopping-bag"></i>
                                    </a>
                                @elseif(auth('admin')->user()->isSuperAdmin() || auth('admin')->user()->isAdmin())
                                    <a class="nav-link" href="#" role="button" data-toggle="control-sidebar" @click.prevent="toggleControlSidebar">
                                        <i class="fa fa-gears"></i>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header><!-- \.admin-header -->

        {{-- Main Sidebar Content --}}
        <aside class="main-sidebar" :class="{ 'main-sidebar-toggled': mainSidebarToggled }" ref="mainSidebar">

            @include('admin.partials.main-sidebar')

        </aside><!-- \.main-sidebar -->

        {{-- Main Content --}}
        <main class="admin-content" :class="{ 'main-sidebar-toggled': mainSidebarToggled }" v-resize="onAdminContentResize" ref="adminContent">

            @if(Route::currentRouteName() != 'admin.home')
                <div class="admin-page-header-action clearfix">
                    <div class="row">
                        <div class="col-lg-3 d-none d-lg-block">
                            <a href="{{ url()->previous() }}" class="btn btn-light">
                                <i class="fa fa-long-arrow-left"></i>

                                Go Back
                            </a>
                        </div>

                        <div class="col-12 col-lg-9">
                            <div class="action-navigation">
                                @yield('header-action')
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @yield('admin-content')

        </main><!-- \.admin-content -->

        {{-- Footer Content --}}
        <footer class="admin-footer" :class="{ 'main-sidebar-toggled': mainSidebarToggled }">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <p class="admin-copyright">
                            <span>
                                Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}" target="_blank">{{ getSiteBasic('site_title') }}</a>.
                            </span>
                        </p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="admin-powered">
                            Powered by: <a href="{{ config('app.developer_url') }}" target="_blank">{{ config('app.developer') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer><!-- \.admin-footer -->

        {{-- Control Sidebar Content --}}
        <aside class="control-sidebar">

            @include('admin.partials.control-sidebar')

        </aside><!-- \.control-sidebar -->

    </div><!-- \#rbtAdmin -->

    {{-- Footer Scripts --}}
    <script src="{{ asset('assets/RBT_EMS/js/AFScript.js') }}"></script>
    {{-- Custom Scripts --}}
    <script>

    </script>
    @yield('custom-script')
</body>
</html>
