@extends('seller.layouts.seller_dashboard_master')

@section('addNewProduct-title')
    New Product
@endsection

@section('addNewProduct')
    <div class="content-wrapper" >
        <form action="{{ route('seller.addNewProduct') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-7">
                        <!-- Product Information Card started From here -->

                        <div class="card">
                            <div class="card-header do-custom-header" style="background-color: #00796b; color: #ffeeee">
                                <h6 class="text-center text-uppercase">Product Information</h6>
                            </div>
                            <div class="card-body" style="background-color: #e0e0e0">
                                <div class="form-row mb-3">

                                    <!-- Product Name Section -->
                                    <div class="col">
                                        <input type="hidden" name="seller_id" value="">
                                        <small id="smallProductName" class="form-text text-dark mb-1">Product Name
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_name" class="form-control form-control-sm"
                                               id="productName"
                                               aria-describedby="smallProductName" placeholder="Product Name">
                                    </div>

                                    <!-- Brand Name Section started from here -->
                                    <div class="col">
                                        <small id="smallProductBrand" class="form-text text-dark mb-1">Brand Name
                                            <span class="text-danger">*</span></small>
                                        <select name="product_brand" class="form-control form-control-sm"
                                                id="productBrand"
                                                aria-describedby="smallProductBrand">
                                            @foreach($productBrands as $productBrand)
                                                <option value="{{ $productBrand->pb_id }}">{{ $productBrand->pb_name.' '.'( '. $productBrand->pb_name_bengali .' )'}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="form-row mb-3">
                                    <!-- Category Name Section Started from here -->
                                    <div class="col">
                                        <small id="smallProductCategory" class="form-text text-dark mb-1">Categories
                                            <span class="text-danger">*</span></small>
                                        <select name="product_category" class="form-control form-control-sm"
                                                id="productCategory"
                                                aria-describedby="smallProductCategory" onblur="setProductCode()">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->category_title.' '.'( '.$category->category_title_bangla.' )' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <!-- Product auto code Section Started from here -->
                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Product Code
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_code" class="form-control form-control-sm" id="productCode"
                                               aria-describedby="emailHelp" placeholder="Auto generate product code"
                                               readonly>
                                    </div>
                                </div>

                                <div class="form-row do-border mb-4">
                                    <!-- Per Unit Cost Input Started From here -->
                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Per Unit Cost
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_unit_cost" class="form-control form-control-sm"
                                               aria-describedby="emailHelp" placeholder="Unit Cost">
                                    </div>

                                    <!-- Unit MRP Input Started From here -->
                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Unit MRP
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_unit_mrp" class="form-control form-control-sm"
                                               aria-describedby="emailHelp" placeholder="Unit MRP">
                                    </div>

                                    <!-- Units in Stock Input Started From Here-->
                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Units in Stock
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_unit_stock" class="form-control form-control-sm"
                                               aria-describedby="emailHelp" placeholder="Units in Stock">
                                    </div>
                                </div>

                                <!-- Product Description Started From Here -->
                                <div class="form-row mb-3 do-border">
                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Product Description
                                            <span class="text-danger">*</span></small>
                                        <textarea name="product_description" class="" id="productDescription"
                                                  placeholder="Enter text .
                                        ..">

                                        </textarea>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Column 7 Section end -->

                    <div class="col-lg-5">

                        <!-- Product Options Section Started From here -->
                        <div class="card">
                            <div class="card-header do-custom-header" style="background-color: #00796b; color: #ffeeee">
                                <h6 class="text-center text-uppercase">Product Options</h6>
                            </div>
                            <div class="card-body" style="background-color: #e0e0e0">
                                <div class="form-row mb-4">

                                    <!-- Product Per Unit Section Started -->
                                    <div class="col-4">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Product unit
                                            <span class="text-danger">*</span></small>
                                        <input type="text" name="product_unit[]" class="form-control form-control-sm"
                                               aria-describedby="emailHelp" placeholder="Product unit">
                                    </div>

                                    <!-- Unit Measurement Input sectin started-->
                                    <div class="col">
                                        <small id="emailHelp" class="form-text text-dark mb-1">Unit Measurement
                                            <span class="text-danger">*</span></small>
                                        <select name="product_unit[]" class="form-control form-control-sm" id="emailHelp"
                                                aria-describedby="emailHelp">
                                            <option selected>-- Select your unit measurement --</option>
                                            <option value="Kilogram">Kilogram (কেজি)</option>
                                            <option value="Dozen">Dozen (ডজন)</option>
                                            <option value="Halli">Halli (হালি)</option>
                                            <option value="Litter">Litter (লিটার)</option>
                                        </select>
                                    </div>

                                </div>

                                <!-- Availability Status Started from here -->
                                <div class="col mb-4">
                                    <small id="emailHelp" class="form-text text-dark mb-1">Availability Status
                                        <span class="text-danger">*</span></small>
                                    <select name="product_availability" class="form-control form-control-sm"
                                            id="emailHelp"
                                            aria-describedby="emailHelp">
                                        <option selected>-- Availability Status --</option>
                                        <option value="In Stock">In Stock</option>
                                        <option value="Out Stock">Out Of Stock</option>
                                        <option value="Pre Book">Pre Book</option>
                                    </select>
                                </div>

                                <!-- Features Product Checkbox started here-->
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productFeature"
                                               name="product_feature">
                                        <label class="custom-control-label" for="productFeature">Do you want take your product into feature?</label>
                                    </div>
                                </div>

                                <!-- Product Color Input section started from here -->
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productColor" data-toggle='collapse' data-target='#productColor'>
                                        <label class="custom-control-label" for="productColor">Do you have different product color?</label>
                                    </div>
                                </div>
                                <div class="col collapse" id="productColor">
                                    <small id="emailHelp" class="form-text text-dark mb-1">Put your product color.
                                        <span class="text-danger">*</span></small>
                                    <input type="text" name="product_color" class="form-control form-control-sm"
                                           aria-describedby="emailHelp" placeholder="Define yor product color.">
                                </div>

                                <!-- Product Size Section Started From here -->
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productSize" data-toggle='collapse' data-target='#productSize'>
                                        <label class="custom-control-label" for="productSize">Do you have different product size?</label>
                                    </div>
                                </div>
                                <div class="col collapse" id="productSize">
                                    <small id="emailHelp" class="form-text text-dark mb-1">Put your product size.
                                        <span class="text-danger">*</span></small>
                                    <input type="text" name="product_size" class="form-control form-control-sm"
                                           aria-describedby="emailHelp" placeholder="Define yor product size.">
                                </div>

                                <!-- Product Discount section stared from here -->
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productDiscount" data-toggle='collapse' data-target='#productDiscount'>
                                        <label class="custom-control-label" for="productDiscount">Do you give your product on discount?</label>
                                    </div>
                                </div>
                                <div class="col collapse" id="productDiscount">
                                    <small id="emailHelp" class="form-text text-dark mb-1">Put your product discount %.
                                        <span class="text-danger">*</span></small>
                                    <input type="text" name="product_discount" class="form-control form-control-sm"
                                           aria-describedby="emailHelp" placeholder="Define yor product discount %.">
                                </div>

                            </div>
                        </div>
                        <!-- End Product Options Card  -->


                        <!-- Product Options Images section started  -->
                        <div class="card">
                            <div class="card-header do-custom-header" style="background-color: #00796b; color: #ffeeee">
                                <h6 class="text-center text-uppercase"> Product images</h6>
                            </div>
                            <div class="card-body" style="background-color: #e0e0e0">
                                <div class="box">
                                    <input type="file" name="product_images[]" id="file-1" class="inputfile inputfile-1"
                                           data-multiple-caption="{count} files selected" multiple style="display: none"/>
                                    <label for="file-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="13"
                                             viewBox="0 0 20 17">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </svg>
                                        <span>Choose one Image or Multiple Images</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <input type="submit" name="newProductButton" class="btn" style="background-color:
                                #00796b; padding: 8px 21px; color: #e0e0e0; font-size: 17px"
                                       value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            function setProductCode() {

                var getProductName = document.getElementById('productName').value;
                var getBrandName = document.getElementById('productBrand').value;
                var getCategoryName = document.getElementById('productCategory').value;

                var slicedProductName = getProductName.slice(0,4);
                var finalProductName = slicedProductName.toUpperCase();
                document.getElementById('productCode').value = finalProductName +'-'+getBrandName+'-'+getCategoryName;



                // var productName = $('#productName').val();
                // var productCategory  = $('#productCategory').val();
                // var productBrand     = $('#productBrand').val();
                //         var slicedProductCategory = categoryName.slice(0,3);
                //         var finalProductCategory = slicedProductCategory.toUpperCase();
                //         var slicedProductBrand = brandName.slice(0,3);
                //         var finalProductBrand = slicedProductBrand.toUpperCase();
                //         var finalProductName = productName.slice(0,3).toUpperCase();
                //         var result = finalProductName+'-'+finalProductBrand+'-'+finalProductCategory+'-';
                //         $('#productCode').val(result);
                    }
        </script>
    </div>

@endsection

