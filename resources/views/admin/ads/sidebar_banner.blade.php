@extends('layouts.admin')

@section('sub-title', 'Edit Sidebar Banner')
@section('page-description', 'Edit Sidebar Banner')

@section('ads-active', 'active')
@section('ads-sidebar-active', 'active')

@section('admin-content')
    <div class="admin-ads">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-file-image-o"></i> Sidebar</strong> Banner
            </div>

            <div class="card-body">
                <form action="{{ route('admin.ads.sidebar_banner') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div id="rmmUpload">
                                @if($banner->banner_img)
                                    <img src="{{ imageCache($banner->banner_img) }}" alt="{{ getSiteBasic('site_title') }}" style="max-height: 500px; max-width: 350px; margin: 0 auto;">
                                @else
                                    <img src="https://via.placeholder.com/350x500?text=Promotional+Image(350x500)" alt="" style="max-height: 500px; max-width: 350px; margin: 0 auto;">
                                @endif
                                <input type="hidden" id="site_logo" name="sidebar_banner" value="">
                            </div>

                            <button type="button" class="btn btn-light btn-outline-warning mt-3" data-toggle="modal" data-target="#rbtMediaManager">
                                <i class="fa fa-retweet"></i> Change
                            </button>
                            <button type="submit" class="btn btn-light btn-outline-success mt-3">
                                <i class="fa fa-floppy-o"></i> Save
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <rbt-media-manager directory="banners" :user_id="$root.admin.id" url_prefix="/bs-mm-api" show_as="modal" element_id="rmmUpload"></rbt-media-manager>
@endsection

@section('custom-script')

@endsection
