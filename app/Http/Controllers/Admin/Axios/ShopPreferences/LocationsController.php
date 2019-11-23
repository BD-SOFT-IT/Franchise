<?php

namespace App\Http\Controllers\Admin\Axios\ShopPreferences;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DeliveryLocation;
use App\Models\DeliverySchedule;

class LocationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['admin', 'auth:admin']);
        $this->middleware('can:manage-preferences')->except('delete');
        $this->middleware('can:delete-preferences')->only('delete');
    }

    public function index() {
        $countries = DeliveryLocation::where('location_type', '=', 'country')
            ->orderBy('location_name')
            ->get();
        $states = DeliveryLocation::where('location_type', '=', 'state')
            ->orderBy('location_name')
            ->get();
        $cities = DeliveryLocation::where('location_type', '=', 'city')
            ->orderBy('location_name')
            ->get();
        $areas = DeliveryLocation::where('location_type', '=', 'area')
            ->orderBy('location_name')
            ->get();
        $selected = DeliveryLocation::where('location_selected', '=', 1)
            ->orderBy('location_name')
            ->get();

        return response()
            ->json([
                'countries' => $countries,
                'states'    => $states,
                'cities'    => $cities,
                'areas'     => $areas,
                'selected'  => $selected
            ], 200);
    }

    public function storeLocation(Request $request) {
        // validate request
        $this->validateRequest($request);

        $location_exists = DeliveryLocation::where('location_name', '=', $request->post('location_name'))
            ->where('location_parent', '=', $request->post('location_parent'))
            ->where('location_type', '=', $request->post('location_type'))
            ->first();

        if($location_exists) {
            return response()->json([
                'code'      => 422,
                'message'   => 'validation_error',
                'errors'    => [
                    'name' => ['This location is already exists!']
                ]
            ], 422);
        }

        $log = makeNewLog([
            'content'     => 'Schedule Created',
            'author_id'   => auth('admin')->id(),
            'author_name' => auth('admin')->user()->name,
            'time'        => Carbon::now()->format('jS M Y, h:i A')
        ], null, true);

        $location = new DeliveryLocation;

        $location->location_admin_id = auth('admin')->id();
        $location->location_type = $request->post('location_type');
        $location->location_name = $request->post('location_name');
        $location->location_name_bengali = $request->post('location_name_bengali');
        $location->location_parent = $request->post('location_parent');
        $location->location_selected = $request->post('location_selected');
        $location->location_log = $log;

        if(!$location->save()) {
            sendServerErrorJsonResponse();
        }

        $location->schedules()->attach($request->post('location_delivery_schedules'));

        return response()->json('added', 200);
    }

    public function editLocation($id) {
        $location = DeliveryLocation::find($id);
        if(!$location) {
            sendNotFoundJsonResponse('Location Not Found');
        }

        $output_location = new \stdClass();
        $output_location->type    = $location->location_type;
        $output_location->country = ($location->locationCountry())? $location->locationCountry()->location_id : '';
        $output_location->state   = ($location->locationState())? $location->locationState()->location_id : '';
        $output_location->city    = ($location->locationCity())? $location->locationCity()->location_id : '';
        $output_location->name    = $location->location_name;
        $output_location->bengali = $location->location_name_bengali;
        $output_location->selected = ($location->location_selected) ? true : false;
        $output_location->schedules    = $location->schedules->getQueueableIds();

        return response()->json($output_location, 200);
    }

    public function updateLocation(Request $request, $id) {
        $location = DeliveryLocation::find($id);
        if(!$location) {
            sendNotFoundJsonResponse('Location not found..!');
        }
        // validate request
        $this->validateRequest($request);

        if($request->post('location_name') != $location->location_name) {
            $location_exists = DeliveryLocation::where('location_name', '=', $request->post('location_name'))
                ->where('location_parent', '=', $request->post('location_parent'))
                ->where('location_type', '=', $request->post('location_type'))
                ->first();
            if($location_exists) {
                return response()->json([
                    'code'      => 422,
                    'message'   => 'validation_error',
                    'errors'    => [
                        'name' => ['This location is already exists!']
                    ]
                ], 422);
            }
        }

        $log = makeNewLog([
            'content'     => 'Schedule Updated',
            'author_id'   => auth('admin')->id(),
            'author_name' => auth('admin')->user()->name,
            'time'        => Carbon::now()->format('jS M Y, h:i A')
        ], $location->location_log, true);

        $location->location_type = $request->post('location_type');
        $location->location_name = $request->post('location_name');
        $location->location_name_bengali = $request->post('location_name_bengali');
        $location->location_parent = $request->post('location_parent');
        $location->location_selected = $request->post('location_selected');
        $location->location_log = $log;

        if(!$location->save()) {
            sendServerErrorJsonResponse();
        }

        $location->schedules()->sync($request->post('location_delivery_schedules'));

        return response()->json('updated', 200);
    }

    public function delete($id) {
        $location = DeliveryLocation::find($id);
        if(!$location) {
            sendNotFoundJsonResponse('Location not found..!');
        }

        $delete_ids = [ $id ];
        switch ($location->location_type) {
            case 'country':
                $states = $this->getChildLocationIds('state', $id);
                if($states) {
                    $delete_ids = array_merge($delete_ids, $states);
                    foreach($states as $state) {
                        $cities = $this->getChildLocationIds('city', $state);
                        if($cities) {
                            $delete_ids = array_merge($delete_ids, $cities);
                            foreach($cities as $city) {
                                $areas = $this->getChildLocationIds('area', $city);
                                if($areas) {
                                    $delete_ids = array_merge($delete_ids, $areas);
                                }
                            }
                        }
                    }
                }
                break;
            case 'state':
                $cities = $this->getChildLocationIds('city', $id);
                if($cities) {
                    $delete_ids = array_merge($delete_ids, $cities);
                    foreach($cities as $city) {
                        $areas = $this->getChildLocationIds('area', $city);
                        if($areas) {
                            $delete_ids = array_merge($delete_ids, $areas);
                        }
                    }
                }
                break;
            case 'city':
                $areas = $this->getChildLocationIds('area', $id);
                if($areas) {
                    $delete_ids = array_merge($delete_ids, $areas);
                }
                break;
            default:
                break;
        }

        foreach($delete_ids as $item) {
            DeliveryLocation::find($item)->schedules()->detach();
        }
        DeliveryLocation::destroy($delete_ids);

        return response()->json('deleted', 200);
    }

    public function viewLocation($id) {
        $location = DeliveryLocation::find($id);
        if(!$location) {
            sendNotFoundJsonResponse('Location not found..!');
        }

        $delivery_schedules = $location->schedules;
        $schedules = [];
        if($delivery_schedules && count($delivery_schedules) > 0) {
            foreach($delivery_schedules as $schedule) {
                $output = new \stdClass();

                $output->id = $schedule->schedule_id;
                $output->expected_time = ($schedule->schedule_expected_time_from != null) ?
                    Carbon::createFromTimeString($schedule->schedule_expected_time_from)->format('h:i A') . ' - ' .
                    Carbon::createFromTimeString($schedule->schedule_expected_time_to)->format('h:i A') : 'N/A';
                $output->expected_hour = ($schedule->schedule_expected_hour_from != null) ?
                    $schedule->schedule_expected_hour_from . ' Hours - ' . $schedule->schedule_expected_hour_to . ' Hours' : 'N/A';

                array_push($schedules, $output);
            }
        } else {
            $schedules = null;
        }

        return response()->json([
            'location_type'         => $location->location_type,
            'location_name'         => $location->location_name,
            'location_name_bengali' => $location->location_name_bengali,
            'location_log'          => $location->getLog(),
            'location_country'      => ($location->locationCountry()) ? $location->locationCountry()->location_name : null,
            'location_state'        => ($location->locationState()) ? $location->locationState()->location_name : null,
            'location_city'         => ($location->locationCity()) ? $location->locationCity()->location_name : null,
            'location_author'       => $location->author->name,
            'location_schedules'    => $schedules
        ], 200);

    }

    public function schedulesForLocation() {
        $delivery_schedules = DeliverySchedule::orderBy('schedule_expected_time_from')
            ->get();

        $schedules = [];

        foreach($delivery_schedules as $schedule) {
            $output = new \stdClass();

            $output->id = $schedule->schedule_id;
            $output->expected_time = ($schedule->schedule_expected_time_from != null) ?
                Carbon::createFromTimeString($schedule->schedule_expected_time_from)->format('h:i A') . ' - ' .
                Carbon::createFromTimeString($schedule->schedule_expected_time_to)->format('h:i A') : 'N/A';
            $output->expected_hour = ($schedule->schedule_expected_hour_from != null) ?
                $schedule->schedule_expected_hour_from . ' Hours - ' . $schedule->schedule_expected_hour_to . ' Hours' : 'N/A';

            array_push($schedules, $output);
        }

        return response()
            ->json($schedules, 200);
    }

    protected function validateRequest(Request $request) {
        return $this->validate($request, [
            'location_type'               => 'required|alpha',
            'location_name'               => 'required|string|min:3|max:150',
            'location_name_bengali'       => 'required|string|min:3|max:150',
            'location_parent'             => 'required|numeric',
            'location_selected'           => 'required|boolean',
            'location_delivery_schedules' => 'nullable|array'
        ]);
    }

    /**
     * @param $type
     * @param $parent
     * @return array|null
     */
    protected function getChildLocationIds($type, $parent) {
        $location_ids = DeliveryLocation::where('location_parent', '=', $parent)
            ->where('location_type', '=', $type)
            ->pluck('location_id')->toArray();

        return ($location_ids && count($location_ids) > 0) ? $location_ids : null;
    }

}
