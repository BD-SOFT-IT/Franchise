<?php

namespace App\Http\Controllers\Admin;

use App\Models\ApiAgent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;

class ApiAgentController extends Controller
{

    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:control-api');
    }

    public function index() {
        $agents = ApiAgent::orderByDesc('created_at')
            ->get();

        return view('admin.api-agents.index')
            ->with([
                'agents'    => $agents
            ]);
    }

    public function create() {
        return view('admin.api-agents.create');
    }

    public function store(Request $request) {
        $request->validate([
            'agent_name'  => 'required|min:5|max:25|string|unique:api_agents',
            'agent_type'  => 'required|string'
        ]);

        $key_last = substr(date('Y'), 2) . date('m') . date('d');
        $key = Str::random(16) . $key_last;

        $api = new ApiAgent;

        $api->agent_name = $request->post('agent_name');
        $api->agent_type = $request->post('agent_type');
        $api->agent_api_key = $key;
        $api->agent_api_secret = Str::random(16);
        $api->agent_creator_id = auth('admin')->id();

        if(!$api->save()) {
            return redirect()->back()->withInput();
        }
        return redirect()
            ->route('admin.api_agent');
    }

    public function edit($id) {
        $agent = ApiAgent::find($id);
        if(!$agent) {
            return redirect()->back();
        }
        return view('admin.api-agents.edit')
            ->with([
                'agent' => $agent
            ]);
    }

    public function update(Request $request, $id) {
        $agent = ApiAgent::find($id);
        if(!$agent) {
            return redirect()->back();
        }
        $request->validate([
            'agent_type'  => 'required|string',
            'agent_name'  => 'required|min:5|max:25|string'
        ]);
        if($agent->agent_name != $request->post('agent_name')) {
            $request->validate([
                'agent_name'  => 'unique:api_agents'
            ]);
        }
        $agent->agent_name = $request->post('agent_name');
        $agent->agent_type = $request->post('agent_type');

        $agent->save();

        return redirect()
            ->route('admin.api_agent');
    }

    public function delete(Request $request) {
        $agent = ApiAgent::find($request->post('agent_id'));
        if(!$agent) {
            return redirect()->back();
        }
        $agent->delete();
        return redirect()
            ->route('admin.api_agent');
    }
}
