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

    static public function checkExistsTimeCalendar($source_time, $db_time)
    {
        $t1 = explode(':', $source_time[0]);
        $t2 = explode(':', $source_time[1]);

        $time_diff = Carbon::parse($t1[0] . ':' . $t1[1] . ':00')->diffInMinutes($t2[0] . ':' . $t2[1] . ':00');

        $min = 0;
        while ($min <= $time_diff) {

            $add_minute = Carbon::parse($t1[0] . ':' . $t1[1] . ':00')->addMinute($min)->format('H:i');

            if ($db_time[0] <= $add_minute && $add_minute <= $db_time[1]) return true;

            $min++;
        }
    }
}
