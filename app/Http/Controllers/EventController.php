<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreeventRequest;
use App\Http\Requests\UpdateeventRequest;
use App\Models\event;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = event::withTrashed()->get();
    
        return view('eventi.index', compact('events'));
    }

    public function create()
    {
        return view('eventi.create');
    }

    public function store(StoreeventRequest $request)
    {
        $data = $request->validated();
         
        $data['slug'] = Str::slug($data['title']);

        $event = Event::create($data);

        return redirect()->route('events.show', $event);
    }

    public function restore($slug)
    {
        $event = Event::withTrashed()->where('slug', $slug)->first();
    
        if ($event->trashed()) {
            $event->restore();
        }
        return back();
    }

    public function show(event $event)
    {
        return view('eventi.show', compact('event'));
    }

    public function edit(event $event)
    {
        return view('eventi.edit', compact('event'));
    }

    public function update(UpdateeventRequest $request, event $event)
    {
        $data = $request->validated();

        if ($data['title'] !== $event->title) {
            $data['slug'] = Str::slug($data['title']);
        }
        $event->update($data);

        return redirect()->route('events.show', $event);
    }

    public function destroy(event $event)
    {
        $event->delete();

        return redirect()->route('events.index');
    }
}

