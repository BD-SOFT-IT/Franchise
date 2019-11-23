@extends('layouts.admin')

@section('sub-title', 'Edit Index Page Sliders')
@section('page-description', 'Edit Index Page Sliders')

@section('ads-active', 'active')
@section('ads-index-banner-active', 'active')

@section('admin-content')
    <div class="admin-ads">
        <promotional-banner
                page-title="Page Middle Banners"
                img-placeholder="https://via.placeholder.com/630x175?text=630x175+px"
                api="{{ route('admin.api.ads.index_banners') }}">
        </promotional-banner>
    </div>
@endsection

@section('custom-script')

@endsection
