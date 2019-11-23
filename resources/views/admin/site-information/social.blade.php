@extends('layouts.admin')

@section('sub-title', 'Social Page Linking')
@section('page-description', 'Social Page Linking')

@section('site-information-active', 'active')
@section('site-social-active', 'active')



@section('admin-content')
    <div class="all-admins-container">
        <div class="card new-admin">
            <div class="card-header">
                <strong><i class="fa fa-superpowers"></i> Social</strong> Links
            </div>
            <div class="card-body">
                <form action="{{ route('shop_info.social') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="facebook_page" class="col-sm-3 col-form-label">Facebook Page</label>
                        <div class="col-sm-9">
                            <input type="url" class="form-control {{ $errors->has('facebook_page') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('facebook_page') }}"
                                   id="facebook_page" name="facebook_page" placeholder="Facebook Page URL" autofocus>
                            @if ($errors->has('facebook_page'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('facebook_page') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="youtube_channel" class="col-sm-3 col-form-label">Youtube Channel </label>
                        <div class="col-sm-9">
                            <input type="url" class="form-control {{ $errors->has('youtube_channel') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('youtube_channel') }}"
                                   id="youtube_channel" name="youtube_channel" placeholder="Youtube Channel URL">
                            @if ($errors->has('youtube_channel'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('youtube_channel') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="instagram_page" class="col-sm-3 col-form-label">Instagram Page</label>
                        <div class="col-sm-9">
                            <input type="url" class="form-control {{ $errors->has('instagram_page') ? 'is-invalid' : '' }}" value="{{ getSiteBasic('instagram_page') }}"
                                   id="instagram_page" name="instagram_page" placeholder="Instagram Page URL">
                            @if ($errors->has('instagram_page'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('instagram_page') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
