@extends('layouts.admin')

@section('sub-title', 'Franchise Details')
@section('page-description', 'Franchise Details')

@section('franchise-active', 'active')
@section('franchise-all-active', 'active')

@section('header-action')
    <ul class="nav justify-content-end">
        @if(!isset($error) && !$franchise->active)
            <li class="nav-item text-center">
                <a class="nav-link btn btn-light" href="#" data-toggle="modal" data-target="#activateModal">
                    <i class="fa fa-check"></i>
                    <span class="d-none d-sm-block">Activate</span>
                </a>
            </li>
        @endif

        @if(!isset($error) && $franchise->active)
        <li class="nav-item text-center">
            <a class="nav-link btn btn-light" href="#" data-toggle="modal" data-target="#deactivateModal">
                <i class="fa fa-check"></i>
                <span class="d-none d-sm-block">Deactivate</span>
            </a>
        </li>
        @endif
    </ul>
@endsection

@section('admin-content')
    <div class="all-admins-container">

        @if(Session::has('status'))
            <div class="alert alert-info text-center" role="alert">
                {{ Session::get('status') }}
            </div>
        @endif
        @if(isset($error))
            <div class="alert alert-danger text-center" role="alert">
                {{ $error }}
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <strong><i class="fa fa-info-circle"></i> Franchise</strong> Details
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-xl-8">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="max-width: 100px;">Name</th>
                                            <th scope="row">{{ $franchise->name }}</th>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="max-width: 100px;">Email</th>
                                            <td>{{ $franchise->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="max-width: 100px;">Mobile Primary</th>
                                            <td>{{ mobileNumber($franchise->mobile_primary) }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="max-width: 100px;">Mobile Secondary</th>
                                            <td>{{ $franchise->mobile_secondary ? mobileNumber($franchise->mobile_secondary) : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="max-width: 100px;">Address</th>
                                            <td>{{ $franchise->address }}, {{ $franchise->city }}, Bangladesh-{{ $franchise->postcode }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="max-width: 100px;">Total Products</th>
                                            <td>{{ $franchise->franchiseProducts->count() }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Activate Modal -->
            <div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.franchise-control.activate', ['id' => $franchise->id]) }}" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title w-100 text-center" id="activateModalLabel">Activate Franchise</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                @csrf
                                @method('PATCH')
                                Are you sure want to activate this franchise?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Activate Modal -->
            <div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.franchise-control.deactivate', ['id' => $franchise->id]) }}" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title w-100 text-center" id="deactivateModalLabel">Deactivate Franchise</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                @csrf
                                @method('PATCH')
                                Are you sure want to deactivate this franchise?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Deactivate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
