@extends('theme::layouts.app')

@section('title', 'Order Details :: ')
@section('description', 'Order Details')
@section('keywords', getSiteBasic('site_keywords'))

@section('breadcrumb')
	@component('theme::components.breadcrumb', [
			'data'  => [
				['url' => route('account') . '#accountOrders', 'title' => 'Orders']
			],
			'active'   => 'Order Details'
		])
	@endcomponent
@endsection

@section('content')

	<section class="order-details my-5">
		<div class="container">
			<div>
				@if(isset($status))
					<div class="alert alert-danger not-found" role="alert" style="line-height: 50px; font-size: 22px;">
						<span class="alert-icon" style="font-size: 50px;">
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						</span>
						<br>
						{{ $status }}
					</div>
				@endif

				@if(!isset($status))
					<div class="order-header-summary">
						<div class="row">
							<div class="col-sm-6 col-xl-3">
								<div class="card text-center">
									<h5 class="card-header rbt-bg-main"><strong>ORD# {{ $order->order_no }}</strong></h5>
									<div class="card-body rbt-text-main">
										<span>{{ $order->created_at->format('d/m/Y') }}</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-xl-3">
								<div class="card text-center">
									<h5 class="card-header rbt-bg-main"><strong><i class="fa fa-money"></i> Total</strong></h5>
									<div class="card-body rbt-text-main">
										<span>
											<i class="sbicon sbicon-bdt"> </i> {{ $order->order_total }}
										</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-xl-3">
								<div class="card text-center">
									<h5 class="card-header @if(strtolower($order->order_payment_status) == 'paid') rbt-bg-main @else bg-secondary @endif">
										<strong><i class="fa fa-paypal"></i> Payment</strong>
									</h5>
									<div class="card-body @if(strtolower($order->order_payment_status) == 'paid') rbt-text-main @else text-secondary @endif">
										@if(strtolower($order->order_payment_status) == 'paid')
											<span title="Paid"><i class="fa fa-check"></i></span>
										@else
											<span title="Not Paid"><i class="fa fa-exclamation-circle"></i></span>
										@endif
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-xl-3">
								<div class="card text-center main-bg">
									@if($order->isPending())
										<h5 class="card-header rbt-bg-warning"><strong>Pending</strong></h5>
										<div class="card-body rbt-text-warning">
											<span><i class="fa fa-info-circle"></i></span>
										</div>
									@elseif($order->isProcessing())
										<h5 class="card-header bg-secondary"><strong>Processing</strong></h5>
										<div class="card-body text-secondary">
											<span><i class="fa fa-refresh fa-spin"></i></span>
										</div>
									@elseif($order->isOnDelivery())
										<h5 class="card-header bg-info"><strong>On Delivery</strong></h5>
										<div class="card-body text-info">
											<span><i class="fa fa-globe fa-spin"></i></span>
										</div>
									@elseif($order->isDelivered())
										<h5 class="card-header rbt-bg-main"><strong>Delivered</strong></h5>
										<div class="card-body rbt-text-main">
											<span><i class="fa fa-check"></i></span>
										</div>
									@elseif($order->isCanceled())
										<h5 class="card-header bg-danger"><strong>Canceled</strong></h5>
										<div class="card-body text-danger">
											<span><i class="fa fa-ban"></i></span>
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>

					{{-- Order Details --}}
					<div class="order-products clearfix">
						<div class="card">
							<div class="card-header rbt-text-main-dark">
								<strong><i class="fa fa-shopping-cart"></i> Products</strong>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
										<tr>
											<th scope="col" class="text-center" style="width: 130px;">#</th>
											<th scope="col">Product Name</th>
											<th scope="col" class="text-right">Unit Price</th>
											<th scope="col" class="text-right">Quantity</th>
											<th scope="col" class="text-right">Amount</th>
										</tr>
										</thead>
										<tbody>
										@foreach($order->orderDetails as $index => $detail)
											<tr>
												<th scope="row" class="text-center align-middle">
													{{ $index + 1 }}
												</th>

												<td class="title align-middle">
													<div class="product-title">
														{{ $detail->product->product_title }} - {{ $detail->product->product_title_bengali }}
													</div>
													@if($detail->od_product_discount_amount != null || $detail->od_product_discount_percentage != null)
														<div class="product-discount">
															@if($detail->od_product_discount_amount != null)
																<small style="font-size: 11px;"><strong><i class="sbicon sbicon-bdt"></i> {{ $detail->od_product_discount_amount }} Off</strong></small>
															@else
																<small style="font-size: 11px;"><strong>{{ $detail->od_product_discount_percentage }}% Off</strong></small>
															@endif
														</div>
													@endif
												</td>

												<td class="text-right align-middle">
													<i class="sbicon sbicon-bdt"></i> {{ number_format((float)$detail->od_product_unit_mrp, 2, '.', '') }}
												</td>

												<td class="text-right align-middle">{{ $detail->od_product_quantity }}</td>

												<td class="text-right align-middle">
													<i class="sbicon sbicon-bdt"></i> {{ number_format((float)$detail->od_product_total, 2, '.', '') }}
												</td>
											</tr>
										@endforeach
										{{-- Sub Total --}}
										<tr>
											<td colspan="4" class="text-right align-middle font-weight-bold">Sub Total</td>
											<td class="text-right">
												<i class="sbicon sbicon-bdt"></i> {{ number_format((float)$order->order_products_total, 2, '.', '') }}
											</td>
										</tr>
										{{-- Coupon Code Discount --}}
										@if($order->order_coupon_code_discount != null && $order->order_coupon_code_discount != 0.00)
											<tr>
												<td colspan="4" class="text-right align-middle font-weight-bold">
													Discount
													<br>
													<small style="font-size: 11px;">Coupon Code: <strong>{{ $order->couponHistory->coupon->coupon_code }}</strong></small>
												</td>
												<td class="text-right">
													-<i class="sbicon sbicon-bdt"></i> {{ number_format((float)$order->order_coupon_code_discount, 2, '.', '') }}
												</td>
											</tr>
										@endif
										{{-- Vat --}}
										<tr>
											<td colspan="4" class="text-right align-middle font-weight-bold">Vat</td>
											<td class="text-right">
												<i class="sbicon sbicon-bdt"></i> {{ number_format((float)$order->order_vat, 2, '.', '') }}
											</td>
										</tr>

										{{-- Shipping Fees --}}
										<tr>
											<td colspan="4" class="text-right align-middle font-weight-bold">
												Shipping Fees <small style="font-size: 92%;">({{ $order->shippingMethod->method_name }})</small>
											</td>
											<td class="text-right">
												<i class="sbicon sbicon-bdt"></i> {{ number_format((float)$order->shippingMethod->method_charge, 2, '.', '') }}
											</td>
										</tr>

										{{-- Total --}}
										<tr>
											<td colspan="4" class="text-right align-middle font-weight-bold">Total <small style="font-size: 92%;">(To be Paid)</small></td>
											<td class="text-right">
												<strong><i class="sbicon sbicon-bdt"></i> {{ number_format((float)$order->order_total, 2, '.', '') }}</strong>
											</td>
										</tr>
										{{-- Paid --}}
										<tr>
											<td colspan="4" class="text-right align-middle font-weight-bold">Paid</td>
											<td class="text-right">
												<i class="sbicon sbicon-bdt"></i> {{ number_format((float)($order->order_total - $order->order_total_due), 2, '.', '') }}
											</td>
										</tr>

										{{-- Paid with SB Account --}}
										@if($order->order_total_paid_with_account > 0)
											<tr>
												<td colspan="4" class="text-right align-middle font-weight-bold">
													@if($order->order_total_paid_with_account > 0)
														Paid <small>(SohojBazaar Account)</small>
														<br>
													@endif
													@if($order->order_payment_status == 'paid' || $order->order_payment_status == 'Paid')
														Paid <small>({{ $order->order_payment_type }})</small>
													@endif
												</td>
												<td class="text-right">
													@if($order->order_total_paid_with_account > 0)
														<i class="sbicon sbicon-bdt"></i> {{ number_format((float)$order->order_total_paid_with_account, 2, '.', '') }}
													@endif
													@if($order->order_payment_status == 'paid' || $order->order_payment_status == 'Paid')
														<i class="sbicon sbicon-bdt"></i> {{ number_format((float)($order->order_total - $order->order_total_paid_with_account), 2, '.', '') }}
													@endif
												</td>
											</tr>
										@endif

										<tr>
											<td colspan="4" class="text-right align-middle font-weight-bold">Total Due</td>
											<td class="text-right">
												<i class="sbicon sbicon-bdt"></i> {{ number_format((float)$order->order_total_due, 2, '.', '') }}
											</td>
										</tr>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					{{-- Order Address --}}
					<div class="order-address clearfix">
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header rbt-text-main-dark">
										<strong><i class="fa fa-address-card-o"></i> Billing</strong> Address
									</div>
									@php($client = auth()->user())
									<div class="card-body">
										<address class="order-address">
											<h5 class="name">
												{{ $client->full_name }}
											</h5>
											<span class="address">{{ $client->billing_address }}</span>
											<br>
											<span class="city">{{ $client->billing_city }}, {{ $client->billing_state }}</span>
											<br>
											<span class="country">
                                        Bangladesh @if($client->billing_postcode != null) {{ '-' . $client->billing_postcode }} @endif
                                    </span>
											<br>
											<br>
											<span class="phone">
                                        <i class="fa fa-phone"></i> {{ mobileNumber($client->mobile) }}
                                    </span>
											<br>
											<span class="email">
                                        <i class="fa fa-envelope-o"></i> <a href="mailto:{{ $client->email }}" title="Click to send mail.">{{ $client->email }}</a>
                                    </span>
										</address>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="card">
									<div class="card-header rbt-text-main-dark">
										<strong><i class="fa fa-address-card-o"></i> Shipping</strong> Address
									</div>
									<div class="card-body">
										<address class="order-address">
											<h5 class="name">
												{{ $order->order_shipping_person }}
											</h5>
											<span class="address">{{ $order->order_shipping_address }}</span>
											<br>
											<span class="city">{{ $order->order_shipping_city }}, {{ $order->order_shipping_state }}</span>
											<br>
											<span class="country">
                                        Bangladesh @if($order->order_shipping_postcode != null) {{ '-' . $order->order_shipping_postcode }} @endif
                                    </span>
											<br>
											<br>
											<span class="phone">
                                        <i class="fa fa-phone"></i> {{ mobileNumber($order->order_shipping_phone) }}
                                    </span>
										</address>
									</div>
								</div>
							</div>
						</div>
					</div>

					{{-- Order Note --}}
					<div class="order-information clearfix">
						<div class="row justify-content-center">
							<div class="col-md-9">
								<div class="card admin-order-note">
									<div class="card-header rbt-text-main-dark">
										<strong><i class="fa fa-file-text-o"></i> Order Note</strong>
									</div>
									<div class="card-body">
										@if($order->order_note == null)
											<div class="show-nothing">
												No instruction given!
											</div>
										@else
											<span>{!! nl2br($order->order_note) !!}</span>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>

				@endif
			</div>
		</div>
	</section>

@endsection
