@extends('seller.layouts.seller_dashboard_master')

@section('editProduct-title')
    Edit Product
@endsection

@section('editProduct')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="m-b-0 text-white">Add New Product</h4>
                    </div>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('seller.updateProduct')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="product_title" class="form-control"
                                                   value="{{ $product->product_title }}" placeholder="Product Title">
                                            <input type="hidden" name="product_id" class="form-control"
                                                   value="{{ $product->product_id }}">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="product_vendor_name" class="form-control"
                                                   value="{{ $product->product_vendor_name }}" placeholder="Vendor Name">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <input type="text" name="product_unit" class="form-control"
                                                   value="{{ $product->product_unit }}"placeholder="Product Unit ">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="product_unit_cost" class="form-control"
                                                   value="{{ $product->product_unit_cost}}" placeholder="Unit Cost">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="product_unit_mrp" class="form-control"
                                                   value="{{ $product->product_unit_mrp}}" placeholder="Unit MRP">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <textarea class="form-control" name="product_description"  cols="10" rows="5"
                                                      value="{{ $product->product_description}}" placeholder="Enter Your Product Details Description">
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <input type="text" name="product_category" class="form-control"
                                                   value="{{ $product->product_category}}" placeholder="Category">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="product_sub_category" class="form-control"
                                                   value="{{ $product->product_sub_category}}" placeholder="Sub Category">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <input type="text" name="product_unit_stock" class="form-control"
                                                   value="{{ $product->product_unit_stock}}" placeholder="Total Unit Stocked">
                                        </div>
                                        <div class="col custom-control custom-switch">
                                            <input type="checkbox" name="product_unit_availability" class="custom-control-input" id="availabilityStatus" value="yes">
                                            <label class="custom-control-label" for="availabilityStatus">Availability Status</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="row">

                                        <div class="input-group control-group increment" >
                                            <input type="file" name="product_image_path" class="form-control">

                                        </div>
                                        {{--                                        <div class="clone hide">--}}
                                        {{--                                            <div class="control-group input-group" style="margin-top:10px">--}}
                                        {{--                                                <input type="file" name="product_image_path" class="form-control">--}}
                                        {{--                                                <div class="input-group-btn">--}}
                                        {{--                                                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}

                                        <div class="col d-block mt-4">
                                            <input type="submit" class="btn btn-success form-control" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

