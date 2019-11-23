@extends('layouts.admin')

@section('sub-title', 'Edit Category Banners')
@section('page-description', 'Edit Category Banners')

@section('ads-active', 'active')
@section('ads-category-active', 'active')

@section('admin-content')
    <div class="admin-ads">
        <category-banner
                page-title="Category Banner"
                :categories="{{ json_encode($categories) }}"
                api="{{ route('admin.api.ads.category_banners') }}">
        </category-banner>
    </div>
@endsection

@section('custom-script')

@endsection
