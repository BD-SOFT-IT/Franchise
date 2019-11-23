@extends('theme::layouts.app')

@section('title', $privacy->post_title . ' :: ')
@section('description', getSiteBasic('site_description'))
@section('keywords', getSiteBasic('site_keywords'))

@section('breadcrumb')
    @component('theme::components.breadcrumb', [
            'data'  => [
                //['url' => '#', 'title' => 'Shop']
            ],
            'active'   => $privacy->post_title
        ])
    @endcomponent
@endsection

@section('styles')
    <style>
        .about-page {
            text-align: center;
        }
        .about-page img {
            margin: 0 auto;
        }
    </style>
@endsection

@section('content')
    <section class="about-page py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! $privacy->post_description !!}
                </div>
            </div>
        </div>
    </section>
@endsection