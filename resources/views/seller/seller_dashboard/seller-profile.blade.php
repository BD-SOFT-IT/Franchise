@extends('seller.layouts.seller_dashboard_master')


@section('sellerDashboardTitle')
    Seller Dashboard
@endsection

@section('sellerDashboard')
{{--    {{dd( Auth::user()->seller_first_name) }}--}}
    {{--  Seller Dashboard All Content Started from here --}}
    <div class="content-wrapper" style="background-color: #E0E0E0">
        @if(session()->has('errorMessage'))
            <div class="alert alert-danger">
                {{ session()->get('errorMessage') }}
            </div>
        @endif
        <!-- Content Header (Page header) -->
        <div class="content-header mx-2">
            <div class="container-fluid mt-2" style="background-color: #ffffff;padding: 34px 34px">
                <div class="row mb-3 mt-3">
                    <div class="col-lg-12">
                        <h3>Welcome {{  Auth::user()->seller_first_name }}! Thanks for with us.</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #007bff">
                            <div class="inner">
                                <h3>
                                    <i class="fas fa-shopping-bag"></i>
                                    <a style="color: white">
{{--                                        @foreach($sellerProduct as $sellerProducts)--}}
{{--                                            {{ $sellerProducts->product_id }}--}}
{{--                                        @endforeach--}}
                                    </a>
                                </h3>
                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('seller.allApprovedProducts') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #33BB82">
                            <div class="inner">
                                <h3>
                                    <i class="fas fa-truck-loading"></i>
                                    1
                                </h3>

                                <p>Order Accepted</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #FFC107">
                            <div class="inner">
                                <h3>
                                    <i class="fas fa-hourglass-start"></i>
                                    1
                                </h3>
                                <p>Pending Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #f44336">
                            <div class="inner">
                                <h3>
                                    <i class="fas fa-window-close"></i>
                                    150
                                </h3>

                                <p>Cancel Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
{{--                <div class="row">--}}
{{--                    <!-- Left col -->--}}
{{--                    <section class="col-lg-7 connectedSortable">--}}
{{--                        <!-- Custom tabs (Charts with tabs)-->--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">--}}
{{--                                    <i class="fas fa-chart-pie mr-1"></i>--}}
{{--                                    Sales--}}
{{--                                </h3>--}}
{{--                                <div class="card-tools">--}}
{{--                                    <ul class="nav nav-pills ml-auto">--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div><!-- /.card-header -->--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="tab-content p-0">--}}
{{--                                    <!-- Morris chart - Sales -->--}}
{{--                                    <div class="chart tab-pane active" id="revenue-chart"--}}
{{--                                         style="position: relative; height: 300px;">--}}
{{--                                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
{{--                                    </div>--}}
{{--                                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">--}}
{{--                                        <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div><!-- /.card-body -->--}}
{{--                        </div>--}}
{{--                        <!-- /.card -->--}}


{{--                        <!-- TO DO List -->--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">--}}
{{--                                    <i class="ion ion-clipboard mr-1"></i>--}}
{{--                                    To Do List--}}
{{--                                </h3>--}}

{{--                                <div class="card-tools">--}}
{{--                                    <ul class="pagination pagination-sm">--}}
{{--                                        <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>--}}
{{--                                        <li class="page-item"><a href="#" class="page-link">1</a></li>--}}
{{--                                        <li class="page-item"><a href="#" class="page-link">2</a></li>--}}
{{--                                        <li class="page-item"><a href="#" class="page-link">3</a></li>--}}
{{--                                        <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-header -->--}}
{{--                            <div class="card-body">--}}
{{--                                <ul class="todo-list" data-widget="todo-list">--}}
{{--                                    <li>--}}
{{--                                        <!-- drag handle -->--}}
{{--                                        <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                                        <!-- checkbox -->--}}
{{--                                        <div  class="icheck-primary d-inline ml-2">--}}
{{--                                            <input type="checkbox" value="" name="todo1" id="todoCheck1">--}}
{{--                                            <label for="todoCheck1"></label>--}}
{{--                                        </div>--}}
{{--                                        <!-- todo text -->--}}
{{--                                        <span class="text">Design a nice theme</span>--}}
{{--                                        <!-- Emphasis label -->--}}
{{--                                        <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>--}}
{{--                                        <!-- General tools such as edit or delete-->--}}
{{--                                        <div class="tools">--}}
{{--                                            <i class="fas fa-edit"></i>--}}
{{--                                            <i class="fas fa-trash-o"></i>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                                        <div  class="icheck-primary d-inline ml-2">--}}
{{--                                            <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>--}}
{{--                                            <label for="todoCheck2"></label>--}}
{{--                                        </div>--}}
{{--                                        <span class="text">Make the theme responsive</span>--}}
{{--                                        <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>--}}
{{--                                        <div class="tools">--}}
{{--                                            <i class="fas fa-edit"></i>--}}
{{--                                            <i class="fas fa-trash-o"></i>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                                        <div  class="icheck-primary d-inline ml-2">--}}
{{--                                            <input type="checkbox" value="" name="todo3" id="todoCheck3">--}}
{{--                                            <label for="todoCheck3"></label>--}}
{{--                                        </div>--}}
{{--                                        <span class="text">Let theme shine like a star</span>--}}
{{--                                        <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>--}}
{{--                                        <div class="tools">--}}
{{--                                            <i class="fas fa-edit"></i>--}}
{{--                                            <i class="fas fa-trash-o"></i>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                                        <div  class="icheck-primary d-inline ml-2">--}}
{{--                                            <input type="checkbox" value="" name="todo4" id="todoCheck4">--}}
{{--                                            <label for="todoCheck4"></label>--}}
{{--                                        </div>--}}
{{--                                        <span class="text">Let theme shine like a star</span>--}}
{{--                                        <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>--}}
{{--                                        <div class="tools">--}}
{{--                                            <i class="fas fa-edit"></i>--}}
{{--                                            <i class="fas fa-trash-o"></i>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                                        <div  class="icheck-primary d-inline ml-2">--}}
{{--                                            <input type="checkbox" value="" name="todo5" id="todoCheck5">--}}
{{--                                            <label for="todoCheck5"></label>--}}
{{--                                        </div>--}}
{{--                                        <span class="text">Check your messages and notifications</span>--}}
{{--                                        <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>--}}
{{--                                        <div class="tools">--}}
{{--                                            <i class="fas fa-edit"></i>--}}
{{--                                            <i class="fas fa-trash-o"></i>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                    <span class="handle">--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                      <i class="fas fa-ellipsis-v"></i>--}}
{{--                    </span>--}}
{{--                                        <div  class="icheck-primary d-inline ml-2">--}}
{{--                                            <input type="checkbox" value="" name="todo6" id="todoCheck6">--}}
{{--                                            <label for="todoCheck6"></label>--}}
{{--                                        </div>--}}
{{--                                        <span class="text">Let theme shine like a star</span>--}}
{{--                                        <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>--}}
{{--                                        <div class="tools">--}}
{{--                                            <i class="fas fa-edit"></i>--}}
{{--                                            <i class="fas fa-trash-o"></i>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                            <div class="card-footer clearfix">--}}
{{--                                <button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.card -->--}}
{{--                    </section>--}}
{{--                    <!-- /.Left col -->--}}
{{--                    <!-- right col (We are only adding the ID to make the widgets sortable)-->--}}
{{--                    <section class="col-lg-5 connectedSortable">--}}

{{--                        <!-- Map card -->--}}

{{--                        <!-- solid sales graph -->--}}
{{--                        <div class="card bg-gradient-info">--}}
{{--                            <div class="card-header border-0">--}}
{{--                                <h3 class="card-title">--}}
{{--                                    <i class="fas fa-th mr-1"></i>--}}
{{--                                    Sales Graph--}}
{{--                                </h3>--}}

{{--                                <div class="card-tools">--}}
{{--                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">--}}
{{--                                        <i class="fas fa-minus"></i>--}}
{{--                                    </button>--}}
{{--                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">--}}
{{--                                        <i class="fas fa-times"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                            <div class="card-footer bg-transparent">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-4 text-center">--}}
{{--                                        --}}{{--                                        <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"--}}
{{--                                        --}}{{--                                               data-fgColor="#39CCCC">--}}

{{--                                        <div class="text-white">Mail-Orders</div>--}}
{{--                                    </div>--}}
{{--                                    <!-- ./col -->--}}
{{--                                    <div class="col-4 text-center">--}}
{{--                                        --}}{{--                                        <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"--}}
{{--                                        --}}{{--                                               data-fgColor="#39CCCC">--}}

{{--                                        <div class="text-white">Online</div>--}}
{{--                                    </div>--}}
{{--                                    <!-- ./col -->--}}
{{--                                    <div class="col-4 text-center">--}}
{{--                                        --}}{{--                                        <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"--}}
{{--                                        --}}{{--                                               data-fgColor="#39CCCC">--}}

{{--                                        <div class="text-white">In-Store</div>--}}
{{--                                    </div>--}}
{{--                                    <!-- ./col -->--}}
{{--                                </div>--}}
{{--                                <!-- /.row -->--}}
{{--                            </div>--}}
{{--                            <!-- /.card-footer -->--}}
{{--                        </div>--}}
{{--                        <!-- /.card -->--}}

{{--                        <!-- Calendar -->--}}
{{--                        <div class="card bg-gradient-success">--}}
{{--                            <div class="card-header border-0">--}}

{{--                                <h3 class="card-title">--}}
{{--                                    <i class="far fa-calendar-alt"></i>--}}
{{--                                    Calendar--}}
{{--                                </h3>--}}
{{--                                <!-- tools card -->--}}
{{--                                <div class="card-tools">--}}
{{--                                    <!-- button with a dropdown -->--}}
{{--                                    <div class="btn-group">--}}
{{--                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">--}}
{{--                                            <i class="fas fa-bars"></i></button>--}}
{{--                                        <div class="dropdown-menu float-right" role="menu">--}}
{{--                                            <a href="#" class="dropdown-item">Add new event</a>--}}
{{--                                            <a href="#" class="dropdown-item">Clear events</a>--}}
{{--                                            <div class="dropdown-divider"></div>--}}
{{--                                            <a href="#" class="dropdown-item">View calendar</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">--}}
{{--                                        <i class="fas fa-minus"></i>--}}
{{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">--}}
{{--                                        <i class="fas fa-times"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <!-- /. tools -->--}}
{{--                            </div>--}}
{{--                            <!-- /.card-header -->--}}
{{--                            <div class="card-body pt-0">--}}
{{--                                <!--The calendar -->--}}
{{--                                <div id="calendar" style="width: 100%"></div>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                        </div>--}}
{{--                        <!-- /.card -->--}}
{{--                    </section>--}}
{{--                    <!-- right col -->--}}
{{--                </div>--}}
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
