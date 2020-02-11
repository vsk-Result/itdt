<?php

namespace App\UseCases;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\Holiday;

class EventService
{
    public function all($request)
    {
      $start = Carbon::parse($request->start);
      $end = Carbon::parse($request->end);
      $array = [];

      $holidays = Holiday::get();
      foreach ($holidays as $key => $holiday) {
        if (Carbon::parse($request->start)->year === Carbon::parse($request->end)->year) {
          $date = Carbon::parse(substr($request->start, 0, 4) . substr($holiday->date, 4));
          $bar = substr($request->start, 0, 4) . substr($holiday->date, 4);
        } else {
          $date = Carbon::parse(substr($request->end, 0, 4) . substr($holiday->date, 4));
          $bar = substr($request->end, 0, 4) . substr($holiday->date, 4);
        }
        if ($date->between($start, $end)) {
          $foo =
          [
            'title' => $holiday->name,
            'start' => $bar,
            'className' => "bgm-red",
            'allDay' => true,
            'editable' => false,
            'order_id' => 1,
          ];

          $array[] = $foo;
        }
      }

      $events = Event::whereNull('deleted_at')->whereBetween('start_date', [$request->start, $request->end])->get();
      foreach ($events as $key => $event) {

      if ($event->confirmed !== null) {
        switch ($event->confirmed) {
          case 0:
            $color = 'bgm-orange';
            break;

          case 1:
            $color = 'bgm-green';
            break;
        }
      } else {
        $color = 'bgm-blue';
      }

        $foo =
        [
          'id' => $event->id,
          'title' => $event->title,
          'start' => $event->start_date,
          'end' => $event->end_date,
          'className' => $color,
          'order_id' => 2,
        ];

        $array[] = $foo;
      }
      return $array;
    }

    public function create($request)
    {
        $event = new Event();
        $event->employee_id = Auth()->User()->empl_id;
        $event->user_id = auth()->id();

        $event->title = $request->title;
        $event->description = $request->description;

        $start_date = Carbon::parse($request->start_date)->format('Y-m-d'). ' ' .Carbon::parse($request->start_time)->format('H:i:s');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d'). ' ' .Carbon::parse($request->end_time)->format('H:i:s');
        $event->start_date = $start_date;
        $event->end_date = $end_date;
        $event->save();
        return $event;
    }

    public function update($request)
  {
    if ($event = Event::find($request->id)) {
      if (!empty($request->title)) {
        $event->title = $request->title;
      }

      if (isset($request->description)) {
        $event->description = $request->description;
      }

      $start_date = Carbon::parse($request->start_date)->format('Y-m-d'). ' ' .Carbon::parse($request->start_time)->format('H:i:s');
      $end_date = Carbon::parse($request->end_date)->format('Y-m-d'). ' ' .Carbon::parse($request->end_time)->format('H:i:s');
      $event->start_date = $start_date;
      $event->end_date = $end_date;
      $event->update();
      return $event;
    }
  }

  public function read_one($id)
  {
    if ($event = Event::find($id)) {
      return $event;
    }
  }
}
