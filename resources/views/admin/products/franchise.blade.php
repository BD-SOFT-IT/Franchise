@extends('layouts.admin')

@section('sub-title', 'Franchise Products')
@section('page-description', 'View All Franchise Products')

@section('products-active', 'active')
@section('products-own-active', 'active')

@section('admin-content')
    <div class="admin-products">
        <product-data-table
                api_url="{{ route('admin.api.products.franchise') }}"
                :franchise-own="true"
                product_type="all">
        </product-data-table>
    </div>
@endsection
