<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use App\Http\Resources\V1\CalendarResource;
use App\Models\Calendar;
use App\Models\User;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $calendar_dates = Calendar::where('date', '>=' ,$data['date_start'])
                                    ->where('date', '<=', $data['date_end'])
                                    ->get();

       return CalendarResource::collection($calendar_dates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCalendarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $user, StoreCalendarRequest $request)
    {
        $barerToken = $request->bearerToken();

        $token = User::where('remember_token', $barerToken)->first();

        $data = $request->validated();

        if(!$token && isset($data['duration'])) {
            return response(['massage' => 'Must be Authorized for set Duration time!']);
        }else{
            $calendar = Calendar::create($data);
        }

        return new CalendarResource($calendar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCalendarRequest  $request
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCalendarRequest $request, Calendar $calendar)
    {
        $time = Service::addHours($calendar);

        if($time['time_check'] >= $time['time_source']){
            return response(['massage' => 'Updates are possible 3 hours before of the duration specified!']);
        }else {

            $calendar->update($request->all());
        }

        return new CalendarResource($calendar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        $time = Service::addHours($calendar);

        if($time['time_check'] >= $time['time_source']){
            return response(['massage' => 'Delete are possible 3 hours before of the duration specified!']);
        }else {
            $calendar->delete();
            return response('', 204);
        }
    }


}
