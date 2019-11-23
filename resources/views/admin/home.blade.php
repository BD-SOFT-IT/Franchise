@extends('layouts.admin')

@section('sub-title', 'Dashboard')
@section('page-description', 'RBT Ecom Dashboard')

@section('dashboard-active', 'active')

@section('admin-content')
    <div class="dashboard-header" style="background-image: url('{{ asset("assets/RBT_EMS/images/dashboard_header.jpg") }}');">
        <div class="dashboard-header-content">
            <div class="row">
                <div class="col-sm-7">
                    <h1 class="header-welcome">
                        Welcome <strong>{{ auth('admin')->user()->first_name }}</strong>
                        <br>
                        <small>Have a Great Day!</small>
                    </h1>
                </div>
                <div class="col-sm-5 text-center">
                    <div class="wow jackInTheBox animated" data-wow-delay="150ms">
                        <h3 class="dashboard-header-information">
                            {{ $location->temperature }}&deg; C
                            <br>
                            <small><i class="fa fa-map-marker"></i> {{ $location->city . ', ' . $location->country }}</small>
                        </h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
