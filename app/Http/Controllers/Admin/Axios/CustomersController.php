<?php

namespace App\Http\Controllers\Admin\Axios;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use stdClass;

class CustomersController extends Controller
{
    public function __construct() {
        $this->middleware('can:manage-customers');
    }

    public function all(Request $request) {
        $per_page = ($request->get('per_page'))? $request->get('per_page') : 15;
        $search = htmlspecialchars($request->get('search'));

        $customers = Client::where('first_name', 'LIKE', "%$search%")
            ->orWhere('last_name', 'LIKE', "%$search%")
            ->orWhere('mobile', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orderBy('first_name')
            ->get();

        $clients = $this->makeClientsCollection($customers);

        $page = $request->get('page') ?: (Paginator::resolveCurrentPage() ?: 1);
        $paginatedClients = new LengthAwarePaginator($clients->forPage($page, $per_page), $clients->count(), $per_page, $page);

        return response()->json($paginatedClients, 200);
    }

    /**
     * @param Collection $clients
     * @return Collection
     */
    protected function makeClientsCollection(Collection $clients) {
        $customers = collect();
        foreach ($clients as $client) {
            $customer = new stdClass();
            $customer->name = $client->full_name;
            $customer->email = $client->email ? $client->email : 'N/A';
            $customer->mobile = $client->mobile ? mobileNumber($client->mobile) : 'N/A';
            $customer->id = $client->client_id;
            $customer->blood_group = $client->blood_group;
            $customer->image = ($client->img_url && strlen($client->img_url) > 10) ? staticAsset($client->img_url) : staticAsset('images/default_male.png');
            $customer->total_orders = $client->orders ? $client->orders->count() : 0;
            $customer->active = $client->active ? true : false;

            $customers->push($customer);
        }
        return $customers;
    }

    public function changeStatus(Request $request, $id) {
        $client = Client::find($id);

        if(!$client) {
            return sendNotFoundJsonResponse('Client not found');
        }
        $client->active = !$client->active;

        if(!$client->save()) {
            return sendServerErrorJsonResponse();
        }
        return response()->json('changed', 200);
    }
}
