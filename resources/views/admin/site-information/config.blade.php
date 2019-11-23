@extends('layouts.admin')

@section('sub-title', 'Site Config')
@section('page-description', 'Set Site Configuration')

@section('site-information-active', 'active')
@section('site-config-active', 'active')

@section('admin-content')
    <div class="all-admins-container">
        <div class="card new-admin">
            <div class="card-header">
                <strong><i class="fa fa-info-circle"></i> Shop</strong> Config
            </div>
            <div class="card-body">
                <form action="{{ route('shop_info.config.save') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">Shop Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('site_title') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('site_title') }}"
                                   id="site_title" name="site_title" placeholder="Shop Name" required autofocus>
                            @if ($errors->has('site_title'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('site_title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="default_product_image" class="col-sm-2 col-form-label">Default Product Image</label>
                        <div class="col-sm-10">
                            <div id="rmmUpload">
                                @if($product = getSiteBasic('default_product_image'))
                                    <img src="{{ url('uploads/public/cache/original/' . $product) }}" alt="" style="max-height: 250px; max-width: 300px;">
                                @else
                                    <img src="{{ asset('assets/images/icon_bw.png') }}" alt="" style="max-height: 250px; max-width: 300px;">
                                @endif
                                <input type="hidden" id="default_product_image" name="default_product_image" value="">
                            </div>
                            <button type="button" class="btn btn-warning mt-3" data-toggle="modal" data-target="#rbtMediaManager">
                                Change Logo
                            </button>
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </div>
                    <rbt-media-manager directory="main" :user_id="$root.admin.id" url_prefix="/bs-mm-api" show_as="modal" element_id="rmmUpload"></rbt-media-manager>

                </form>
            </div>
        </div>
    </div>
@endsection
