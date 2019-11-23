@extends('layouts.admin')

@section('sub-title', 'All Customers')
@section('page-description', 'All Customers')

@section('customers-active', 'active')
@section('customers-all-active', 'active')

@section('header-action')

	<ul class="nav justify-content-end">
		<li class="nav-item text-center">
			<a href="{{ route('admin.customers.add') }}" class="nav-link btn btn-light">
				<i class="fa fa-plus"> </i>
				<span class="d-sm-block">Create</span>
			</a>
		</li>
	</ul>
@endsection

@section('admin-content')
	<div class="customers-view rbt-data-table">
		@if(Session::has('status'))
			<div class="alert alert-info text-center" role="alert">
				{{ Session::get('status') }}
			</div>
		@endif

		<div class="card">
			<div class="card-header">
				<strong><i class="fa fa-users"> </i> All</strong> Clients
			</div>
			<div class="card-body">
				@if($clients and $clients > 0)
					<clients-data-table
							api-url="{{ route('admin.api.clients.all') }}">
					</clients-data-table>
				@else
					<div class="alert alert-danger py-5" role="alert">
						No Customers Found!
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection
