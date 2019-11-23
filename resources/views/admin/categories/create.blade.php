@extends('layouts.admin')

@section('sub-title', 'Create Category')
@section('page-description', 'Create new Categories')

@section('categories-active', 'active')
@section('categories-new-active', (isset($categoryId) ? '' : 'active' ))

@section('admin-content')
    <div class="admin-categories">
        <div class="admin-content-header-summary">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header rbt-bg-main">Main <strong>Categories</strong></h5>
                        <div class="card-body rbt-text-main">
                            <span>{{ getOrderSummary()->pending }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header">Sub <strong>Categories</strong></h5>
                        <div class="card-body">
                            <span>{!! getOrderSummary()->today !!}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header">Filtering <strong>Categories</strong></h5>
                        <div class="card-body">
                            <span>{!! getOrderSummary()->this_month !!}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header">Inactive <strong>Categories</strong></h5>
                        <div class="card-body">
                            <span>{!! getOrderSummary()->last_month !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($categoryId))
            <new-category category_id="{{ $categoryId }}"></new-category>
        @else
            <new-category></new-category>
        @endif
    </div>
@endsection

@section('custom-script')

@endsection
