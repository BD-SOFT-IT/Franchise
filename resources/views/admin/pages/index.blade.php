@extends('layouts.admin')

@section('sub-title', 'Pages - All')
@section('page-description', 'All Pages')

@section('pages-active', 'active')

@section('admin-content')
    <div class="all-admins-container">

        @if(Session::has('status'))
            <div class="alert alert-success text-center" role="alert">
                {{ Session::get('status') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-file-text-o"></i> All</strong> Pages
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col" class="text-center">Author</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Date</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <th scope="row">
                                    <a href="{{ url($page->post_slug) }}">
                                        {{ $page->post_title }}
                                    </a>
                                </th>
                                <td class="text-center">{{ $page->author->name }}</td>
                                <td class="text-center">{{ $page->post_active ? 'Published' : 'Draft' }}</td>
                                <td class="text-center">{{ $page->created_at->toDateString() }}</td>
                                <td class="text-center">
                                    <a href="{{ url($page->post_slug) }}" target="_blank" class="btn btn-info text-white" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.pages.edit', ['id' => $page->post_id]) }}" class="btn btn-warning text-white" title="Edit"><i class="fa fa-pencil"></i></a>
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
