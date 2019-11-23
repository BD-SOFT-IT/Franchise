@extends('seller.layouts.seller_dashboard_master')
@section('allApprovedProducts-title')
    All Approved Products
    @endsection
@section('allApprovedProducts')
    <div class="content-wrapper px-1">

        {{-- Products approved page breadcrums section --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-success bold">Approved Products List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Approved Products</li>
                        </ol>
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

        <table class="table table-striped table-sm">
            <tr>
                <th scope="col">SL</th>
                <th scope="col">Title</th>
                <th scope="col">Vendor</th>
                <th scope="col">Category</th>
                <th scope="col">Unit Cost</th>
                <th scope="col">Unit MRP</th>
                <th scope="col">Stock</th>
                <th scope="col">Action</th>
            </tr>
            @php($i=1)
            @foreach($sellerProducts as $sellerProduct)
            <tr>
                <td scope="row">{{$i++}}</td>
                <td>{{$sellerProduct->product_title}}</td>
                <td>{{$sellerProduct->product_vendor_name}}</td>
                <td>{{$sellerProduct->product_category}}</td>
                <td>{{$sellerProduct->product_unit_cost}}</td>
                <td>{{$sellerProduct->product_unit_mrp}}</td>
                <td>{{$sellerProduct->product_unit_stock}}</td>
                <td>
                    <a href="{{ route('seller.previewProduct', ['preview_product_id' => $sellerProduct->product_id]) }}" class="btn btn-success btn-sm"
                       ><i class="fa fa-eye"></i></a>

                    <a href="{{ route('seller.editProduct',['edit_product_id' => $sellerProduct->product_id]) }}" class="btn btn-warning btn-sm"
                       onclick="return confirm('Really! Do you want to Update Product details?')"><i class="fa fa-pen"></i></a>

                    <a href="{{ route('seller.deleteProduct',['product_id' => $sellerProduct->product_id ]) }}" class="btn btn-danger btn-sm"
                       onclick=" return confirm('Are you sure to delete this item?')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
                @endforeach
        </table>


    </div>
    @endsection
