<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexCalendarRequest;
use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use App\Http\Resources\V1\CalendarResource;
use App\Models\Calendar;
use App\Models\User;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexCalendarRequest $request)
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
    public function store(StoreCalendarRequest $request)
    {
        $barerToken = $request->bearerToken();

        $token = User::where('remember_token', $barerToken)->first();

        $data = $request->validated();

        if (!$token && isset($data['duration'])) {

            $get_dates = Calendar::all(['duration']);

            $times = explode('-', $data['duration']);

            foreach ($get_dates as $get_date) {

                $get_times = explode('-', $get_date->duration);

                if (Service::checkExistsTimeCalendar($times, $get_times)) {
                    return response(['massage' => 'This duration time is already taken!']);
                }
            }
                return new CalendarResource(Calendar::create($data));

        } else {
            return new CalendarResource(Calendar::create($data));
        }
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
