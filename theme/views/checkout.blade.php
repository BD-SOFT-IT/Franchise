@extends('theme::layouts.app')

@section('title', 'Checkout :: ')
@section('description', 'Submit & Checkout your order.')
@section('keywords', getSiteBasic('site_keywords'))

@section('breadcrumb')
	@component('theme::components.breadcrumb', [
			'data'  => [
				//['url' => '#', 'title' => 'Shop']
			],
			'active'   => 'Checkout'
		])
	@endcomponent
@endsection

@section('content')
	<section class="checkout-view">
		<checkout></checkout>
	</section>
@endsection
