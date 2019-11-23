@extends('layouts.admin')

@section('sub-title', 'Shop Admins')
@section('page-description', 'All Shop Admins')

@section('admins-active', 'active')
@section('admins-all-active', 'active')

@section('header-action')
    <ul class="nav justify-content-end">
        <li class="nav-item text-center">
            <a class="nav-link btn btn-light" href="{{ route('admin.admins.create') }}">
                <i class="fa fa-plus"></i>
                <span class="d-none d-sm-block">Create Admin</span>
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
                <strong><i class="fa fa-users"></i> All</strong> Admins
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                @if($admin->email !== 'bdsoftit@email.com')
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('admin.admins.single', ['id' => $admin->id]) }}">{{ $admin->name }}</a>
                                        </th>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->mobile_primary }}</td>
                                        <td>{{ $admin->role->ar_title }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.admins.single', ['id' => $admin->id]) }}" class="btn btn-info text-white" title="View"><i class="fa fa-eye"></i></a>
                                            @can('delete-admin')
                                                <a href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}" class="btn btn-warning text-white" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger text-white"  title="Delete" data-toggle="modal" data-target="#deleteModal{{ $admin->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Delete Admin</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure want to remove "{{ $admin->name }}" as a <strong>{{ $admin->role->ar_title }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('admin.admins.delete') }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="id" value="{{ $admin->id }}">
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
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
