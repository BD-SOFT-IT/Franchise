@extends('layouts.admin')

@section('sub-title', 'Site Options')
@section('page-description', 'Set Site Options')

@section('site-information-active', 'active')
@section('site-details-active', 'active')



@section('admin-content')
    <div class="all-admins-container">
        <div class="card new-admin">
            <div class="card-header">
                <strong><i class="fa fa-info-circle"></i> Shop</strong> Information
            </div>
            <div class="card-body">
                <form action="{{ route('shop_info.save') }}" method="POST">
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
                        <label for="site_email" class="col-sm-2 col-form-label">Shop Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control {{ $errors->has('site_email') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('site_email') }}"
                                   id="site_email" name="site_email" placeholder="Shop Email Address">
                            @if ($errors->has('site_email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('site_email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="site_mobile" class="col-sm-2 col-form-label">Shop Mobile</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+880</span>
                                </div>
                                <input type="tel" class="form-control {{ $errors->has('site_mobile') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('site_mobile') }}"
                                       id="site_mobile" name="site_mobile" placeholder="Shop Mobile Number" required>
                                @if ($errors->has('site_mobile'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('site_mobile') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="site_description" class="col-sm-2 col-form-label">Shop Description</label>
                        <div class="col-sm-10">
                            <textarea id="site_description" rows="5" name="site_description" class="form-control {{ $errors->has('site_description') ? 'is-invalid' : '' }}" >{!! getSiteBasic('site_description') !!}</textarea>
                            @if ($errors->has('site_description'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('site_description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="site_address" class="col-sm-2 col-form-label">Shop Address</label>
                        <div class="col-sm-10">
                            <textarea id="site_address" rows="3" name="site_address" class="form-control {{ $errors->has('site_address') ? 'is-invalid' : '' }}" >{!! getSiteBasic('site_address') !!}</textarea>
                            @if ($errors->has('site_address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('site_address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="map_address" class="col-sm-2 col-form-label">Google Map Address</label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control {{ $errors->has('map_address') ? 'is-invalid' : '' }}" value="{{  urldecode(getSiteBasic('map_address')) }}"
                                   id="map_address" name="map_address" placeholder="Google Map Address Link">
                            @if ($errors->has('map_address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('map_address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="site_keywords" class="col-sm-2 col-form-label">Shop Keywords</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('site_keywords') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('site_keywords') }}"
                                   id="site_keywords" name="site_keywords" placeholder="Shop Keywords">
                            @if ($errors->has('site_keywords'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('site_keywords') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="site_logo" class="col-sm-2 col-form-label">Shop Logo</label>
                        <div class="col-sm-10">
                            <div id="rmmUpload">
                                @if(getSiteBasic('site_logo'))
                                    <img src="{{ url('uploads/public/cache/original/' . getSiteBasic('site_logo')) }}" alt="{{ getSiteBasic('site_title') }}" style="max-height: 250px; max-width: 300px;">
                                @else
                                    <img src="{{ asset('assets/images/icon_bw.png') }}" alt="" style="max-height: 250px; max-width: 300px;">
                                @endif
                                <input type="hidden" id="site_logo" name="site_logo" value="">
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
