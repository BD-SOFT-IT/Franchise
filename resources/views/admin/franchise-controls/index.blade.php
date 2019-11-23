@extends('layouts.admin')

@section('sub-title', 'Franchise')
@section('page-description', 'All Franchise')

@section('franchise-active', 'active')
@section('franchise-all-active', 'active')

@section('header-action')
    <ul class="nav justify-content-end">
        <li class="nav-item text-center">
            <a class="nav-link btn btn-light" href="{{ route('admin.franchise-control.add') }}">
                <i class="fa fa-plus"></i>
                <span class="d-none d-sm-block">Create Franchise</span>
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

        <franchise-data-table
                api_url="{{ route('admin.api.franchise-control.all') }}">
        </franchise-data-table>
    </div>
@endsection
