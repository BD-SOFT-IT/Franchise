@extends('layouts.admin')

@section('sub-title', 'Shop Shippers')
@section('page-description', 'All Shop Shippers')

@section('shippers-active', 'active')
@section('shipper-all-active', 'active')

@section('header-action')
    <ul class="nav justify-content-end">
        <li class="nav-item text-center">
            <a class="nav-link btn btn-light" href="{{ route('admin.shipper.create') }}">
                <i class="fa fa-plus"></i>
                <span class="d-none d-sm-block">Create Shipper</span>
            </a>
        </li>
    </ul>
@endsection

@section('admin-content')
    <div class="all-admins-container">

        @if(Session::has('status'))
            <div class="alert alert-info text-center" role="alert">
                {{ Session::get('status') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-users"></i> All</strong> Shippers
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <th scope="row">{{ $admin->shipper_name }}</th>
                                    <td>{{ $admin->shipper_email }}</td>
                                    <td>{{ $admin->shipper_phone }}</td>
                                    <td>{{ $admin->shipper_address }}</td>
                                    <td class="text-center">
                                        @can('delete-admin')
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger text-white"  title="Delete" data-toggle="modal" data-target="#deleteModal{{ $admin->shipper_id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $admin->shipper_id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete Shipper</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure want to remove "{{ $admin->shipper_name }}" as a <strong>Shipper</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('admin.shipper.delete') }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="id" value="{{ $admin->shipper_id }}">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger">Confirm</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
