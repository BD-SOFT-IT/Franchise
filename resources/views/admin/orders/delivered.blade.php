@extends('layouts.admin')

@section('sub-title', 'Delivered Orders')
@section('page-description', 'View all delivered orders.')

@section('orders-active', 'active')
@section('orders-delivered-active', 'active')

@section('admin-content')
    <div class="admin-orders">
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

            <order-data-table api_url="{{ route('admin.api.orders', ['type' => 'delivered']) }}" order_type="Delivered"></order-data-table>

        </div>
    </div>
@endsection

@section('custom-script')


@endsection
