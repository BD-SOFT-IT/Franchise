@extends('layouts.admin')

@section('sub-title', 'Add New Franchise')
@section('page-description', 'Add New Franchise')

@section('franchise-active', 'active')
@section('franchise-new-active', 'active')



@section('admin-content')
    <div class="all-admins-container">
        <div class="card new-admin">
            <div class="card-header">
                <strong><i class="fa fa-plus"></i> Add</strong> New Franchise
            </div>
            <div class="card-body">
                <form action="{{ route('admin.franchise-control.add') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">Name</label>
                        <label for="last_name" class="sr-only">Last Name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ old('first_name') }}"
                                   id="first_name" name="first_name" placeholder="First Name" required autofocus>
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ old('last_name') }}"
                                   id="last_name" name="last_name" placeholder="Last Name" required>
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"
                                   id="email" name="email" placeholder="Email Address" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password"
                                   name="password" placeholder="Password" aria-describedby="passwordHelp" required>
                            <small id="passwordHelp" class="form-text text-muted">
                                Password must be at least 6 characters.
                            </small>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="confPassword" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-sm-2 col-form-label">Mobile No</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control {{ $errors->has('mobile_primary') ? 'is-invalid' : '' }}" value="{{ old('mobile_primary') }}"
                                   id="mobile" name="mobile_primary" placeholder="Primary Mobile Number" required>
                            @if ($errors->has('mobile_primary'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('mobile_primary') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <input type="submit" class="btn btn-success" value="Create Franchise">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
