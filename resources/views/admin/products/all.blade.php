@extends('layouts.admin')

@section('sub-title', 'Products')
@section('page-description', 'View All Products')

@section('products-active', 'active')
@section('products-all-active', 'active')

@section('admin-content')
    <div class="admin-products">
        {{-- Header Summary --}}
        @if(!auth('admin')->user()->isFranchise())
            <div class="admin-content-header-summary">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header rbt-bg-main"><strong>Featured</strong> Products</h5>
                        <div class="card-body rbt-text-main">
                            <span>{{ $summary->featured }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header"><strong>Out of</strong> Stock</h5>
                        <div class="card-body">
                            <span>{{ $summary->out_of_stock }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header"><strong>Inactive</strong> Products</h5>
                        <div class="card-body">
                            <span>{{ $summary->inactive }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header"><strong>Total</strong> Products</h5>
                        <div class="card-body">
                            <span>{{ $summary->total }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{-- All Products --}}
        <product-data-table api_url="{{ route('admin.api.products.all') }}" product_type="all"> </product-data-table>
    </div>
@endsection
