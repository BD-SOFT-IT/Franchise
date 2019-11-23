@extends('layouts.admin')

@section('sub-title', 'SEO Configurations')
@section('page-description', 'SEO Configurations')

@section('site-information-active', 'active')
@section('site-configuration-active', 'active')



@section('admin-content')
    <div class="all-admins-container">
        <div class="card new-admin">
            <div class="card-header">
                <strong><i class="fa fa-info-circle"></i> SEO</strong> Configurations
            </div>
            <div class="card-body">
                <form action="{{ route('shop_info.seo') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="google_seo" class="col-sm-3 col-form-label">Google Verification Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('google_seo') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('google_seo') }}"
                                   id="google_seo" name="google_seo" placeholder="Google Verification Code" autofocus>
                            @if ($errors->has('google_seo'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('google_seo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bing_seo" class="col-sm-3 col-form-label">Bing Verification Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('bing_seo') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('bing_seo') }}"
                                   id="bing_seo" name="bing_seo" placeholder="Bing Verification Code">
                            @if ($errors->has('bing_seo'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('bing_seo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="yandex_seo" class="col-sm-3 col-form-label">Yandex Verification Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('yandex_seo') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('yandex_seo') }}"
                                   id="yandex_seo" name="yandex_seo" placeholder="Yandex Verification Code">
                            @if ($errors->has('yandex_seo'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('yandex_seo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pinterest_seo" class="col-sm-3 col-form-label">Pinterest Verification Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('pinterest_seo') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('pinterest_seo') }}"
                                   id="pinterest_seo" name="pinterest_seo" placeholder="Pinterest Verification Code">
                            @if ($errors->has('pinterest_seo'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('pinterest_seo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-success" type="submit">Update SEO</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
