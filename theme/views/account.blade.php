@extends('theme::layouts.app')

@section('title', 'User Dashboard :: ')
@section('description', getSiteBasic('site_description'))
@section('keywords', getSiteBasic('site_keywords'))

@section('breadcrumb')
    @component('theme::components.breadcrumb', [
            'data'  => [
                //['url' => '#', 'title' => 'Shop']['url' => route(), 'title' => 'Shop']
            ],
            'active'   => 'Order Details'
        ])
    @endcomponent
@endsection

@section('content')
    <section class="account-view">
        <div class="container my-3 my-md-5">

            <div class="row">
                @if (session('status'))
                    <div class="col-12">
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                <div class="col-12 col-md-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="accountHome-tab" data-toggle="pill" href="#accountHome" @click.prevent="changeAccountTab($event, '#accountHome')" role="tab" aria-controls="accountHome" aria-selected="true">
                            Dashboard
                        </a>
                        <a class="nav-link" id="accountWishlist-tab" data-toggle="pill" href="#accountWishlist" @click.prevent="changeAccountTab($event, '#accountWishlist')" role="tab" aria-controls="accountWishlist" aria-selected="false">
                            Wishlist
                        </a>
                        <a class="nav-link" id="accountOrders-tab" data-toggle="pill" href="#accountOrders" @click.prevent="changeAccountTab($event, '#accountOrders')" role="tab" aria-controls="accountOrders" aria-selected="false">
                            Orders
                        </a>
                        <a class="nav-link" id="accountProfile-tab" data-toggle="pill" href="#accountProfile" @click.prevent="changeAccountTab($event, '#accountProfile')" role="tab" aria-controls="accountProfile" aria-selected="false">
                            Profile
                        </a>
                        <a class="nav-link" id="accountSettings-tab" data-toggle="pill" href="#accountSettings" @click.prevent="changeAccountTab($event, '#accountSettings')" role="tab" aria-controls="accountSettings" aria-selected="false">
                            Referral
                        </a>
                        <a class="nav-link" id="referralHistory-tab" data-toggle="pill" href="#referralHistory" @click.prevent="changeAccountTab($event, '#referralHistory')" role="tab" aria-controls="referralHistory" aria-selected="false">
                            Referral History
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        {{-- Account Dashboard Tab --}}
                        <div class="tab-pane fade show active" id="accountHome" role="tabpanel" aria-labelledby="accountHome-tab">
                            <div class="card bsoft-card">
                                <div class="card-header">
                                    Dashboard
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="dashboard-profile text-center">
                                                @if(auth()->user()->img_url && strlen(auth()->user()->img_url) > 10)
                                                    <img src="{{ staticAsset(auth()->user()->img_url) }}" alt="{{ auth()->user()->full_name }}">
                                                @else
                                                    <img src="{{ asset('images/default_male.png') }}" alt="" class="w-100">
                                                @endif
                                                <h5>{{ auth()->user()->full_name }}</h5>
                                                <div class="contact mb-2">
                                                    @if(auth()->user()->email)
                                                        <span class="d-block">
                                                            <i class="icon ion-ios-mail"> </i> {{ auth()->user()->email }}
                                                        </span>
                                                    @endif
                                                    @if(auth()->user()->mobile)
                                                        <span class="d-block">
                                                            <a href="tel:{{ mobileNumber(auth()->user()->mobile) }}">
                                                                <i class="icon ion-ios-call"></i> {{ mobileNumber(auth()->user()->mobile) }}
                                                            </a>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="dashboard-address">
                                                <address style="font-size: 14px;">
                                                    <strong style="font-size: 16px; line-height: 22px;">{{ auth()->user()->full_name }}</strong> <br>
                                                    <br>
                                                    {{ auth()->user()->billing_address }}, {{ auth()->user()->billing_area }}
                                                    <br>{{ auth()->user()->billing_city }},  {{ auth()->user()->billing_state }}<br>
                                                    Bangladesh - {{ auth()->user()->billing_postcode }}
                                                    <br> <br>
                                                    <span class="text-muted">Mobile Primary</span> <br>
                                                    {{ auth()->user()->mobile ? mobileNumber(auth()->user()->mobile) : '' }} <br> <br>
                                                    <span class="text-muted">Mobile Secondary</span> <br>
                                                    {{ auth()->user()->mobile_secondary ? mobileNumber(auth()->user()->mobile_secondary) : '' }} <br> <br>
                                                </address>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-8">
                                            <div class="referral">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Account Wishlist Tab --}}
                        <div class="tab-pane fade" id="accountWishlist" role="tabpanel" aria-labelledby="accountWishlist-tab">
                            <div class="card bsoft-card">
                                <div class="card-header">
                                    Wishlist
                                </div>
                                <div class="card-body">
                                    <wishlist></wishlist>
                                </div>
                            </div>
                        </div>

                        {{-- Account Orders Tab --}}
                        <div class="tab-pane fade" id="accountOrders" role="tabpanel" aria-labelledby="accountOrders-tab">
                            <div class="card bsoft-card">
                                <div class="card-header">
                                    Orders
                                </div>
                                <div class="card-body">
                                    @php($orders = auth()->user()->orders()->paginate(10))
                                    <div class="table-responsive wishlist-table">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">Order No</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($orders as $index => $order)
                                                <tr>
                                                    <th>
                                                        <a href="{{ route('order.details', ['no' => $order->order_no]) }}" class="hvr-buzz-out" v-tooltip.top-center="'Click to View Details'" style="color: var(--accent-color);">
                                                            #{{ $order->order_no }}
                                                        </a>
                                                    </th>
                                                    <td>
                                                        {{ $order->created_at->toDateString() }}
                                                    </td>
                                                    <td>
                                                        {{ $order->order_progress }}
                                                    </td>
                                                    <td class="d-none d-md-table-cell">
                                                        <strong><i class="sbicon sbicon-bdt"></i> {{ $order->order_total }}</strong>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <th colspan="4">You haven't Made any order yet.</th>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Account Profile Tab --}}
                        <div class="tab-pane fade edit-profile-tab" id="accountProfile" role="tabpanel" aria-labelledby="accountProfile-tab">
                            <div class="card bsoft-card">
                                <div class="card-header">
                                    Edit Profile
                                </div>
                                <div class="card-body">
                                    <edit-profile static-url="{{ staticAsset('/') }}"> </edit-profile>
                                </div>
                            </div>
                        </div>

                        {{-- Referral Tab --}}
                        <div class="tab-pane fade" id="accountSettings" role="tabpanel" aria-labelledby="accountSettings-tab">
                            <div class="card bsoft-card">
                                <div class="card-header">
                                    Referral
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-10 text-center">
                                            <div class="p-5">
                                                <h3>Share & Win</h3>
                                                <p style="line-height: 22px; font-size: 15px;">
                                                    Get <strong>50TK</strong> instant off when your friends buy from your invite link or using your referral code.
                                                </p>
                                                <span class="h4 p-2 mt-3 d-block" style="border: 3px solid var(--accent-color);">
                                                    {{ strtoupper(auth()->user()->referral->coupon_code) }}
                                                </span>
                                                <div class="my-2" style="line-height: 30px;">
                                                    Or copy the link & share to your friends... <br>
                                                    <a style="box-shadow: inset 0 0 3px black; padding: 8px 20px;" href="{{ route('shop', ['ref' => auth()->user()->referral->coupon_code]) }}">
                                                        {{ route('shop', ['ref' => auth()->user()->referral->coupon_code]) }}
                                                    </a>
                                                </div>
                                                <br> <br>
                                                <hr>
                                                <h3>Your Referral Points</h3>
                                                <span class="h4 p-2 mt-3 d-block" style="border: 3px solid var(--accent-color);">
                                                    {{ (auth()->user()->referralPoint) ? auth()->user()->referralPoint->point_value : 0 }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="referralHistory" role="tabpanel" aria-labelledby="referralHistory-tab">
                            <div class="card bsoft-card">
                                <div class="card-header">
                                    Referral History
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-10 text-center">
                                            <div class="p-5">
                                                <h3>Your Referral Points</h3>
                                                <span class="h4 p-2 mt-3 d-block" style="border: 3px solid var(--accent-color);">
                                                    {{ (auth()->user()->referralPoint) ? auth()->user()->referralPoint->point_value : 0 }}
                                                </span>
                                                <br> <br>
                                                <hr>
                                                <h4 class="mb-3">Your Referral Histories</h4>
                                                <table class="table">
                                                    <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Used By</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse(auth()->user()->referral->couponHistories as $index => $history)
                                                        <tr>
                                                            <th scope="row">{{ $index + 1 }}</th>
                                                            <td>{{ $history->client->full_name }}</td>
                                                            <td>{{ Carbon\Carbon::parse($history->ch_used_at, config('app.timezone'))->toDateString() }}</td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
