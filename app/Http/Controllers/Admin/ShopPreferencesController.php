<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryLocation;

class ShopPreferencesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['admin', 'checkSA', 'auth:admin']);
        $this->middleware('can:manage-preferences');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function locations() {
        return view('admin.shop-preferences.locations')
            ->with([
                'summary'   => $this->locationSummary()
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deliverySchedules() {
        return view('admin.shop-preferences.schedules')
            ->with([
                'summary'   => $this->locationSummary()
            ]);
    }

    /**
     * @return \stdClass
     */
    protected function locationSummary() {
        $summary = new \stdClass();

        $summary->countries = DeliveryLocation::where('location_type', '=', 'country')
            ->count();
        $summary->states = DeliveryLocation::where('location_type', '=', 'state')
            ->count();
        $summary->cities = DeliveryLocation::where('location_type', '=', 'city')
            ->count();
        $summary->thanas = DeliveryLocation::where('location_type', '=', 'thana')
            ->count();
        $summary->areas = DeliveryLocation::where('location_type', '=', 'area')
            ->count();
        $summary->selected = DeliveryLocation::where('location_selected', '=', 1)
            ->count();

        return $summary;
    }

}
