@extends('layouts.admin')

@section('sub-title', 'Create New Product Brand')
@section('page-description', 'Create New Product Brand')

@section('brand-active', 'active')
@section('brand-new-active', 'active')


@section('admin-content')
    <div class="rbt-product-brands">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-plus"></i> Add</strong> Brand
            </div>
            <div class="card-body">
                <div class="create-brand-container">
                    <create-product-brand show_as="page"></create-product-brand>
                </div>
            </div>
        </div>
    </div>
@endsection