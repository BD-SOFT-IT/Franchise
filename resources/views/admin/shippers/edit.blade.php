@extends('layouts.admin')

@section('sub-title', 'Edit Shop Admin')
@section('page-description', 'Edit Shop Admin')

@section('admins-active', 'active')
@section('admins-new-active', 'active')


@section('admin-content')
    <div class="all-admins-container">

        @if(Session::has('update_status') && Session::get('update_status'))
            <div class="alert alert-success">
                <span class="alert-icon"><i class="fa fa-check-circle"></i></span>
                <br>
                Admin Updated Successfully..!!
            </div>
        @endif

        @if(isset($not_found) && $not_found)
            <div class="alert alert-danger not-found">
                <span class="alert-icon"><i class="fa fa-exclamation-triangle"></i></span>
                <br>
                Oops..! Requested Admin not found.
            </div>
        @else
            <div class="card new-admin">
                <div class="card-header">
                    <strong><i class="fa fa-pencil"></i> Edit</strong> Admin
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.admins.edit', ['id' => $admin->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-2 col-form-label">Name</label>
                            <label for="last_name" class="sr-only">Last Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ $admin->first_name }}"
                                       id="first_name" name="first_name" placeholder="First Name" required autofocus>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ $admin->last_name }}"
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
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $admin->email }}"
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
                                       name="password" placeholder="Enter New Password" aria-describedby="passwordHelp" >
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
                                <input type="password" class="form-control" id="confPassword" name="password_confirmation" placeholder="Confirm New Password" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-2 col-form-label">Mobile No</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control {{ $errors->has('mobile_primary') ? 'is-invalid' : '' }}" value="{{ $admin->mobile_primary }}"
                                       id="mobile" name="mobile_primary" placeholder="Primary Mobile Number" required>
                                @if ($errors->has('mobile_primary'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('mobile_primary') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="custom-select {{ $errors->has('role_id') ? 'is-invalid' : '' }}" id="role" name="role_id" required>
                                    <option selected>--- Select Role ---</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->ar_id }}" {{ ($admin->role_id == $role->ar_id) ? 'selected' : '' }}>{{ $role->ar_title }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <input type="submit" class="btn btn-success" value="Update Admin">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
