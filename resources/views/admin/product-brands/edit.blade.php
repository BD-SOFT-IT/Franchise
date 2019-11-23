@extends('layouts.admin')

@section('sub-title', 'Edit Product Brand')
@section('page-description', 'Edit Product Brand')

@section('brand-active', 'active')
@section('brand-new-active', 'active')


@section('admin-content')
    <div class="rbt-product-brands">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-plus"></i> Edit</strong> Brand
            </div>
            <div class="card-body">
                <div class="create-brand-container">
                    <create-product-brand show_as="page" brand_id="{{ $brand_id }}"></create-product-brand>
                </div>
            </div>
        </div>
    </div>
@endsection