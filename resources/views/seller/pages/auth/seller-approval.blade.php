@extends('seller.seller-master')

@section('seller_approval')
    <h3 class="text-danger lead text-center">
        {{Session::get('message')}}
    </h3>
    @endsection
