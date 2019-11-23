@extends('layouts.admin')

@section('sub-title', 'Media Manager')
@section('page-description', 'View All Medias')

@section('media-active', 'active')


@section('admin-content')
    <rbt-media-manager directory="main" user_id="{{ auth('admin')->id() }}" url_prefix="/bs-mm-api" show_as="page"></rbt-media-manager>
@endsection

@section('custom-script')

@endsection
