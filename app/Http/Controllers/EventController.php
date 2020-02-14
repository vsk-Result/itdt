<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Calendar;
use App\Models\Event;
use App\UseCases\EventService;

class EventController extends Controller
{
    protected $events;

	function __construct(EventService $events)
	{
		$this->events = $events;
	}

    public function index()
    {
        return view('calendar.index');
    }

    public function all(Request $request)
    {
        $events = $this->events->all($request);
        return Response::json(compact('events'));
    }

    public function create(Request $request)
    {
        if ($this->events->create($request)) {
			return redirect()->back();
		}
    }

    public function update(Request $request)
	{
		if ($event = $this->events->update($request)) {
			// kostil
			if (isset($request->title)) {
				return redirect()->back();
			}
			return Response::json(compact('event'));
		}
	}

    public function modal($id)
	{
		$event = $this->events->read_one($id);
		return view('calendar.event_show', compact('event'))->render();

	}

    public function edit($id)
    {
        $event = $this->events->read_one($id);
		return view('calendar.event_update', compact('event'))->render();
    }

    public function status(Request $request)
    	{
    		if ($event = $this->events->status($request)) {
    			return Response::json(compact('event'));
    		}
    	}
}
