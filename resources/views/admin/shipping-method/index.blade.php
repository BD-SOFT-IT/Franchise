@extends('layouts.admin')

@section('sub-title', 'Shop Shipping Methods')
@section('page-description', 'All Shop Shipping Methods')

@section('shipping-active', 'active')
@section('shipping-all-active', 'active')

@section('header-action')
    <ul class="nav justify-content-end">
        <li class="nav-item text-center">
            <a class="nav-link btn btn-light" href="{{ route('admin.shipping.add') }}">
                <i class="fa fa-plus"> </i>
                <span class="d-none d-sm-block">Create Method</span>
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
                <strong><i class="fa fa-truck"> </i> All</strong> Shipping Methods
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Estimated Time</th>
                            <th scope="col">Outside Dhaka</th>
                            <th scope="col">Status</th>
                            <th scope="col">Note</th>
                            <th scope="col" style="width: 110px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($methods as $index => $method)
                            <tr>
                                <th scope="row">{{ $method->method_name }}</th>
                                <td>{{ $method->method_charge    }}</td>
                                <td>{{ $method->method_time }}</td>
                                <td>{{ ($method->method_available_outside) ? 'Yes' : 'No' }}</td>
                                <td>{{ ($method->method_active) ? 'Active' : 'Inactive' }}</td>
                                <td>{{ $method->method_note }}</td>
                                <td class="text-center" style="width: 110px;">
                                    <!-- Button trigger modal -->
                                    <a href="{{ route('admin.shipping.edit', ['id' => $method->method_id]) }}" class="btn btn-warning" title="Edit">
                                        <i class="fa fa-pencil"> </i>
                                    </a>
                                    <button type="button" class="btn btn-danger text-white"  title="Delete" data-toggle="modal" data-target="#deleteModal{{ $method->method_id }}">
                                        <i class="fa fa-trash"> </i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $method->method_id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Method</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure want to remove "{{ $method->method_name }}" as a <strong>Delivery Method</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.shipping.delete') }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $method->method_id }}">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
