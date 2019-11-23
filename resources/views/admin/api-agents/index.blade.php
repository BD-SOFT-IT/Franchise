@extends('layouts.admin')

@section('sub-title', 'Api Agents')
@section('page-description', 'View All Api Agents')

@section('api-active', 'active')
@section('api-all-active', 'active')

@section('admin-content')
    <div class="rbt-api-agents">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-database"></i> Api</strong> Agents
                <a href="{{ route('admin.api_agent.add') }}" class="pull-right" title="Add New Agent">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Key</th>
                                <th class="text-center">Secret</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agents as $agent)
                                <tr>
                                    <th scope="row" class="text-center">{{ $agent->agent_name }}</th>
                                    <td class="text-center">{{ $agent->agent_api_key }}</td>
                                    <td class="text-center">{{ $agent->agent_api_secret }}</td>
                                    <td class="text-center">{{ $agent->agent_type }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.api_agent.edit', ['id' => $agent->agent_id]) }}" class="btn btn-warning" title="Edit" style="color: #fff;">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" onclick="setDeleteApi({{ $agent->agent_id }})" data-toggle="modal" data-target="#apiDeleteModal" class="btn btn-danger" title="Delete" style="color: #fff;">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="apiDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Api</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete this api?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('admin.api_agent.delete') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="deleteAgentInput" value="" name="agent_id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Confirm</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        function setDeleteApi(id) {
            let deleteInput = document.getElementById('deleteAgentInput');
            deleteInput.value = id;
        }
    </script>
@endsection