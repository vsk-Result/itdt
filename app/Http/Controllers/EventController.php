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

    public function create()
    {
        return view('calendar.events.create')->render();
    }

    public function store(Request $request)
    {
        $this->events->store($request);
        return redirect()->back();
    }

    public function update(Request $request)
	{
        $event = $this->events->update($request);
	    if ($request->ajax()) {
            return Response::json(compact('event'));
        }
        return redirect()->back();
	}

    public function show(Request $request)
	{
		$event = $this->events->find($request->id);
		return view('calendar.events.show', compact('event'))->render();
	}

    public function edit(Request $request)
    {
        $event = $this->events->find($request->id);
		return view('calendar.events.edit', compact('event'))->render();
    }

    public function status(Request $request)
    {
        $event = $this->events->status($request);
        return Response::json(compact('event'));
    }

    public function destroy(Request $request)
    {
        $this->events->destroy($request->id);
    }
}
