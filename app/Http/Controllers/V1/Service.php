<?php

namespace App\Http\Controllers\V1;

use Carbon\Carbon;

class Service
{
    static public function addHours($calendar)
    {
        $time_check = Carbon::parse(now('Europe/Kiev'))->addHours(3)->format('d.m.y H:i');

        $duration = explode('-',$calendar->duration);

        $time_source= $calendar->date.' '.$duration[0];

        return[
          'time_check' => $time_check,
          'time_source' => $time_source,
        ];

    }
}
