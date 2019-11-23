@extends('layouts.admin')

@section('sub-title', 'Orders For Franchise')
@section('page-description', 'View all Orders For Franchise.')

@section('orders-active', 'active')
@section('orders-for-franchise-active', 'active')

@section('admin-content')
    <div class="admin-orders">
        @if(Session::has('status'))
            <div class="alert alert-success" role="alert">
                <span class="alert-icon">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"> </i>
                </span>
                <br>
                {{ Session::get('status') }}
            </div>
        @endif

        <div class="admin-content-header-summary">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header rbt-bg-main"><strong>Orders</strong> Pending</h5>
                        <div class="card-body rbt-text-main">
                            <span>{{ getOrderSummary()->pending }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header"><strong>Orders</strong> Today</h5>
                        <div class="card-body">
                            <span>{!! getOrderSummary()->today !!}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header"><strong>Orders</strong> This Month</h5>
                        <div class="card-body">
                            <span>{!! getOrderSummary()->this_month !!}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header"><strong>Orders</strong> Last Month</h5>
                        <div class="card-body">
                            <span>{!! getOrderSummary()->last_month !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-orders-table">

            <order-data-table
                    api_url="{{ route('admin.api.orders', ['type' => 'for-franchise']) }}"
                    order_type="For Franchise">
            </order-data-table>

        </div>
    </div>
@endsection

@section('custom-script')


@endsection
