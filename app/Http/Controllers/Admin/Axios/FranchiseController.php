<?php

namespace App\Http\Controllers\Admin\Axios;

use App\Models\Admin;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FranchiseController extends Controller
{
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:manage-franchise');
    }

    public function all(Request $request) {
        $per_page = ($request->get('per_page'))? $request->get('per_page') : 15;
        $search = htmlspecialchars($request->get('search'));

        $role = AdminRole::whereArName('franchise')
            ->firstOrFail();

        $franchises = $role->admins()
            ->where('name', 'LIKE', "%$search%")
            ->orWhere('mobile_primary', 'LIKE', "%$search%")
            ->orderBy('first_name')
            ->where('role_id', '=', $role->ar_id)
            ->select(['admins.name', 'admins.email', 'admins.mobile_primary', 'admins.role_id', 'admins.id', 'admins.active'])
            ->paginate($per_page);

        return response()->json($franchises, 200);
    }

    public function delete($id) {
        $franchise = AdminRole::whereArName('franchise')
            ->firstOrFail()
            ->admins()
            ->find($id);

        if(!$franchise) {
            return sendNotFoundJsonResponse('Franchise not found');
        }

        if($franchise->delete()) {
            return response()->json('deleted', 200);
        }
        return sendServerErrorJsonResponse();
    }
}
