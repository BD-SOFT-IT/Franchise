@extends('layouts.admin')

@section('sub-title', 'Add New Shipper')
@section('page-description', 'Add New Shipper')

@section('shippers-active', 'active')
@section('shippers-new-active', 'active')



@section('admin-content')
    <div class="all-admins-container">

        <create-shipper api="{{ route('admin.api.shipper.create') }}"></create-shipper>

    </div>
@endsection
