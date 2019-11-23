@extends('layouts.admin')

@section('sub-title', 'Account Security')
@section('page-description', 'account security')

@section('dashboard-active', 'active')

@section('admin-content')
    <div class="all-admins-container">
        <div class="card new-admin">
            <div class="card-header">
                <strong><i class="fa fa-key"></i> Update</strong> Password
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.security') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="recipient-password-old" class="col-form-label col-md-3">Old Password: <span class="red">*</span></label>
                        <div class="col-md-9">
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="recipient-password-old" name="old_password" required>
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-password" class="col-form-label col-md-3">New Password: <span class="red">*</span></label>
                        <div class="col-md-9">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="recipient-password" name="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-password-confirm" class="col-form-label col-md-3">Confirm New Password: <span class="red">*</span></label>
                        <div class="col-md-9">
                            <input type="password" class="form-control @error('name') is-invalid @enderror" id="recipient-password-confirm" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" class="btn btn-success"> Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
