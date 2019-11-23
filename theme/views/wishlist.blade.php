@extends('theme::layouts.app')

@section('title', 'Wishlist :: ')
@section('description', getSiteBasic('site_description'))
@section('keywords', getSiteBasic('site_keywords'))

@section('breadcrumb')
	@component('theme::components.breadcrumb', [
			'data'  => [
				//['url' => '#', 'title' => 'Shop']
			],
			'active'   => 'Wishlist'
		])
	@endcomponent
@endsection

@section('content')
	<section class="wishlist-view my-5">
		<div class="container">
			<div class="row">

			</div>
		</div>
	</section>
@endsection
