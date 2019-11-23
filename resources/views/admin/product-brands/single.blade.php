@extends('layouts.admin')

@section('sub-title', 'Create New Product Brand')
@section('page-description', 'Create New Product Brand')

@section('brand-active', 'active')
@section('brand-all-active', 'active')


@section('admin-content')
    <div class="rbt-product-brands view-brand">
        @if(isset($notFound))
            <div class="alert alert-danger not-found" role="alert">
                <span class="alert-icon">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </span>
                <br>
                {{ $notFound }}
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <strong><i class="fa fa-eye"></i> View</strong> Brand
                    <a href="{{ route('admin.brands.edit', ['id' => $brand->pb_id]) }}" title="Edit this Brand" class="pull-right">
                        <i class="fa fa-pencil"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="brand-image text-center">
                        @if($brand->pb_img == null || $brand->pb_img == '')
                            <img style="max-height: 250px; margin-bottom: 25px;" src="{{ asset('assets/images/brand.png') }}" alt="{{ $brand->pb_name }}">
                        @else
                            <img style="max-height: 250px; margin-bottom: 25px;" src="{{ url('uploads/public/cache/original/' . $brand->pb_img) }}" alt="{{ $brand->pb_name }}">
                        @endif
                    </div>
                    <div class="brand-details">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th class="align-middle" scope="row" style="width: 160px;">Name</th>
                                <td class="align-middle"><strong>{{ $brand->pb_name }}</strong></td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row" style="width: 160px;">Website</th>
                                <td class="align-middle">{{ $brand->pb_website }}</td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row" style="width: 160px;">Email</th>
                                <td class="align-middle">{{ $brand->pb_email }}</td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row" style="width: 160px;">Phone</th>
                                <td class="align-middle">{{ $brand->pb_phone }}</td>
                            </tr>

                            @can('delete-brand')
                                <tr>
                                    <th class="align-middle" scope="row" style="width: 160px;">Log</th>
                                    <td class="align-middle">
                                        <table class="table">
                                            <tbody>
                                                {{--@php
                                                    $logs = convertStringToArray($brand->pb_log, true);
                                                @endphp--}}
                                                @foreach($logs = convertStringToArray($brand->pb_log, true) as $log)
                                                    <tr>
                                                        <td>{{ $log['time'] }}</td>
                                                        <td>{{ $log['author_name'] }}</td>
                                                        <td>{{ $log['type'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endcan
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection