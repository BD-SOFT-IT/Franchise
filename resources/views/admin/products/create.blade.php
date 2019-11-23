@extends('layouts.admin')

@if(isset($product))
    @section('sub-title', 'Edit Product')
    @section('page-description', 'Edit ' . $product->product_title)
@else
    @section('sub-title', 'Add Product')
    @section('page-description', 'Add New Product')
@endif


@section('custom-header-style-scripts')

@endsection

@section('products-active', 'active')
@section('products-new-active', 'active')

@section('admin-content')
    <div class="admin-products">
        {{-- Heaader Summary --}}
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

        {{-- Create Product --}}
        @if(isset($product))
            <create-product product_id="{{ $product->product_id }}"></create-product>
        @else
            <create-product></create-product>
        @endif
    </div>
@endsection

@section('custom-script')

@endsection