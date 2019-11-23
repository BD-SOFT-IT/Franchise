@extends('theme::layouts.app')

@section('title', 'Affiliate or Franchise Register :: ')
@section('description', 'Register as a reseller.')
@section('keywords', 'affiliate, franchise, reseller')

@section('breadcrumb')
    @component('theme::components.breadcrumb', [
			'data'  => [
				//['url' => '#', 'title' => 'Shop']
			],
			'active'   => 'Franchise or Affiliate'
		])
    @endcomponent
@endsection

@section('content')
    <section class="affiliate-page">
        <franchise-register> </franchise-register>
    </section>
@endsection
