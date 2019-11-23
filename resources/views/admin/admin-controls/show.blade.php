@extends('layouts.admin')

@section('sub-title', 'Shop Admin Details')
@section('page-description', 'Shop Admin Details')

@section('admins-active', 'active')
@section('admins-all-active', 'active')

@section('header-action')
    <ul class="nav justify-content-end">
        <li class="nav-item text-center">
            <a class="nav-link btn btn-light" href="{{ route('admin.admins.all') }}">
                <i class="fa fa-users"> </i>
                <span class="d-none d-sm-block">All Admins</span>
            </a>
        </li>
    </ul>
@endsection

@section('admin-content')
    <div class="all-admins-container">

        @if(Session::has('status'))
            <div class="alert alert-info text-center" role="alert">
                {{ Session::get('status') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-info-circle"></i> Admin</strong> Details
            </div>

            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        @if($admin->img_url && strlen($admin->img_url) > 10)
                                            <img src="{{ imageCache($admin->img_url) }}" alt="{{ $admin->name }}" style="max-width: 200px; max-height: 200px; margin: 5px auto; border-radius: 50%">
                                        @else
                                            <img src="{{ staticAsset('images/default_male.png') }}" alt="{{ $admin->name }}" style="max-width: 200px; max-height: 200px; margin: 5px auto; border-radius: 50%">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="max-width: 100px;">Name</th>
                                    <th scope="row">{{ $admin->name }}</th>
                                </tr>
                                <tr>
                                    <th scope="row" style="max-width: 100px;">Email</th>
                                    <td>{{ $admin->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="max-width: 100px;">Mobile Primary</th>
                                    <td>{{ mobileNumber($admin->mobile_primary) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="max-width: 100px;">Mobile Secondary</th>
                                    <td>{{ $admin->mobile_secondary ? mobileNumber($admin->mobile_secondary) : '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="max-width: 100px;">Address</th>
                                    <td>{{ $admin->address }}, {{ $admin->city }}, Bangladesh-{{ $admin->postcode }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
