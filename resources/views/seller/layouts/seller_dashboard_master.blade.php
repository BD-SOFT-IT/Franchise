<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('sellerDashboardTitle')
        @yield('allApprovedProducts-title')
        @yield('addNewProduct-title')
        @yield('sellerCancelProducts-title')
        @yield('editProduct-title')
        @yield('productPreview-title')
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('seller_dashboard/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('seller_dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('seller_dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('seller_dashboard/dist/css/adminlte.min.css') }}">
    <!-- Data Tables css-->
    <link rel="stylesheet" href="{{ asset('seller_dashboard/dist/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('seller_dashboard/dist/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('seller_dashboard/dist/css/bootstrap.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('seller_dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('seller_dashboard/plugins/summernote/summernote-bs4.css') }}">


    <link rel="stylesheet" href="{{ asset('seller/css/seller_main.css') }}">

</head>




<body class="hold-transition sidebar-mini layout-fixed" >
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light navbar-white border-bottom-0">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('seller.dashboard') }}" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('seller_dashboard/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('seller_dashboard\dist\img\user7-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('seller_dashboard/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-teal control-sidebar-light text-sm">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-2 mb-4 d-flex" style="border-bottom: 2px dashed #c1c1c1">
{{--                <div class="image">--}}
{{--                    <img src="" class="img-circle elevation-2" alt="User Image">--}}
{{--                </div>--}}
                <div class="info">


            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    {{-- Dashboard Section Started --}}
                    <li class="nav-item has-treeview mb-1">
                        <a href="{{ route('seller.dashboard') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    {{-- Dashboard Section end --}}

                    {{-- Product Managment section started--}}
                    <li class="nav-item has-treeview mb-1 menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>
                                Product Manager
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('seller.allApprovedProducts') }}" class="nav-link">
                                    <i class="fas fa-angle-double-right nav-icon"></i>
                                    <p>All Products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('seller.addNewProduct') }}" class="nav-link">
                                    <i class="fas fa-angle-double-right nav-icon"></i>
                                    <p>Add New Product </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('seller.CanceledProducts') }}" class="nav-link">
                                    <i class="fas fa-angle-double-right nav-icon"></i>
                                    <p>Canceled Products </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Product Managment section end --}}

                    {{-- Store Cashier section started--}}
                    <li class="nav-item has-treeview mb-1">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>
                                Shop Cashier
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Month Sales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('seller.invoice') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Invoice</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>XYZ</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Store Cashier section end --}}

                    {{-- Contact Us Section Started --}}
{{--                    <li class="nav-item has-treeview mb-1">--}}
{{--                        <a href="{{ route('seller.contact') }}" class="nav-link active">--}}
{{--                            <i class="fas fa-id-card-alt"></i>--}}
{{--                            <p>--}}
{{--                                Contact Us--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    {{-- Contact Us Section end --}}

                    {{-- Seller Dashboard Sign Out Section --}}
                    <li class="nav-item has-treeview mb-1">
                        <a href="{{ route('seller.signout') }}" class="nav-link active">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Sign Out
                            </p>
                        </a>
                    </li>
                    {{-- Seller Dashboard Sign Out Section --}}

                </ul>

            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    {{--  Seller Dashboard Main Body Content --}}
    @yield('sellerDashboard')

    {{--  Seller Dashboard Contact page content  --}}
    @yield('sellerContact')

    {{-- All Approved Product Page Content --}}
    @yield('allApprovedProducts')

    {{-- Add New Product Page Content --}}
    @yield('addNewProduct')

    {{-- Canceled Producted page content --}}
    @yield('sellerCancelProducts')

    {{-- Seller Invoice generate page content --}}
    @yield('sellerInvoice')

    @yield('editProduct')

    @yield('productPreview')

{{--    <footer class="main-footer">--}}

{{--    </footer>--}}

</div>
<!-- ./wrapper -->



<!-- jQuery -->
<script src="{{ asset('seller_dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('seller_dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('seller_dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('seller_dashboard/plugins/bootstrap/js/bootstrap.js') }}"></script>

<script src="{{ asset('seller_dashboard/dist/js/buttons.bootstrap.js') }}"></script>


<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('seller_dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('seller_dashboard/plugins/summernote/summernote-bs4.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('seller_dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('seller_dashboard/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('seller_dashboard/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('seller_dashboard/dist/js/demo.js') }}"></script>
<script src="{{ asset('seller_dashboard/dist/js/custom-file-input.js') }}"></script>
<script src="{{ asset('seller_dashboard/dist/js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('seller_dashboard/dist/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('seller_dashboard/dist/js/dataTables.bootstrap4.min.js') }}"></script>

</body>
</html>
