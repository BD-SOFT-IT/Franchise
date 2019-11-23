@extends('layouts.admin')

@section('sub-title', 'Products')
@section('page-description', 'View All Products')

@section('products-active', 'active')
@section('products-all-active', 'active')

@section('admin-content')
    <div class="admin-products">
        {{-- Heaader Summary --}}
        @if(!auth('admin')->user()->isFranchise())
            <div class="admin-content-header-summary">
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card text-center">
                            <h5 class="card-header rbt-bg-main"><strong>Featured</strong> Products</h5>
                            <div class="card-body rbt-text-main">
                                <span>{{ $summary->featured }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card text-center">
                            <h5 class="card-header"><strong>Out of</strong> Stock</h5>
                            <div class="card-body">
                                <span>{{ $summary->out_of_stock }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card text-center">
                            <h5 class="card-header"><strong>Inactive</strong> Products</h5>
                            <div class="card-body">
                                <span>{{ $summary->inactive }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card text-center">
                            <h5 class="card-header"><strong>Total</strong> Products</h5>
                            <div class="card-body">
                                <span>{{ $summary->total }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Single Product --}}
        <div class="view-product">
            @if(isset($notFound))
                <div class="alert alert-danger not-found" role="alert">
                <span class="alert-icon">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </span>
                    <br>
                    {{ $notFound }}
                </div>
            @else
                <div class="card">
                    <div class="card-header">
                        <strong><i class="fa fa-eye"></i> Product</strong> View
                        @if(!auth('admin')->user()->isFranchise())
                            <a href="{{ route('admin.products.edit', ['id' => $product->product_id]) }}" title="Edit this Product" class="pull-right">
                                <i class="fa fa-pencil"></i>
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="product-image text-center">
                            @if($product->product_img_main == null || $product->product_img_main == '')
                                <img style="max-height: 250px; margin-bottom: 25px;" src="{{ asset('assets/images/icon_bw.png') }}" alt="{{ $product->product_title . ' ' . $product->product_title_bengali }}">
                            @else
                                <img style="max-height: 250px; margin-bottom: 25px;" src="{{ imageCache($product->product_img_main) }}" alt="{{ $product->product_title . ' ' . $product->product_title_bengali }}">
                            @endif
                        </div>
                        <div class="product-details">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Title</th>
                                        <td class="align-middle"><strong>{{ $product->product_title }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Title <span class="adorsho-lipi-12">(বাংলা)</span></th>
                                        <td class="align-middle adorsho-lipi-12">{{ $product->product_title_bengali }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Vendor (Brand)</th>
                                        <td class="align-middle">{{ ($product->brand) ? $product->brand->pb_name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Vendor SKU</th>
                                        <td class="align-middle">{{ $product->product_vendor_sku }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Categories</th>
                                        <td class="align-middle">
                                            {{ $categories }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Per Unit</th>
                                        <td class="align-middle">{{ $product->product_unit_quantity . ' ' . $product->product_unit_name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Cost <small>(Per Unit)</small></th>
                                        <td class="align-middle"><i class="sbicon sbicon-bdt" style="margin-right: 3px;"></i>
                                            @if(auth('admin')->user()->isFranchise())
                                                {{ $product->product_unit_mrp_franchise }}
                                            @else
                                                {{ $product->product_unit_cost }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">MRP <small>(Per Unit)</small></th>
                                        <td class="align-middle"><i class="sbicon sbicon-bdt" style="margin-right: 3px;"></i>{{ $product->product_unit_mrp }}</td>
                                    </tr>
                                    @if(!auth('admin')->user()->isFranchise())
                                        <tr>
                                            <th class="align-middle" scope="row" style="width: 160px;">Franchise MRP <small>(Per Unit)</small></th>
                                            <td class="align-middle"><i class="sbicon sbicon-bdt" style="margin-right: 3px;"></i>{{ $product->product_unit_mrp_franchise }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Available Sizes</th>
                                        <td class="align-middle">
                                            @if($sizes = $product->product_available_sizes)
                                                @for($i = 0; $i < count($sizes); $i++)
                                                    {{ ($i >= count($sizes) - 1) ? $sizes[$i] : $sizes[$i] . ', ' }}
                                                @endfor
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Available Colors</th>
                                        <td class="align-middle">
                                            @if($colors = $product->product_available_colors)
                                                @for($i = 0; $i < count($colors); $i++)
                                                    {{ ($i >= count($colors) - 1) ? $colors[$i] : $colors[$i] . ', ' }}
                                                @endfor
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Discount</th>
                                        <td class="align-middle">
                                            @if($product->product_discounted)
                                                @if($product->product_discount_amount)
                                                    <i class="sbicon sbicon-bdt" style="margin-right: 3px;"></i> {{ ($product->product_discount_amount) }}
                                                @else
                                                    {{ ($product->product_discount_percentage) }} %
                                                @endif
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Units in Stock</th>
                                        @if(auth('admin')->user()->isFranchise())
                                            <td class="align-middle">{{ $product->franchiseStock() }}</td>
                                        @else
                                            <td class="align-middle">{{ $product->product_units_in_stock }}</td>
                                        @endif
                                    </tr>
                                    {{--<tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Rank</th>
                                        <td class="align-middle">{{ $product->product_rank }}</td>
                                    </tr>--}}
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Availability Status</th>
                                        <td class="align-middle">{{ $product->product_availability_status }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Replacement Available</th>
                                        <td class="align-middle">{{ ($product->product_replacement_available == 1) ? 'Available' : 'Not Available' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Guarantee Status</th>
                                        <td class="align-middle">{{ $product->product_guarantee_time . ' - ' . $product->product_guarantee_status }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Status</th>
                                        <td class="align-middle">{{ ($product->product_active == 1) ? 'Active' : 'Not Active' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Featured ?</th>
                                        <td class="align-middle">{{ ($product->product_featured == 1) ? 'Featured' : 'Not Featured' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Offered ?</th>
                                        <td class="align-middle">{{ ($product->product_offered == 1) ? 'Offered' : 'Not Offered' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Available Outside ?</th>
                                        <td class="align-middle">{{ ($product->product_available_outside == 1) ? 'Available' : 'Not Available' }}</td>
                                    </tr>
                                @if(auth('admin')->user()->isAdmin() || auth('admin')->user()->isSuperAdmin())
                                    <tr>
                                        <th class="align-middle" scope="row" style="width: 160px;">Total Units Sold</th>
                                        <td class="align-middle">{{ $product->product_total_unit_sold }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if($product->product_logs != null && (auth('admin')->user()->isAdmin() || auth('admin')->user()->isSuperAdmin()))
                    <div class="card">
                        <div class="card-header">
                            <strong><i class="fa fa-history"></i> Product</strong> Log
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Time</th>
                                        <th scope="col">Admin</th>
                                        <th scope="col">Old Cost</th>
                                        <th scope="col">New Cost</th>
                                        <th scope="col">Old MRP</th>
                                        <th scope="col">New MRP</th>
                                        <th scope="col">Old Stock</th>
                                        <th scope="col">New Stock</th>
                                        <th scope="col">Log Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logs = convertStringToArray($product->product_logs, true) as $log)
                                            <tr>
                                                <td>{{ $log['time'] }}</td>
                                                <td>{{ $log['author_name'] }}</td>
                                                <td>{{ $log['old_cost'] }}</td>
                                                <td>{{ $log['new_cost'] }}</td>
                                                <td>{{ $log['old_mrp'] }}</td>
                                                <td>{{ $log['new_mrp'] }}</td>
                                                <td>{{ $log['old_stock'] }}</td>
                                                <td>{{ $log['new_stock'] }}</td>
                                                <td>{{ $log['type'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>

    </div>
@endsection
