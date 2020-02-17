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
        foreach ($holidays as $holiday) {
            if (Carbon::parse($request->start)->year === Carbon::parse($request->end)->year) {
                $bar = substr($request->start, 0, 4) . substr($holiday->date, 4);
            } else {
                $bar = substr($request->end, 0, 4) . substr($holiday->date, 4);
            }
            $date = Carbon::parse($bar);
            if ($date->between($start, $end)) {
                $foo = [
                    'title' => $holiday->name,
                    'start' => $bar,
                    'className' => "bg-info border-info",
                    'allDay' => true,
                    'editable' => false,
                    'order_id' => 1,
                ];
                $array[] = $foo;
            }
        }

        $events = Event::whereBetween('start_date', [$request->start, $request->end])->get();
        foreach ($events as $event) {

            switch ($event->confirmed) {
                case 0:
                    $color = 'bg-warning border-warning';
                    break;
                case 1:
                    $color = 'bg-success border-success';
                    break;
                default:
                    $color = 'bg-primary border-primary';
                    break;
            }

            $foo = [
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

    public function store($request)
    {
        $event = new Event();
        $event->employee_id = auth()->User()->employee_id;
        $event->user_id = auth()->id();

        $event->title = $request->title;
        $event->description = $request->description;

        $event->start_date = $this->formatDateTime($request->start_date, $request->start_time);
        $event->end_date = $this->formatDateTime($request->end_date, $request->end_time);
        $event->save();
        return $event;
    }

    public function update($request)
    {
        $event = $this->find($request->id);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $this->formatDateTime($request->start_date, $request->start_time);
        $event->end_date = $this->formatDateTime($request->end_date, $request->end_time);
        $event->update();
        return $event;
    }

    public function find($id)
    {
        return Event::findOrFail($id);
    }

    public function status($request)
    {
        $event = $this->find($request->id);
        $event->confirmed = $request->status_id;
        $event->update();

        return $event;
    }

    private function formatDateTime($date, $time)
    {
        return Carbon::parse($date)->format('Y-m-d'). ' ' .Carbon::parse($time)->format('H:i:s');
    }

    public function destroy($id)
    {
        $event = $this->find($id);
        $event->delete();
    }
}
