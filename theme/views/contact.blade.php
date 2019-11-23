@extends('theme::layouts.app')

@section('title', 'Contact :: ')
@section('description', getSiteBasic('site_description'))
@section('keywords', getSiteBasic('site_keywords'))

@section('breadcrumb')
    @component('theme::components.breadcrumb', [
			'data'  => [
				//['url' => '#', 'title' => 'Shop']
			],
			'active'   => 'Contact'
		])
    @endcomponent
@endsection

@section('content')
    <section class="contact-page">

    </section>
@endsection
