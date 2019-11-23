@extends('layouts.admin')

@section('sub-title', 'Edit Api Agents')
@section('page-description', 'Edit Api Agents')

@section('api-active', 'active')


@section('admin-content')
    <div class="rbt-api-agents">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-pencil"></i> Edit</strong> Agent
            </div>
            <div class="card-body">
                <div class="add-new-agent">
                    <form method="post" action="{{ route('admin.api_agent.edit', ['id' => $agent->agent_id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="agentName" class="col-sm-2 col-form-label">Name (Unique)*</label>
                            <div class="col-sm-10">
                                <input type="text" name="agent_name" class="form-control{{ $errors->has('agent_name') ? ' is-invalid' : '' }}" value="{{ $agent->agent_name }}" id="agentName" placeholder="Agent Name">
                                @if ($errors->has('agent_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('agent_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="agentType" class="col-sm-2 col-form-label">Type*</label>
                            <div class="col-sm-10">
                                <select name="agent_type" id="agentType" class="custom-select{{ $errors->has('type') ? ' is-invalid' : '' }}">
                                    <option value="" selected>--- Select Agent Type ---</option>
                                    <option value="Android" {{ ($agent->agent_type == 'Android') ? 'selected' : '' }}>Android</option>
                                    <option value="IoS" {{ ($agent->agent_type == 'IoS') ? 'selected' : '' }}>IoS</option>
                                    <option value="Desktop" {{ ($agent->agent_type == 'Desktop') ? 'selected' : '' }}>Desktop</option>
                                </select>
                                @if ($errors->has('agent_type'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('agent_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 offset-sm-2">
                                <button type="submit" class="btn btn-success">Update Agent</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')

@endsection