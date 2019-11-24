@extends('seller.layouts.seller_dashboard_master')

@section('addNewProduct-title')
    New Product
    @endsection

@section('addNewProduct')
    <div class="content-wrapper">
        <form action="{{ route('seller.addNewProduct') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header bg-gradient-green do-custom-header">
                                <h6 class="text-center">Product Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row mb-3">
                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Product Name
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_title" class="form-control"
                                               aria-describedby="emailHelp" placeholder="Product Name">
                                    </div>

                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Brand Name
                                            <span class="text-danger">*</span></small>
                                        <select name="product_brand" class="form-control" id="emailHelp" aria-describedby="emailHelp">
                                            @foreach($productBrands as $productBrand)
                                                <option value="{{ $productBrand->pb_id }}">{{ $productBrand->pb_name.' '.'( '. $productBrand->pb_name_bengali .' )'}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Categories
                                            <span class="text-danger">*</span></small>
                                        <select name="product_category" class="form-control" id="emailHelp" aria-describedby="emailHelp">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->category_title.' '.'( '.$category->category_title_bangla.' )' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row do-border mb-4">
                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Unit Cost
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_unit_cost" class="form-control"
                                               aria-describedby="emailHelp" placeholder="Unit Cost">
                                    </div>

                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Unit MRP
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_unit_mrp" class="form-control"
                                               aria-describedby="emailHelp" placeholder="Unit MRP">
                                    </div>

                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Units in Stock
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_unit_stock" class="form-control"
                                               aria-describedby="emailHelp" placeholder="Units in Stock">
                                    </div>
                                </div>

{{--                                <div class="form-row mb-3 do-border">--}}
{{--                                    <div class="col">--}}
{{--                                        <small id="emailHelp" class="form-text text-dark mb-1">Product Description--}}
{{--                                            <span class="text-danger">*</span></small>--}}
{{--                                        <div id="toolbar" aria-describedby="emailHelp">--}}

{{--                                        </div>--}}

{{--                                        <!-- Create the editor container -->--}}
{{--                                        <textarea id="productDescription" name="product_description" placeholder="Enter your product description">--}}
{{--                                        </textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-group">
                                    <textarea name="mailEditor" id="txtEditor"></textarea>
                                </div>

                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header bg-gradient-gray do-custom-header">
                                <h6 class="text-center">Product Options</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row mb-4">
                                    <div class="col-7">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Product unit
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_unit[]" class="form-control"
                                               aria-describedby="emailHelp" placeholder="Product unit">
                                    </div>
                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Brand Name
                                            <span class="text-danger">*</span></small>
                                        <select name="product_unit[]" class="form-control" id="emailHelp" aria-describedby="emailHelp">
                                            <option>Kilogram</option>
                                            <option>Dorggon</option>
                                            <option>Liter</option>
                                            <option>Book</option>
                                            <option>Sold</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <small id="emailHelp" class="form-text text-dark mb-1">Availability Status
                                        <span class="text-danger">*</span></small>
                                    <select name="product_category" class="form-control" id="emailHelp" aria-describedby="emailHelp">

                                    </select>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productFeature" name="product_feature">
                                        <label class="custom-control-label" for="productFeature">Do you want take your product into feature?</label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productColor" data-toggle='collapse' data-target='#productColor'>
                                        <label class="custom-control-label" for="productColor">Do you have different product color?</label>
                                    </div>
                                </div>
                                <div class="col collapse" id="productColor">
                                    <small id="emailHelp" class="form-text text-dark mb-1">Put your product color.
                                        <span class="text-danger">*</span></small>
                                    <input type="text" name="product_color" class="form-control"
                                           aria-describedby="emailHelp" placeholder="Define yor product color.">
                                </div>

                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productSize" data-toggle='collapse' data-target='#productSize'>
                                        <label class="custom-control-label" for="productSize">Do you have different product size?</label>
                                    </div>
                                </div>
                                <div class="col collapse" id="productSize">
                                    <small id="emailHelp" class="form-text text-dark mb-1">Put your product size.
                                        <span class="text-danger">*</span></small>
                                    <input type="text" name="product_size" class="form-control"
                                           aria-describedby="emailHelp" placeholder="Define yor product size.">
                                </div>

                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productDiscount" data-toggle='collapse' data-target='#productDiscount'>
                                        <label class="custom-control-label" for="productDiscount">Do you give your product on discount?</label>
                                    </div>
                                </div>
                                <div class="col collapse" id="productDiscount">
                                    <small id="emailHelp" class="form-text text-dark mb-1">Put your product discount %.
                                        <span class="text-danger">*</span></small>
                                    <input type="text" name="product_discount" class="form-control"
                                           aria-describedby="emailHelp" placeholder="Define yor product discount %.">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-gradient-gray do-custom-header">
                                <h6 class="text-center"> Product images</h6>
                            </div>
                            <div class="card-body">
{{--                                <input class="productImage" type="file" name="product_image_path[]" multiple>--}}
                                <div class="box">
                                    <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                                    <label for="file-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="13"
                                             viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.
                                             3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.
                                             1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.
                                             9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>
                                        <span>Choose a file&hellip;</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <input type="submit" name="newProductButton" class="btn btn-success" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


<script>
    $(document).ready(function() {
        $('textarea').summernote({
            height: 300,   //set editable area's height
        });
    });
</script>
