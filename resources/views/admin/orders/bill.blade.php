@extends('layouts.admin')

@section('sub-title', 'Print Invoice')
@section('page-description', 'Print Invoice')

@section('orders-active', 'active')

@section('header-action')
    <ul class="nav justify-content-end">
        <li class="nav-item text-center">
            <button class="nav-link btn btn-light" @click.prevent="printBill">
                <i class="fa fa-print"></i>
                <span class="d-none d-sm-block">Print Order</span>
            </button>
        </li>
    </ul>
@endsection

@section('admin-content')
    <div class="admin-order-single">
        <div class="admin-order-products clearfix">
            <div class="card">
                <div class="card-header rbt-text-main-dark">
                    <strong><i class="fa fa-shopping-cart"></i> Bill</strong>
                </div>
                <div class="card-body">
                    <div id="orderPrint">
                        <table class="header-table">
                            <tbody>
                                <tr>
                                    <td class="header-logo">
                                        <div class="logo" style="background-image: url('{{ asset('assets/images/logo_bw.png') }}') !important; background-repeat: no-repeat !important;
                                                background-position: center !important; background-size: cover; height: 60px; width: 200px; opacity: 0.7;"></div>
                                        <p class="sb-address">
                                            248/A, Bangla Sharak, Rayer Bazaar, Dhaka-1209 <br>
                                            Mobile: 880 1619 229227
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
                                <td>{{ $order->created_at->format('jS F, Y') }}</td>
                            </tr>
                            <tr>
                                <td class="td-row"><strong>Bill To</strong></td>
                                <td colspan="3">{{ $order->order_shipping_person }}</td>
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

                        <table class="products-table">
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
                                        @if($detail->od_product_discount_amount != null || $detail->od_product_discount_percentage != null)
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
                            @if($order->order_coupon_code_discount != null)
                                <tr>
                                    <td colspan="4" class="td-row">
                                        Discount
                                        <br>
                                        <small style="font-size: 11px;">Coupon Code: <strong>{{ $order->couponHistory->coupon->coupon_code }}</strong></small>
                                    </td>
                                    <td class="total-price">
                                        {{ number_format((float)$order->order_coupon_code_discount, 2, '.', '') }}
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
                                <td colspan="4" class="td-row">Shipping Fees</td>
                                <td class="total-price">
                                    {{ number_format((float)$order->order_shipping_fees, 2, '.', '') }}
                                </td>
                            </tr>

                            {{-- Total --}}
                            <tr>
                                <td colspan="4" class="td-row">Total <small>(To be Paid)</small></td>
                                <td class="total-price">
                                    {{ number_format((float)$order->order_total, 2, '.', '') }}
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

                            <tr>
                                <td colspan="4" class="td-row"><strong>Total Due</strong></td>
                                <td class="total-price">
                                    <strong>৳ {{ number_format((float)$order->order_total_due, 2, '.', '') }}</strong>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                        <div class="footer" style="margin-top: 10px;">
                            <div class="signature">
                                <span style="border-top: 1px dotted #000;">Customer Signature</span>
                            </div>
                            <div class="footer-thanks">
                                Thank You for shopping with us.
                            </div>
                            <div class="footer-text">
                                If you have any question regarding this invoice, Please call us at +880 1619 229227
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection