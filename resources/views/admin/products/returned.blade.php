@extends('layouts.admin')

@section('sub-title', 'Returned Products')
@section('page-description', 'View All Returned Products')

@section('products-active', 'active')
@section('products-returned-active', 'active')

@section('admin-content')
    <div class="admin-products">
        {{-- Heaader Summary --}}
        <div class="admin-content-header-summary">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header rbt-bg-main"><strong>Featured</strong> Products</h5>
                        <div class="card-body rbt-text-main">
                            <span></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header"><strong>Out of</strong> Stock</h5>
                        <div class="card-body">
                            <span></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header"><strong>Inactive</strong> Products</h5>
                        <div class="card-body">
                            <span></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header"><strong>Total</strong> Products</h5>
                        <div class="card-body">
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Returned Products --}}
    </div>
@endsection