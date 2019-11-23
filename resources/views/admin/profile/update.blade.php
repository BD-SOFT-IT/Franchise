@extends('layouts.admin')

@section('sub-title', 'Profile')
@section('page-description', 'RBT Ecom Profile')

@section('dashboard-active', 'active')

@section('admin-content')
    <div class="all-admins-container">
        @if(Session::has('success'))
            <div class="alert alert-success py-3">
                <span class="alert-icon"> <i class="fa fa-check-circle"></i> </span> <br>
                {{ Session::get('success') }}
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger not-found py-3">
                <span class="alert-icon"> <i class="fa fa-exclamation-triangle"></i> </span> <br>
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="card new-admin">
            <div class="card-header">
                <strong><i class="fa fa-pencil"></i> Edit</strong> Profile
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                        <label for="last_name" class="sr-only">Last Name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control mb-3 mb-sm-0 {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ old('first_name', auth('admin')->user()->first_name) }}"
                                   id="first_name" name="first_name" placeholder="First Name" required autofocus>
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ old('last_name', auth('admin')->user()->last_name) }}"
                                   id="last_name" name="last_name" placeholder="Last Name" required>
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            @if(auth('admin')->user()->isSuperAdmin() || auth('admin')->user()->isAdmin())
                                <input type="email" class="form-control @error('address') is-invalid @enderror" value="{{ old('email', auth('admin')->user()->email) }}"
                                       id="email" name="email" placeholder="Email Address" required>
                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            @else
                                <input type="email" class="form-control" value="{{ auth('admin')->user()->email }}"
                                       id="email" name="email" placeholder="Email Address" disabled>
                                <small class="form-text text-muted">For Email Change, Please Contact With Administrator.</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-sm-2 col-form-label">Mobile Primary <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control {{ $errors->has('mobile_primary') ? 'is-invalid' : '' }}" value="{{ old('mobile_primary', auth('admin')->user()->mobile_primary) }}"
                                   id="mobile" name="mobile_primary" placeholder="Primary Mobile Number" required>
                            @if ($errors->has('mobile_primary'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('mobile_primary') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile_secondary" class="col-sm-2 col-form-label">Mobile Secondary</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control {{ $errors->has('mobile_secondary') ? 'is-invalid' : '' }}" value="{{ old('mobile_secondary', auth('admin')->user()->mobile_secondary) }}"
                                   id="mobile_secondary" name="mobile_secondary" placeholder="Secondary Mobile Number">
                            @if ($errors->has('mobile_secondary'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('mobile_secondary') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="3" style="resize: none;">{!! old('address', auth('admin')->user()->address) !!}</textarea>
                            @error('address')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-md-2 col-form-label">City</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control @error('city') is-invalid @enderror" value="{{ auth('admin')->user()->city }}"
                                   id="city" name="city" placeholder="City">
                            @error('city')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="postcode" class="col-md-2 col-form-label">Postcode</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control @error('postcode') is-invalid @enderror" value="{{ auth('admin')->user()->postcode }}"
                                   id="postcode" name="postcode" placeholder="Postcode">
                            @error('postcode')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    @if(!auth('admin')->user()->isFranchise() && !auth('admin')->user()->isShipper())
                        <div class="form-group row">
                            <label for="img_url" class="col-sm-2 col-form-label">Profile Image</label>
                            <div class="col-sm-10" id="rmmUpload">
                                @if(auth('admin')->user()->img_url && strlen(auth('admin')->user()->img_url) > 10)
                                    <img src="{{ imageCache(auth('admin')->user()->img_url, 'original') }}" alt="{{ auth('admin')->user()->name }}" style="max-height: 300px; max-width: 350px; margin: 0 auto;">
                                @else
                                    <img src="{{ asset('assets/mobile/images/user.png') }}" alt="" style="max-height: 300px; max-width: 300px; margin: 0 auto;">
                                @endif

                                <input type="hidden" id="img_url" name="img_url" value="{{ old('img_url') }}">

                                <button type="button" class="btn btn-light btn-outline-warning mt-3 d-block" data-toggle="modal" data-target="#rbtMediaManager">
                                    <i class="fa fa-retweet"></i> Change
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmationModal"> Update Profile </button>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Update Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <h6 class="font-weight-bold mb-4">Please Enter Your Password to Update Your Profile</h6>
                                    <label for="password" class="sr-only">Password</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control"
                                               id="password" name="password" placeholder="Enter Your Password" required autofocus>
                                    </div>
                                </div>
                                <div class="modal-footer text-center justify-content-center">
                                    <button type="submit" class="btn btn-success">Confirm Update</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        @if(!auth('admin')->user()->isFranchise() && !auth('admin')->user()->isShipper())
            <rbt-media-manager
                    directory="Profile"
                    :user_id="$root.admin.id"
                    url_prefix="/bs-mm-api"
                    show_as="modal"
                    element_id="rmmUpload">
            </rbt-media-manager>
        @endif
{{--        @endif--}}
    </div>
@endsection

