@extends('layouts.admin')

@section('sub-title', 'All Product Brands')
@section('page-description', 'All Product Brands')

@section('brand-active', 'active')
@section('brand-all-active', 'active')


@section('admin-content')
    <div class="rbt-product-brands">
        <product-brand-data-table api_url="{{ route('admin.api.brands.all') }}"></product-brand-data-table>
    </div>
@endsection