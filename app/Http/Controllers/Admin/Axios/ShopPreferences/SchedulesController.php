<?php

namespace App\Http\Controllers\Admin\Axios\ShopPreferences;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DeliverySchedule;

class SchedulesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['admin', 'auth:admin']);
        $this->middleware('can:manage-preferences')->except(['show', 'delete']);
        $this->middleware('can:delete-preferences')->only(['show', 'delete']);
    }

    public function index(Request $request) {
        $per_page = ($request->get('per_page'))? $request->get('per_page') : 15;

        $schedules = DeliverySchedule::paginate($per_page);

        return response()
            ->json($schedules, 200);
    }

    public function store(Request $request) {
        $this->validateRequest($request);

        $schedule = new DeliverySchedule;

        $log = makeNewLog([
            'content'     => 'Schedule Created',
            'author_id'   => auth('admin')->id(),
            'author_name' => auth('admin')->user()->name,
            'time'        => Carbon::now()->format('jS M Y, h:i A')
        ], null, true);

        if($request->post('schedule_expected_time_from') == null || $request->post('schedule_expected_time_to') == null) {
            $timeRangeBengali = null;
        }
        else {
            $timeRangeBengali = convertToBengaliDateTime(date('d-m-Y') . $request->post('schedule_expected_time_from'), 'b hঃi');
            $timeRangeBengali .= ' - ';
            $timeRangeBengali .= convertToBengaliDateTime(date('d-m-Y') . $request->post('schedule_expected_time_to'), 'b hঃi');
        }

        $schedule->schedule_expected_time_from = $request->post('schedule_expected_time_from');
        $schedule->schedule_expected_time_to = $request->post('schedule_expected_time_to');
        $schedule->schedule_time_range_bengali = $timeRangeBengali;
        $schedule->schedule_expected_hour_from = $request->post('schedule_expected_hour_from');
        $schedule->schedule_expected_hour_to = $request->post('schedule_expected_hour_to');
        $schedule->schedule_log = $log;

        if(!$schedule->save()) {
            sendServerErrorJsonResponse();
        }
        return response()->json('Schedule Created Successfully.!', 200);
    }

    public function update(Request $request, $id) {
        $schedule = DeliverySchedule::find($id);
        if(!$schedule) {
            sendNotFoundJsonResponse('Oops..! Requested Schedule Not Found.');
        }
        $this->validateRequest($request);

        $log = makeNewLog([
            'content'     => 'Schedule Updated',
            'author_id'   => auth('admin')->id(),
            'author_name' => auth('admin')->user()->name,
            'time'        => Carbon::now()->format('jS M Y, h:i A')
        ], $schedule->schedule_log, true);

        if($request->post('schedule_expected_time_from') == null || $request->post('schedule_expected_time_to') == null) {
            $timeRangeBengali = null;
        }
        else {
            $timeRangeBengali = convertToBengaliDateTime(date('d-m-Y') . $request->post('schedule_expected_time_from'), 'b hঃi');
            $timeRangeBengali .= ' - ';
            $timeRangeBengali .= convertToBengaliDateTime(date('d-m-Y') . $request->post('schedule_expected_time_to'), 'b hঃi');
        }

        $schedule->schedule_expected_time_from = $request->post('schedule_expected_time_from');
        $schedule->schedule_expected_time_to = $request->post('schedule_expected_time_to');
        $schedule->schedule_time_range_bengali = $timeRangeBengali;
        $schedule->schedule_expected_hour_from = $request->post('schedule_expected_hour_from');
        $schedule->schedule_expected_hour_to = $request->post('schedule_expected_hour_to');
        $schedule->schedule_log = $log;

        if(!$schedule->save()) {
            sendServerErrorJsonResponse();
        }
        return response()->json('Schedule Updated Successfully.!', 200);
    }

    public function show($id) {
        $schedule = DeliverySchedule::find($id);
        if(!$schedule) {
            sendNotFoundJsonResponse('Oops..! Requested Schedule Not Found.');
        }

        $output = new \stdClass();

        $output->schedule_id = $schedule->schedule_id;
        $output->schedule_expected_time_from = $schedule->schedule_expected_time_from;
        $output->schedule_expected_time_to = $schedule->schedule_expected_time_to;
        $output->schedule_time_range_bengali = $schedule->schedule_time_range_bengali;
        $output->schedule_expected_hour_from = $schedule->schedule_expected_hour_from;
        $output->schedule_expected_hour_to = $schedule->schedule_expected_hour_to;
        $output->schedule_log = convertStringToArray($schedule->schedule_log, true);

        return response()
            ->json($output, 200);
    }

    public function delete($id) {
        $schedule = DeliverySchedule::find($id);
        if(!$schedule) {
            sendNotFoundJsonResponse('Oops..! Requested Schedule Not Found.');
        }
        if(!$schedule->delete()) {
            sendServerErrorJsonResponse();
        }
        return response()
            ->json('Successfully Deleted..!', 200);
    }

    protected function validateRequest(Request $request) {
        $rules = [
            'schedule_expected_time_from'   => 'nullable|date_format:"H:i:s"',
            'schedule_expected_time_to'     => 'nullable|date_format:"H:i:s"|after:schedule_expected_time_from',
            'schedule_expected_hour_from'   => 'nullable|numeric',
            'schedule_expected_hour_to'     => 'nullable|numeric|gt:schedule_expected_hour_from'
        ];
        $messages = [
            'schedule_expected_hour_to.gt' => 'Expected Hour To must be greater than Expected Hour From'
        ];

        $rules['schedule_expected_time_from'] = ($request->post('schedule_expected_time_to') == null) ? 'nullable|date_format:"H:i:s"' : 'required|date_format:"H:i:s"';

        $rules['schedule_expected_time_to'] = ($request->post('schedule_expected_time_from') == null) ?
            'nullable|date_format:"H:i:s"|after:schedule_expected_time_from' : 'required|date_format:"H:i:s"|after:schedule_expected_time_from';

        $rules['schedule_expected_hour_from'] = ($request->post('schedule_expected_hour_to') == null) ? 'nullable|numeric' : 'required|numeric';

        $rules['schedule_expected_hour_to'] = ($request->post('schedule_expected_hour_from') == null) ?
            'nullable|numeric|gt:schedule_expected_hour_from' : 'required|numeric|gt:schedule_expected_hour_from';

        if($request->post('schedule_expected_time_from') == null && $request->post('schedule_expected_time_to') == null) {
            $rules['schedule_expected_hour_from'] = 'required|numeric';
            $rules['schedule_expected_hour_to'] = 'required|numeric|gt:schedule_expected_hour_from';
        }
        if($request->post('schedule_expected_hour_from') == null && $request->post('schedule_expected_hour_to') == null) {
            $rules['schedule_expected_time_from'] = 'required|date_format:"H:i:s"';
            $rules['schedule_expected_time_to'] = 'required|date_format:"H:i:s"|after:schedule_expected_time_from';
        }

        return $this->validate($request, $rules, $messages);
    }

}
