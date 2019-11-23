@extends('seller.layouts.seller_dashboard_master')\

@section('sellerCancelProducts-title')
    Canceled Products
    @endsection

@section('sellerCancelProducts')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Products</h4>
                <div class="table-responsive ">
                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Purc. Price</th>
                            <th>Discount</th>
                            <th>Qty</th>
                            <th>Color</th>
                            <th>size</th>
                            <th>Upload</th>
                            <th>action</th>
                        </tr>.
                        </thead>

                        <tbody>
{{--                        @foreach($products as $index => $product)--}}

{{--                            <tr >--}}
{{--                                <td>{{$index+1}}</td>--}}
{{--                                <td>{{str_limit($product->name,20)}}</td>--}}


{{--                                <td>{{$product->price_per_unit}}</td>--}}
{{--                                <td>{{$product->purchase_price}}</td>--}}
{{--                                <td>{{$product->discount}}%</td>--}}
{{--                                <td>{{$product->quantity}}</td>--}}
{{--                                <td>--}}
{{--                                    @foreach($product->colors as $color)--}}
{{--                                        <span class="badge badge-success">{{$color->name}}</span><br>--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @foreach($product->sizes as $size)--}}
{{--                                        <span class="badge badge-info">{{$size->name}}</span><br>--}}
{{--                                    @endforeach--}}

{{--                                </td>--}}
{{--                                <td>{{$product->created_at->format('d M, Y')}}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{route('products.show',$product->id)}}" class="btn btn-primary btn-sm ">Edit</a>--}}
{{--                                    @if($product->active)--}}
{{--                                        <a href="{{route('products.deactive',$product->id)}}" class="btn btn-danger btn-sm ">Deactive</a>--}}
{{--                                    @else--}}
{{--                                        <a href="{{route('products.active',$product->id)}}" class="btn btn-success btn-sm ">Active</a>--}}
{{--                                    @endif--}}
{{--                                    @if(!$product->hot)--}}

{{--                                        <a onclick="add({{$product->id}},{{$index}});" id="hot{{$index}}" style="color: white;" class="btn btn-info btn-sm">hot</i>--}}
{{--                                        </a>--}}

{{--                                    @else--}}

{{--                                        <a onclick="delHot({{$product->id}},{{$index}});" id="delHot{{$index}}" style="color: white;" class="btn btn-danger btn-sm"> <span id="unhot">Unhot</span>--}}
{{--                                        </a>--}}


{{--                                    @endif--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
