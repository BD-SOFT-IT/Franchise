@extends('layouts.admin')

@section('sub-title', 'Create Coupon')
@section('page-description', 'Create coupon')

@section('marketing-active', 'active')
@section('marketing-coupons-active', 'active')




@section('admin-content')
    <div class="all-admins-container">
        <div class="card new-admin">
            <div class="card-header">
                <strong><i class="fa fa-plus-circle"></i> Create</strong> Coupon
            </div>
            <div class="card-body">
                <form action="{{ route('admin.coupon.create') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="coupon_code" class="col-md-3 col-form-label">Coupon Code</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control {{ $errors->has('coupon_code') ? 'is-invalid' : '' }}" value="{{ old('coupon_code') }}"
                                   id="coupon_code" name="coupon_code" placeholder="Coupon Code" required autofocus>
                            @if ($errors->has('coupon_code'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('coupon_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coupon_discount_amount" class="col-md-3 col-form-label">Discount Amount</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="sbicon sbicon-bdt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control {{ $errors->has('coupon_discount_amount') ? 'is-invalid' : '' }}" value="{{ old('coupon_discount_amount') }}"
                                       id="coupon_discount_amount" name="coupon_discount_amount" placeholder="Discount amount"  >
                                @if ($errors->has('coupon_discount_amount'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('coupon_discount_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coupon_discount_percentage" class="col-md-3 col-form-label">Discount Percentage</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" class="form-control {{ $errors->has('coupon_discount_percentage') ? 'is-invalid' : '' }}" value="{{ old('coupon_discount_percentage') }}"
                                       id="coupon_discount_percentage" name="coupon_discount_percentage" placeholder="Discount percentage">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">
                                        %
                                    </span>
                                </div>
                                @if ($errors->has('coupon_discount_percentage'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('coupon_discount_percentage') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="max_discount_amount" class="col-md-3 col-form-label">Max Discount Amount</label>
                        <div class="col-md-9">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="sbicon sbicon-bdt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control {{ $errors->has('max_discount_amount') ? 'is-invalid' : '' }}" value="{{ old('max_discount_amount') }}"
                                       id="max_discount_amount" name="max_discount_amount" placeholder="Maximum Discount Amount"  >
                                @if ($errors->has('max_discount_amount'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('max_discount_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <small class="form-text text-muted">Maximum amount of discounted price when coupon is based on <span class="text-danger">Percentage</span></small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coupon_note" class="col-md-3 col-form-label">Coupon Note</label>
                        <div class="col-md-9">
                            <textarea class="form-control {{ $errors->has('coupon_note') ? 'is-invalid' : '' }}" name="coupon_note" id="coupon_note" rows="5" style="resize: none;">{!! old('coupon_note')  !!}</textarea>

                            @if ($errors->has('coupon_note'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('coupon_note') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coupon_started" class="col-md-3 col-form-label">Coupon Start From</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control {{ $errors->has('coupon_started') ? 'is-invalid' : '' }}" value="{{ old('coupon_started') }}"
                                   id="coupon_started" name="coupon_started" required>
                            @if ($errors->has('coupon_started'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('coupon_started') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coupon_expired" class="col-md-3 col-form-label">Coupon Expired At</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control {{ $errors->has('coupon_expired') ? 'is-invalid' : '' }}" value="{{ old('coupon_expired') }}"
                                   id="coupon_expired" name="coupon_expired" required>
                            @if ($errors->has('coupon_expired'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('coupon_expired') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                            <button class="btn btn-success" type="submit">Create Coupon</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('custom-script')



@endsection
