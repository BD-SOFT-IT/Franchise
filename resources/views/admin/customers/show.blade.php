@extends('layouts.admin')

@section('sub-title', 'Customers Details')
@section('page-description', 'Customers Details')

@section('customers-active', 'active')
@section('customers-all-active', 'active')

@section('admin-content')
	<div class="customers-view">

		@if(isset($notFound))
			<div class="alert alert-danger text-center py-5" role="alert">
				<h5 class="font-weight-bold">{{ $notFound }}</h5>
			</div>
		@else
			<div class="card">
				<div class="card-header">
					<strong><i class="fa fa-user"> </i> Customer's</strong> Details
				</div>
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-xl-5">
							<div class="customers-details customers-wrapper text-center">
								@if($client->img_url && strlen($client->img_url) > 7)
									<img src="{{ staticAsset($client->img_url) }}" alt="{{ $client->full_name }}">
								@else
									<img src="{{ staticAsset('images/default_male.png') }}" alt="{{ $client->full_name }}">
								@endif

								<h5> {{ $client->full_name }} </h5>
								<hr>
									<table class="table table-borderless text-left">
										<tbody>
											<tr>
												<th scope="row">Email</th>
												<td>{{ $client->email }}</td>
											</tr>
											<tr>
												<th scope="row">Mobile</th>
												<td>{{ $client->mobile ? mobileNumber($client->mobile) : '' }}</td>
											</tr>
											<tr>
												<th scope="row">Mobile Secondary</th>
												<td>{{ $client->mobile_secondary ? mobileNumber($client->mobile_secondary) : '' }}</td>
											</tr>
											<tr>
												<th scope="row">Blood Group</th>
												<td>{{ $client->blood_group }}</td>
											</tr>
											<tr>
												<th scope="row">Address</th>
												<td>{{ $client->billing_address . ', ' . $client->billing_area }}</td>
											</tr>
											<tr>
												<th scope="row">City/District</th>
												<td>{{ $client->billing_city }}</td>
											</tr>
											<tr>
												<th scope="row">State/Division</th>
												<td>{{ $client->billing_state }}</td>
											</tr>
											<tr>
												<th scope="row">Postcode</th>
												<td>{{ $client->billing_postcode }}</td>
											</tr>
										</tbody>
									</table>
							</div>
						</div>

						<div class="col-xl-7">
							<div class="customers-wrapper">
								<h4 class="w-100 text-center mb-3">Order History</h4>
								<table class="table table-striped">
									<thead class="thead-light">
										<tr>
											<th scope="col">#</th>
											<th scope="col">Order NO</th>
											<th scope="col">Total</th>
											<th scope="col">Status</th>
										</tr>
									</thead>
									<tbody>
									@forelse($client->orders as $index => $order)
										<tr>
											<th scope="row">{{ $index + 1 }}</th>
											<td>
												<a href="{{ route('admin.orders.single', ['no' => $order->order_no]) }}">{{ $order->order_no }}</a>
											</td>
											<td> <i class="sbicon sbicon-bdt"> </i> {{ number_format($order->order_total, 2) }}</td>
											<td>{{ $order->order_progress }}</td>
										</tr>
									@empty
									@endforelse
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection
