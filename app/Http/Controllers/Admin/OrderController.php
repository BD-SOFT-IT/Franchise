<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FranchiseStore;
use App\Models\Product;
use App\Notifications\OrderConfirmed;
use App\Notifications\OrderDelivered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Models\Shipper;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:create-order')->only('create');
    }

    /**
     * Show pending orders
     */
    public function pending() {
        return view('admin.orders.pending');
    }

    /**
     * Show confirmed orders
     */
    public function confirmed() {
        return view('admin.orders.confirmed');
    }

    /**
     * Show succeed orders
     */
    public function delivered() {
        return view('admin.orders.delivered');
    }

    /**
     * Show canceled orders
     */
    public function canceled() {
        return view('admin.orders.canceled');
    }

    /**
     * Show all orders
     */
    public function all() {
        return view('admin.orders.all');
    }

    public function forFranchise() {
        return view('admin.orders.for_franchise');
    }

    public function byFranchise() {
        return view('admin.orders.by_franchise');
    }

    public function create() {
        return view('admin.orders.create');
    }

    /**
     * Show single order details
     */
    public function single($order_no) {
        $order = Order::leftJoin('shippers', 'shippers.shipper_id', '=', 'orders.order_shipper_id')
            ->where('order_no', '=', $order_no)
            ->select([
                'orders.*', 'shippers.shipper_user_id', 'shippers.shipper_name', 'shippers.shipper_company', 'shippers.shipper_website',
                'shippers.shipper_address', 'shippers.shipper_phone', 'shippers.shipper_email'
            ])
            ->first();
        // If not found
        if(!$order) {
            return view('admin.orders.single')
                ->with('not_found', true);
        }
        $this->authorize('view-order', $order);

        $client = $order->client;
        $order_details = $order->orderDetails;
        $shippers = Shipper::all();

        return view('admin.orders.single')
            ->with([
                'order'             => $order,
                'client'            => $client,
                'franchise'         => $order->byFranchise,
                'order_details'     => $order_details,
                'shippers'          => $shippers
            ]);
    }


    public function edit($order_no) {
        $order = Order::where('order_no', '=', $order_no)->first();
        if(!$order) {
            return redirect()->back();
        }
        $this->authorize('update-order', $order);

        $order = Order::join('clients', 'clients.client_id', '=', 'orders.order_client_id')
            ->leftJoin('shippers', 'shippers.shipper_id', '=', 'orders.order_shipper_id')
            ->where('order_no', '=', $order_no)
            ->select([
                'orders.*', 'clients.first_name as client_name', 'clients.billing_address', 'clients.billing_city', 'clients.billing_state',
                'clients.billing_country', 'clients.billing_postcode', 'clients.mobile as client_phone', 'clients.email as client_email',
                'shippers.shipper_user_id', 'shippers.shipper_name', 'shippers.shipper_company', 'shippers.shipper_website',
                'shippers.shipper_address', 'shippers.shipper_phone', 'shippers.shipper_email'
            ])
            ->first();

        return view('admin.orders.edit')
            ->with([
                'order' => $order
            ]);
    }

    /**
     * @param Request $request
     * @param $order_no
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $order_no) {
        $status = '';

        return redirect()
            ->route('admin.orders.single', ['order_no' => $order_no])
            ->with([
                'status' => $status
            ]);
    }


    public function approve(Request $request) {
        $order = Order::where('order_no', '=', $request->order_no)
            ->where('order_progress', '=', 'pending')
            ->first();
        if(!$order) {
            return redirect()->back();
        }
        $this->authorize('approve-order', $order);

        $log = makeNewLog([
            'type'          => 'Order Approved',
            'author_type'   => auth('admin')->user()->role->ar_title,
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'time'          => Carbon::now()
        ], $order->order_log, true);

        $order->order_progress = 'processing';
        $order->order_log = $log;

        $secret = mt_rand(111111, 999999);

        $order->order_secret = Hash::make($secret);

        $order->save();

        if($order->client) {
            $order->client->notify(new OrderConfirmed($order->order_no, $secret));
        }
        if($order->byFranchise) {
            $order->byFranchise->notify(new OrderConfirmed($order->order_no, $secret));
        }

        return redirect()->back()
            ->with([
                'status' => 'Order Approved..!'
            ]);
    }

    public function process(Request $request) {  // set to on delivery
        $order = Order::where('order_no', '=', $request->order_no)
            ->where('order_progress', '=', 'processing')
            ->first();
        if(!$order) {
            return redirect()->back();
        }
        $this->authorize('process-order', $order);

        if(!auth('admin')->user()->isFranchise() && !$order->byFranchise) {
            $request->validate([
                'order_shipper_id' => 'numeric|required'
            ]);
            $order->order_shipper_id = $request->post('order_shipper_id');
        }

        $log = makeNewLog([
            'type'          => 'Queued Order for Delivery',
            'author_type'   => auth('admin')->user()->role->ar_title,
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'time'          => Carbon::now()
        ], $order->order_log, true);
        $order->order_progress = 'on delivery';

        $order->order_log = $log;

        $order->save();

        if($order->byFranchise) {
            return redirect()->route('admin.orders.by-franchise')
                ->with([
                    'status' => 'Order Queued Order for Delivery'
                ]);
        }

        return redirect()->route('admin.orders.confirmed')
            ->with([
                'status' => 'Order Queued Order for Delivery'
            ]);
    }

    public function deliver(Request $request) {
        $order = Order::where('order_no', '=', $request->post('order_no'))
            ->where('order_progress', '=', 'on delivery')
            ->first();
        if(!$order) {
            return redirect()->back();
        }
        $this->authorize('deliver-order', $order);

        if(!Hash::check($request->post('auth_code'), $order->order_secret)) {
            return redirect()->back()->withInput()->withErrors(['auth_code' => ['Secret pin not matched!']]);
        }

        $log = makeNewLog([
            'type'          => 'Order Delivered',
            'author_type'   => auth('admin')->user()->role->ar_title,
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'time'          => Carbon::now()
        ], $order->order_log, true);

        $order->order_progress = 'delivered';
        $order->order_secret = null;
        $order->order_log = $log;

        if($order->order_payment_status == 'due' || $order->order_payment_status == 'Due') {
            $order->order_payment_status = 'paid';
        }
        $order->save();

        if($order->client) {
            $order->client->notify(new OrderDelivered($order->order_no));
            if($order->forFranchise) {
                $this->subtractFromFranchise($order);
            }
            else {
                $this->subtractProducts($order);
            }
        }
        if($order->byFranchise) {
            $this->storeForFranchise($order);
            $this->subtractProducts($order);
            $order->byFranchise->notify(new OrderDelivered($order->order_no));
        }

        return redirect()->back();
    }

    public function cancel(Request $request) {
        $order = Order::where('order_no', '=', $request->order_no)
            ->whereIn('order_progress', ['pending', 'processing', 'on delivery'])
            ->first();
        if(!$order) {
            return redirect()->back();
        }
        $this->authorize('cancel-order', $order);

        $log = makeNewLog([
            'type'          => 'Order Canceled',
            'author_type'   => auth('admin')->user()->role->ar_title,
            'author_id'     => auth('admin')->id(),
            'author_name'   => auth('admin')->user()->name,
            'time'          => Carbon::now()
        ], $order->order_log, true);

        $order->order_progress = 'canceled';
        $order->order_log = $log;

        $order->save();

        return redirect()->back();
    }

    public function delete(Request $request) {
        $order = Order::where('order_no', '=', $request->order_no)->first();
        if(!$order) {
            return redirect()->back();
        }
        $this->authorize('delete-order', $order);

        $order->orderDetails()->delete();

        if($order->delete()) {
            return redirect()->route('admin.orders')
                ->with([
                    'status' => 'Order Deleted..!'
                ]);
        }
        return redirect()->back();
    }

    /**
     * @param Order|Model|Builder $order
     * @return void
     */
    protected function storeForFranchise(Order $order) {
        foreach ($order->orderDetails as $product) {
            $franchiseStore = FranchiseStore::whereFsProductId($product->od_product_id)
                ->where('fs_admin_id', '=', $order->byFranchise->id)
                ->first();
            if(!$franchiseStore) {
                $franchiseStore = new FranchiseStore();

                $franchiseStore->fs_admin_id = $order->byFranchise->id;
                $franchiseStore->fs_product_id = $product->od_product_id;
                $franchiseStore->fs_stock = $product->od_product_quantity;

                if($product->od_product_size) {
                    $sizes = [];
                    array_push($sizes, $product->od_product_size);
                    $franchiseStore->fs_sizes = $sizes;
                }
                if($product->od_product_color) {
                    $colors = [];
                    array_push($colors, $product->od_product_color);
                    $franchiseStore->fs_colors = $colors;
                }
            } else {
                $franchiseStore->fs_stock += $product->od_product_quantity;
                if($franchiseStore->fs_sizes && $product->od_product_size) {
                    $sizes = $franchiseStore->fs_sizes;
                    array_push($sizes, $product->od_product_size);
                    $franchiseStore->fs_sizes = array_unique($sizes);
                }
                if($franchiseStore->fs_colors && $product->od_product_color) {
                    $colors = $franchiseStore->fs_colors;
                    array_push($colors, $product->od_product_color);
                    $franchiseStore->fs_colors = array_unique($colors);
                }
            }
            $franchiseStore->save();
        }
    }

    /**
     * @param Order|Model|Builder $order
     * @return void
     */
    protected function subtractFromFranchise(Order $order) {
        foreach ($order->orderDetails as $product) {
            $franchiseStore = FranchiseStore::whereFsProductId($product->od_product_id)
                ->where('fs_admin_id', '=', $order->forFranchise->id)
                ->first();
            $franchiseStore->fs_stock -= $product->od_product_quantity;
            $franchiseStore->save();
        }
    }

    /**
     * @param Order|Model|Builder $order
     * @return void
     */
    protected function subtractProducts(Order $order) {
        foreach ($order->orderDetails as $detail) {
            $product = Product::find($detail->od_product_id);
            if($product->product_unit_subtract_on_order) {
                $product->product_units_in_stock -= $detail->od_product_quantity;
                $product->save();
            }
        }
    }

}
