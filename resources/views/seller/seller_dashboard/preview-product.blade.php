@extends('seller.layouts.seller_dashboard_master')

@section('productPreview-title')
    Product Preview
@endsection

@section('productPreview')
<div class="content-wrapper">
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">
                        </h3>
                        @foreach($sellerProductImages as $image)
                            <img src="{{ asset($image->images_path) }}" alt="" srcset="" height="200"
                                 width="300">
                        @endforeach
                        <div class="col-12 product-image-thumbs"></div>

                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">
                            {{ $sellerProduct->product_name }}
                        </h3>

                        <hr>
                        <h4>Available Colors</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center active">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                                {{ $sellerProduct->product_color }}
                                <br>
                                <i class="fas fa-circle fa-2x text-red"></i>
                            </label>
                        </div>

                        <h4 class="mt-3">Product Size</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                <span class="text-xl">{{ $sellerProduct->product_size }}</span>
                                <br>
                            </label>
                        </div>



                        <h4 class="mt-3">Product Availability</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                <span class="text-xl">{{ $sellerProduct->product_availability }}</span>
                                <br>
                            </label>
                        </div>

                        <h4 class="mt-3">Product Feature</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                <span class="text-xl">{{ $sellerProduct->product_feature }}</span>
                                <br>
                            </label>
                        </div>

                        <h4 class="mt-3">Product Brand</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                <span class="text-xl"></span>
                                <br>
                            </label>
                        </div>

                        <h4 class="mt-3">Product Category</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                <span class="text-xl"></span>
                                <br>
                            </label>
                        </div>


                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                Per Unit Cost: {{ $sellerProduct->product_unit_cost }}
                            </h2>
                            <h4 class="mt-0">
                                <small>Product MRP: {{ $sellerProduct->product_unit_mrp }}</small>
                            </h4>
                            <h4 class="mt-0">
                                <small>Product Discount: {{ $sellerProduct->product_discount }}</small>
                            </h4>
                        </div>

                    </div>
                </div>
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> {{ $sellerProduct->product_description }} </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
</div>
@endsection
