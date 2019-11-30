@extends('seller.layouts.seller_dashboard_master')
@section('allApprovedProducts-title')
    All Approved Products
    @endsection
@section('allApprovedProducts')
    <div class="content-wrapper px-1">

        {{-- Products approved page breadcrums section --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2" style="background-color: #00796b; color: #ffeeee">
                    <div class="card-header do-custom-header offset-4">
                        <h1 class="text-center text-uppercase" >Approved Products List</h1>
                    </div>
                </div>
            </div>
        </div>
        @if(session()->has('message'))
            <div class="text-center alert alert-{{session('type')}}">
                <h5>{{ session('message') }}</h5>
            </div>
        @endif

        @if(session()->has('productDeleteMessage'))
            <div class="alert alert-danger">
                <h5>{{ Session::get('productDeleteMessage') }}</h5>
            </div>
        @endif

        {{-- All Approved product Showing section started --}}

        <div class="row">
            <div class="col-md-12">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="table-responsive" style="background-color: #e0e0e0">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Product Code</th>
                                        <th scope="col">Product Title</th>
                                        <th scope="col">P.U.C.</th>
                                        <th scope="col">MRP</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Availability</th>
                                        <th scope="col">Images</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($sellerProducts as $index => $sellerProduct)
                                        <tr>
                                            <td width="40">{{$index+1}}</td>
                                            <td width="100">{{$sellerProduct->product_code}}</td>
                                            <td  width="130">
                                                <a href="{{ route('seller.previewProduct', ['preview_product_id' => $sellerProduct->product_id]) }}">
                                                    {{$sellerProduct->product_name}}
                                                </a>
                                            </td>
                                            <td width="60">{{$sellerProduct->product_unit_cost}}</td>
                                            <td width="60">{{$sellerProduct->product_unit_mrp}}</td>
                                            <td width="60">{{$sellerProduct->product_unit_stock}}</td>
                                            <td width="60">{{ $sellerProduct->product_availability }}</td>
                                            @php
                                                $sellerProductImages = \App\SellerProductImages::where('product_id', $sellerProduct->product_id)->get();
                                            @endphp
                                            <td width="144">
                                                @foreach($sellerProductImages as $image)
                                                    <img src="{{ asset($image->images_path) }}" width=34 height="21">
                                                @endforeach
                                            </td>
                                            <td width="130">
                                                <a href="{{ route('seller.previewProduct', ['preview_product_id' => $sellerProduct->product_id]) }}" class="btn btn-success btn-sm"
                                                ><i class="fa fa-eye"></i></a>

                                                <a href="{{ route('seller.editProduct',['edit_product_id' => $sellerProduct->product_id]) }}" class="btn btn-warning btn-sm"
                                                   onclick="return confirm('Really! Do you want to Update Product details?')"><i class="fa fa-pen"></i></a>

                                                <a href="{{ route('seller.deleteProduct',['product_id' => $sellerProduct->product_id ]) }}" class="btn btn-danger btn-sm"
                                                   onclick=" return confirm('Are you sure to delete this item?')"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


