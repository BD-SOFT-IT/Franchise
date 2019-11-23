@extends('layouts.admin')

@section('sub-title', 'View Order')
@section('page-description', 'View the order details')

@section('orders-active', 'active')

@section('header-action')
    @if(!isset($not_found))
        <ul class="nav justify-content-end">
            <li class="nav-item text-center">
                <button class="nav-link btn btn-light" @click.prevent="printBill">
                    <i class="fa fa-print"></i>
                    <span class="d-none d-sm-block">Print Order</span>
                </button>
            </li>

        {{--@can('update-order', $order)
            @if($order->order_progress == 'pending' || $order->order_progress == 'processing')
                <li class="nav-item text-center">
                    <a class="nav-link btn btn-light" href="{{ route('admin.orders.edit', ['order_no' => $order->order_no]) }}">
                        <i class="fa fa-pencil"></i>
                        <span class="d-none d-sm-block">Edit Order</span>
                    </a>
                </li>
            @endif
        @endcan--}}

        @can('approve-order', $order)
            @if($order->order_progress == 'pending')
                <li class="nav-item text-center">
                    <a class="nav-link btn btn-light" data-toggle="modal" data-target="#orderApproveModal" href="javascript:void(0)">
                        <i class="fa fa-check"></i>
                        <span class="d-none d-sm-block">Accept Order</span>
                    </a>
                    {{-- Approve Modal --}}
                    <div class="modal wow zoomIn animated" data-wow-duration="500ms" id="orderApproveModal" tabindex="-1" role="dialog" aria-labelledby="orderApproveModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center w-100" id="orderApproveModalLabel">Approve Order</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-left">
                                    Are you sure want to approve this order?
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('admin.orders.approve') }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="order_no" value="{{ $order->order_no }}">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Approve Order</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
        @endcan

        @can('process-order', $order)
            @if($order->order_progress == 'processing')
                <li class="nav-item text-center">
                    <a class="nav-link btn btn-light" data-toggle="modal" data-target="#orderProcessModal" href="javascript:void(0)">
                        <i class="fa fa-hourglass-1"></i>
                        <span class="d-none d-sm-block">Complete Process</span>
                    </a>
                    {{-- Process Modal --}}
                    <div class="modal wow zoomIn animated" data-wow-duration="500ms" id="orderProcessModal" tabindex="-1" role="dialog" aria-labelledby="orderProcessModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="{{ route('admin.orders.process') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center w-100" id="orderProcessModalLabel">Complete Process</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        @if(auth('admin')->user()->isFranchise() || $order->byFranchise)
                                            <div class="text-center">Are You Sure?</div>
                                        @else
                                            <div class="form-group">
                                                <label for="shipperDeliveryID">Select Shipper for the Order</label>
                                                <select class="custom-select" id="shipperDeliveryID" name="order_shipper_id" required>
                                                    <option selected>-- Select Shipper --</option>
                                                    @foreach($shippers as $shipper)
                                                        <option value="{{ $shipper->shipper_id }}">{{ $shipper->shipper_name }} <strong>({{ $shipper->shipper_company }})</strong></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="order_no" value="{{ $order->order_no }}">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Submit for Delivery</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
        @endcan

        @can('deliver-order', $order)
            @if($order->order_progress == 'on delivery')
                <li class="nav-item text-center">
                    <a class="nav-link btn btn-light" data-toggle="modal" data-target="#orderDeliverModal" href="javascript:void(0)">
                        <i class="fa fa-truck"></i>
                        <span class="d-none d-sm-block">Complete Delivery</span>
                    </a>
                    {{-- Deliver Modal --}}
                    <div class="modal wow zoomIn animated" data-wow-duration="500ms" id="orderDeliverModal" tabindex="-1" role="dialog" aria-labelledby="orderDeliverModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="{{ route('admin.orders.deliver') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center w-100" id="orderDeliverModalLabel">Complete Delivery</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        To complete the delivery process <br>
                                        Please enter the delivery pin below & submit..

                                        <div class="form-group text-center">
                                            <label for="2fa" class="sr-only">Delivery Pin</label>
                                            <input type="text" name="auth_code" id="2fa" class="form-control text-center" placeholder="Secret Delivery Pin" style="width: 140px; margin: 0 auto;" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="order_no" value="{{ $order->order_no }}">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Complete Delivery</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
        @endcan

        @can('cancel-order', $order)
            @if($order->order_progress != 'delivered' || $order->order_progress != 'canceled' || $order->order_progress != 'returned')
                <li class="nav-item text-center">
                    <a class="nav-link btn btn-light" data-toggle="modal" data-target="#orderCancelModal" href="javascript:void(0)">
                        <i class="fa fa-ban"></i>
                        <span class="d-none d-sm-block">Cancel Order</span>
                    </a>
                    {{-- Cancel Modal --}}
                    <div class="modal wow zoomIn animated" data-wow-duration="500ms" id="orderCancelModal" tabindex="-1" role="dialog" aria-labelledby="orderCancelModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="{{ route('admin.orders.cancel') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center w-100" id="orderCancelModalLabel">Cancel Order</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        Are sure sure want to cancel order?
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="order_no" value="{{ $order->order_no }}">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning">Cancel Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
        @endcan

        @can('delete-order')
            <li class="nav-item text-center">
                <a class="nav-link btn btn-light" data-toggle="modal" data-target="#orderDeleteModal" href="javascript:void(0)">
                    <i class="fa fa-trash-o"></i>
                    <span class="d-none d-sm-block">Delete Order</span>
                </a>
                {{-- Delete Modal --}}
                <div class="modal wow zoomIn animated" data-wow-duration="500ms" id="orderDeleteModal" tabindex="-1" role="dialog" aria-labelledby="orderDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.orders.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title text-center w-100" id="orderDeleteModalLabel">Delete Order</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    Are sure sure want to delete order?
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="order_no" value="{{ $order->order_no }}">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        @endcan
    </ul>
    @endif
@endsection

@section('admin-content')
    <div class="admin-order-single">

        @if(isset($not_found) && $not_found)
            <div class="alert alert-danger not-found" role="alert">
                <span class="alert-icon">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </span>
                <br>
                Oops..! Your requested order not found!
            </div>
        @endif

        @if(Session::has('status'))
            <div class="alert alert-success" role="alert">
            <span class="alert-icon">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            </span>
                <br>
                {{ Session::get('status') }}
            </div>
        @endif

        @if(!isset($not_found) && isset($order) && $order != null)
            <div class="admin-content-header-summary">
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
                                @if($order->order_currency == 'usd')
                                    <span><i class="fa fa-dollar" style="font-size: 26px !important;"></i> {{ $order->order_total }}</span>
                                @else
                                    <span><i class="sbicon sbicon-bdt" style="font-size: 22px !important; margin-right: -5px;"></i> {{ $order->order_total }}</span>
                                @endif
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
            <div class="admin-order-products clearfix">
                <div class="card">
                    <div class="card-header rbt-text-main-dark">
                        <strong><i class="fa fa-shopping-cart"></i> Products</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 130px;">Product SKU</th>
                                        <th scope="col">Title</th>
                                        <th scope="col" class="text-right">Unit Price</th>
                                        <th scope="col" class="text-right">Quantity</th>
                                        <th scope="col" class="text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order_details as $detail)
                                        <tr>
                                            <th scope="row" class="text-center align-middle" style="width: 130px;">
                                                <a href="{{ route('admin.products.single', ['sku' => $detail->product->product_sku]) }}">
                                                    {{ $detail->product->product_sku }}
                                                </a>
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
                                            Shipping Fees <small style="font-size: 92%;">({{ $order->shippingMethod ? $order->shippingMethod->method_name : '' }})</small>
                                        </td>
                                        <td class="text-right">
                                            <i class="sbicon sbicon-bdt"></i> {{ number_format((float)($order->shippingMethod ? $order->shippingMethod->method_charge : 0), 2, '.', '') }}
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
            <div class="admin-order-address clearfix">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header rbt-text-main-dark">
                                <strong><i class="fa fa-address-card-o"></i> Billing</strong> Address
                            </div>
                            <div class="card-body">
                                <address class="order-address">
                                    <h5 class="name">
                                        @if($client)
                                            {{ $client->full_name }}
                                        @elseif($franchise)
                                            {{ $franchise->name }} (Franchise)
                                        @endif
                                    </h5>
                                    <span class="address">
                                        @if($client)
                                            {{ $client->billing_address }}
                                        @elseif($franchise)
                                            {{ $franchise->address }}
                                        @endif
                                    </span>
                                    <br>
                                    <span class="city">
                                        @if($client)
                                            {{ $client->billing_city }}, {{ $client->billing_state }}
                                        @elseif($franchise)
                                            {{ $franchise->city }}
                                        @endif
                                    </span>
                                    <br>
                                    <span class="country">
                                        Bangladesh
                                        @if($client)
                                            @if($client->billing_postcode != null) {{ '-' . $client->billing_postcode }} @endif
                                        @elseif($franchise)
                                            @if($franchise->postcode != null) {{ '-' . $franchise->postcode }} @endif
                                        @endif
                                    </span>
                                    <br>
                                    <br>
                                    <span class="phone">
                                        @if($client)
                                            <i class="fa fa-phone"> </i> {{ mobileNumber($client->mobile) }}
                                        @elseif($franchise)
                                            <i class="fa fa-phone"></i> {{ mobileNumber($franchise->mobile_primary) }}
                                        @endif
                                    </span>
                                    <br>
                                    <span class="email">
                                        @if($client)
                                            <i class="fa fa-envelope-o"></i> <a href="mailto:{{ $client->email }}" title="Click to send mail.">{{ $client->email }}</a>
                                        @elseif($franchise)
                                            <i class="fa fa-envelope-o"></i> <a href="mailto:{{ $franchise->email }}" title="Click to send mail.">{{ $franchise->email }}</a>
                                        @endif
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
            <div class="admin-order-information clearfix">
                <div class="row">
                    @if(!auth('admin')->user()->isShipper())
                        <div class="col-md-6">
                            <div class="card admin-order-shipper">
                                <div class="card-header rbt-text-main-dark">
                                    <strong><i class="fa fa-truck"></i> Shipper Details</strong>
                                </div>
                                <div class="card-body">
                                    @if($order->order_shipper_id == null)
                                        <div class="show-nothing">
                                            Shipper not yet selected.
                                        </div>
                                    @else
                                        <h5 class="shipper-name" title="Shipper Name">
                                            {{ $order->shipper_name }}
                                        </h5>
                                        <div class="shipper-details">
                                        <span title="Shipper Company">
                                            <i class="fa fa-building-o"></i> {{ $order->shipper_company }}
                                        </span>
                                            <br>
                                            <span title="Shipper Phone">
                                            <i class="fa fa-phone"></i> {{ $order->shipper_phone }}
                                        </span>
                                            <br>
                                            @if($order->shipper_email)
                                                <span title="Shipper Email">
                                                <i class="fa fa-envelope-o"></i> {{ $order->shipper_email }}
                                            </span>
                                                <br>
                                            @endif
                                            <span title="Shipper Address">
                                            <i class="fa fa-address-card-o"></i> {{ $order->shipper_address }}
                                        </span>
                                            <br>
                                            @if($order->shipper_website)
                                                <span title="Shipper Website">
                                                <i class="fa fa-globe"></i> <a title="Go to {{ $order->shipper_website }}" href="{{ $order->shipper_website }}" target="_blank">{{ $order->shipper_website }}</a>
                                            </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="card admin-order-note">
                            <div class="card-header rbt-text-main-dark">
                                <strong><i class="fa fa-file-text-o"></i> Order Instructions</strong>
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

            {{-- Order Log --}}
            @can('create-order')
                <div class="admin-order-log clearfix">
                    <div class="card">
                        <div class="card-header rbt-text-main-dark">
                            <strong><i class="fa fa-calendar"></i> Order Log</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if($order->order_log != null)
                                    <table class="table table-bordered">
                                    <tbody>
                                        @php
                                            $log_array = convertStringToArray($order->order_log, true);
                                        @endphp
                                        @foreach($log_array as $log)
                                            <tr>
                                                <td>{{ $log['time'] }}</td>
                                                <td>
                                                    {{ $log['author_name'] }} <small><strong style="font-size: 11px;">({{ $log['author_type'] }})</strong></small>
                                                </td>
                                                <td>{{ $log['type'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    Nothing to show
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            {{-- For Invoice --}}
            <div id="orderPrint">
                <table class="header-table">
                    <tbody>
                    <tr>
                        <td class="header-logo">
                            <div class="logo" style="background-image: url('/images/logo_print.png') !important;
                                    background-repeat: no-repeat !important; background-position: center !important; background-size: contain; height: 160px; width: 160px; opacity: 0.85;">
                            </div>
                            <p class="sb-address">
                                {!! getSiteBasic('site_address') !!} <br>
                                Mobile: {{ mobileNumber(getSiteBasic('site_mobile')) }}
                            </p>
                        </td>
                        <td class="invoice">
                            Invoice
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="info-table">
                    <tbody>
                    <tr>
                        <td class="td-row"><strong>Order NO#</strong></td>
                        <td>{{ $order->order_no }}</td>
                        <td class="td-row"><strong>Order Date</strong></td>
                        <td class="text-right">{{ $order->created_at->format('jS F, Y') }}</td>
                    </tr>
                    <tr>
                        <td class="td-row"><strong>Bill To</strong></td>
                        <td>{{ $order->order_shipping_person }}</td>
                        <td class="td-row"><strong>Contact</strong></td>
                        <td class="text-right">{{ $order->order_shipping_phone ? mobileNumber($order->order_shipping_phone) : mobileNumber($order->client->mobile) }}</td>
                    </tr>
                    <tr>
                        <td class="td-row"><strong>Address</strong></td>
                        <td colspan="3">
                            {{ $order->order_shipping_address . ', ' }}
                            {{ (strtolower($order->order_shipping_area) != 'others') ? $order->order_shipping_area . ', ' : '' }}
                            {{ $order->order_shipping_city }}
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="products-table" style="margin-bottom: 45px;">
                    <thead>
                    <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">Description</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderDetails as $key => $detail)
                        <tr>
                            <th scope="row">
                                {{ $key + 1 }}
                            </th>

                            <td class="title">
                                <div class="product-title">
                                    {{ $detail->product->product_title }} <br> <span class="bangla">{{ $detail->product->product_title_bengali }}</span>
                                </div>
                                @if(($detail->od_product_discount_amount && $detail->od_product_discount_amount > 0) || ($detail->od_product_discount_percentage && $detail->od_product_discount_percentage > 0))
                                    <div class="product-discount">
                                        @if($detail->od_product_discount_amount != null)
                                            <small style="font-size: 11px;"><strong> ৳ {{ $detail->od_product_discount_amount }} Off</strong></small>
                                        @else
                                            <small style="font-size: 11px;"><strong>{{ $detail->od_product_discount_percentage }}% Off</strong></small>
                                        @endif
                                    </div>
                                @endif
                            </td>

                            <td class="unit-price">
                                {{ number_format((float)$detail->od_product_unit_mrp, 2, '.', '') }}
                            </td>

                            <td class="quantity">{{ $detail->od_product_quantity }}</td>

                            <td class="total-price">
                                {{ number_format((float)$detail->od_product_total, 2, '.', '') }}
                            </td>
                        </tr>
                    @endforeach
                    {{-- Sub Total --}}
                    <tr>
                        <td colspan="4" class="td-row">Sub Total</td>
                        <td class="total-price">
                            {{ number_format((float)$order->order_products_total, 2, '.', '') }}
                        </td>
                    </tr>
                    {{-- Coupon Code Discount --}}
                    @if($order->order_coupon_code_discount != null && $order->order_coupon_code_discount != 0.00)
                        <tr>
                            <td colspan="4" class="td-row">
                                Discount
                                <br>
                                <small style="font-size: 11px;">Coupon Code: <strong>{{ $order->couponHistory->coupon->coupon_code }}</strong></small>
                            </td>
                            <td class="total-price">
                                -{{ number_format((float)$order->order_coupon_code_discount, 2, '.', '') }}
                            </td>
                        </tr>
                    @endif
                    {{-- Vat --}}
                    <tr>
                        <td colspan="4" class="td-row">Vat</td>
                        <td class="total-price">
                            {{ number_format((float)$order->order_vat, 2, '.', '') }}
                        </td>
                    </tr>

                    {{-- Shipping Fees --}}
                    <tr>
                        <td colspan="4" class="td-row">
                            Shipping Fees <small style="font-size: 92%;">({{ $order->shippingMethod ? $order->shippingMethod->method_name : '' }})</small>
                        </td>
                        <td class="total-price">
                            ৳ {{ number_format((float)($order->shippingMethod ? $order->shippingMethod->method_charge : 0), 2, '.', '') }}
                        </td>
                    </tr>

                    {{-- Total --}}
                    <tr>
                        <td colspan="4" class="td-row">Total <small>(To be Paid)</small></td>
                        <td class="total-price">
                            ৳ <strong>{{ number_format((float)$order->order_total, 2, '.', '') }}</strong>
                        </td>
                    </tr>
                    {{-- Paid --}}
                    <tr>
                        <td colspan="4" class="td-row">Paid</td>
                        <td class="total-price">
                            ৳ {{ number_format((float)($order->order_total - $order->order_total_due), 2, '.', '') }}
                        </td>
                    </tr>
                    {{-- Paid with SB Account --}}
                    @if($order->order_total_paid_with_account > 0)
                        <tr>
                            <td colspan="4" class="td-row">
                                @if($order->order_total_paid_with_account > 0)
                                    Paid <small>(SohojBazaar Account)</small>
                                    <br>
                                @endif
                                @if($order->order_payment_status == 'paid' || $order->order_payment_status == 'Paid')
                                    Paid <small>({{ $order->order_payment_type }})</small>
                                @endif
                            </td>
                            <td class="total-price">
                                @if($order->order_total_paid_with_account > 0)
                                    {{ number_format((float)$order->order_total_paid_with_account, 2, '.', '') }}
                                    <br>
                                @endif
                                @if($order->order_payment_status == 'paid' || $order->order_payment_status == 'Paid')
                                    {{ number_format((float)($order->order_total - $order->order_total_paid_with_account), 2, '.', '') }}
                                @endif
                            </td>
                        </tr>
                    @endif

                    <tr class="last-total">
                        <td colspan="2" class="signature" style="border: 0 !important;">
                            <span style="border-top: 1px dotted #000;">Customer Signature</span>
                        </td>
                        <td colspan="2" class="td-row"><strong>Total Due</strong></td>
                        <td class="total-price">
                            <strong>৳ {{ number_format((float)$order->order_total_due, 2, '.', '') }}</strong>
                        </td>
                    </tr>

                    </tbody>
                </table>

                <footer class="footer" style="margin-top: 45px;">
                    <div class="footer-thanks">
                        Thank You for shopping with us.
                    </div>
                    <div class="footer-text">
                        If you have any question regarding this invoice, Please call us at: {{ mobileNumber(getSiteBasic('site_mobile')) }}
                    </div>
                </footer>

            </div>

        @endif
    </div>
@endsection
