@extends('theme::layouts.app')

@section('title', 'Email Verification :: ')
@section('description', getSiteBasic('site_description'))
@section('keywords', getSiteBasic('site_keywords'))

@section('breadcrumb')
    @component('theme::components.breadcrumb', [
            'data'  => [
                //['url' => '#', 'title' => 'Shop']
            ],
            'active'   => 'Email/Mobile Verification'
        ])
    @endcomponent
@endsection

@section('content')
<div class="container my-3 my-md-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bsoft-card">
                <div class="card-header text-center">Verify Your Email/Mobile</div>

                @if (session('resent') || (auth()->user()->email && !auth()->user()->hasVerifiedEmail()))
                    <div class="card-body text-center">
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                            <br>
                            It may take upto <strong>0-5 Minutes.</strong>
                        </div>

                        <span style="font-size: 13px; letter-spacing: 0.03em;">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            <br>
                            Didn't receive the email yet?
                            <a href="{{ route('verification.resend') }}" style="text-decoration: underline; color: var(--accent-color);" v-tooltip.top-bottom="'Request Another Verification Email'">
                                <strong>click to resend</strong>
                            </a>
                        </span>
                    </div>
                @endif

                @if (session('mobile') || (auth()->user()->mobile && !auth()->user()->hasVerifiedEmail()))
                    <div class="card-body text-center">
                        @if(session('mobile'))
                            <div class="alert alert-success" role="alert">
                                A fresh verification code has been sent to your mobile number.
                                <br>
                                It may take upto <strong>0-5 Minutes.</strong>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" class="text-center" action="{{ route('verification.mobile.verify', ['id' => auth()->id()]) }}">
                            @csrf
                            <label class="sr-only" for="mobile_verify">Verification Code</label>
                            <input type="text" class="form-control mb-2 mx-auto text-center" name="code" id="mobile_verify" placeholder="Your Verification Code" style="width: 250px;">

                            <button type="submit" class="btn btn-success mb-2">Verify</button>
                        </form>

                        <span style="font-size: 13px; letter-spacing: 0.03em;">
                            Before proceeding, please check your Mobile for a verification code.
                            <br>
                            Didn't receive the code yet?
                            <a href="{{ route('verification.mobile.resend') }}" style="text-decoration: underline; color: var(--accent-color);" v-tooltip.top-bottom="'Request Another Verification Code'">
                                <strong>click to resend</strong>
                            </a>
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
