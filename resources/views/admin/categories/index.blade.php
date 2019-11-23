@extends('layouts.admin')

@section('sub-title', 'All Categories')
@section('page-description', 'View All Categories')

@section('categories-active', 'active')
@section('categories-all-active', 'active')

@section('header-action')
    <ul class="nav justify-content-end">
        <li class="nav-item text-center">
            <a class="nav-link btn btn-light" href="{{ route('admin.categories.create') }}">
                <i class="fa fa-plus"></i>
                <span class="d-none d-sm-block">New Category</span>
            </a>
        </li>
    </ul>
@endsection

@section('admin-content')
    <div class="admin-categories">
        <div class="admin-content-header-summary">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header rbt-bg-main">Main <strong>Categories</strong></h5>
                        <div class="card-body rbt-text-main">
                            <span>{{ $summary->main }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header">Sub <strong>Categories</strong></h5>
                        <div class="card-body">
                            <span>{{ $summary->sub }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header">Filtering <strong>Categories</strong></h5>
                        <div class="card-body">
                            <span>{{ $summary->filtering }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card text-center">
                        <h5 class="card-header">Inactive <strong>Categories</strong></h5>
                        <div class="card-body">
                            <span>{{ $summary->inactive }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="all-categories">
            <div class="card">
                <div class="card-header">
                    <strong>All</strong> Categories
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionCategories">
                        <ul class="list-group">
                            @for($i = 0; $i < count($parents); $i++)
                                <div class="card">
                                    <div class="card-header" id="heading{{ $i }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link {{ ($i > 0) ? 'collapsed' : '' }}" style="color: #394263;" type="button" data-toggle="collapse" data-target="#collapse{{ $i }}" aria-expanded="true" aria-controls="collapse{{ $i }}">
                                                <strong>{{ $parents[$i]->category_title }}</strong>
                                            </button>
                                            <span>
                                                <a href="{{ route('admin.categories.edit', ['id' => $parents[$i]->category_id]) }}">
                                                    <i class="fa fa-pencil" style="margin-left: 5px;"></i>
                                                </a>
                                            </span>
                                        </h5>
                                    </div>

                                    <div id="collapse{{ $i }}" class="collapse {{ ($i == 0) ? 'show' : '' }}" aria-labelledby="heading{{ $i }}" data-parent="#accordionCategories">
                                        <div class="card-body">
                                            <ul class="list-group">
                                                @foreach($children as $child)
                                                    @if($child->category_parent_id == $parents[$i]->category_id)
                                                        <li class="list-group-item">
                                                            {{ $child->category_title }}
                                                            <span>
                                                                <a href="{{ route('admin.categories.edit', ['id' => $child->category_id]) }}">
                                                                    <i class="fa fa-pencil" style="margin-left: 5px;"></i>
                                                                </a>
                                                            </span>
                                                            <ul>
                                                                @foreach($filterings as $filtering)
                                                                    @if($filtering->category_parent_id == $child->category_id)
                                                                        <li>
                                                                            {{ $filtering->category_title }}
                                                                            <span>
                                                                                <a href="{{ route('admin.categories.edit', ['id' => $filtering->category_id]) }}">
                                                                                    <i class="fa fa-pencil" style="margin-left: 5px;"></i>
                                                                                </a>
                                                                            </span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </ul>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('custom-script')

@endsection
