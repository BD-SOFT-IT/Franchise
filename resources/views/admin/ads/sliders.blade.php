@extends('layouts.admin')

@section('sub-title', 'Edit Home Sliders')
@section('page-description', 'Edit Home Sliders')

@section('ads-active', 'active')
@section('ads-sliders-active', 'active')

@section('admin-content')
    <div class="admin-ads">
        <promotional-banner
                page-title="Home Sliders"
                img-placeholder="https://via.placeholder.com/1335x750?text=Promotional+Image(1335x750)"
                api="{{ route('admin.api.ads.sliders') }}">
        </promotional-banner>
    </div>
@endsection

@section('custom-script')

@endsection
