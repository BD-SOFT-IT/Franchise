@extends('layouts.admin')

@section('sub-title', 'Coupons')
@section('page-description', 'All coupons')

@section('marketing-active', 'active')
@section('marketing-coupons-active', 'active')

@section('header-action')

    <ul class="nav justify-content-end">
        <li class="nav-item text-center">
            <a href="{{ route('admin.coupon.create') }}" class="nav-link btn btn-light">
                <i class="fa fa-plus"></i>
                <span class="d-sm-block">Create</span>
            </a>
        </li>
    </ul>
@endsection


@section('admin-content')
    <div class="all-admins-container">
        <div class="card new-admin">
            <div class="card-header">
                <strong><i class="fa fa-info-circle"></i> All</strong> Coupons
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Coupon</th>
                                <th>Discount</th>
                                <th>Max Discount</th>
                                <th>Start From</th>
                                <th>Expires At</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $index => $coupon)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ ($coupon->coupon_discount_amount && $coupon->coupon_discount_amount > 0) ? $coupon->coupon_discount_amount . ' TK' : $coupon->coupon_discount_percentage . '%' }}</td>
                                    <td>{{ number_format($coupon->coupon_max_amount, 2) . ' TK' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($coupon->coupon_started)->format('j F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($coupon->coupon_expired)->format('j F Y') }}</td>
                                    <td>{{ ($coupon->coupon_active) ? 'Active' : 'Inactive' }}</td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
