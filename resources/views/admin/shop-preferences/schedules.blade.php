@extends('layouts.admin')

@section('sub-title', 'Shop Preferences (Delivery Schedules)')
@section('page-description', 'Manage Shop Delivery Schedules')

@section('shop-preferences-active', 'active')
@section('shop-preferences-schedules-active', 'active')

{{--@section('header-action')
    <ul class="nav justify-content-end">
        <li class="nav-item text-center">
            <a class="nav-link btn btn-light" href="#" data-toggle="modal" data-target="#addScheduleModal">
                <i class="fa fa-plus"></i>
                <span class="d-none d-sm-block">New Schedule</span>
            </a>
        </li>
    </ul>
@endsection--}}

@section('admin-content')
    <div class="admin-shop-preferences">
        <div class="admin-content-header-summary">
            <div class="row">

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header">Total <strong>States</strong></h5>
                        <div class="card-body">
                            <span>{{ $summary->states }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header">Total <strong>Cities</strong></h5>
                        <div class="card-body">
                            <span>{{ $summary->cities }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header rbt-bg-main">Total <strong>Areas</strong></h5>
                        <div class="card-body rbt-text-main">
                            <span>{{ $summary->areas }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header rbt-bg-main">Selected <strong>Areas</strong></h5>
                        <div class="card-body rbt-text-main">
                            <span>{{ $summary->selected }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <delivery-schedules api_url="{{ route('admin.api.shop_preferences.schedules') }}"></delivery-schedules>
    </div>
@endsection

@section('custom-script')

@endsection
