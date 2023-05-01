<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreeventRequest;
use App\Http\Requests\UpdateeventRequest;
use App\Models\event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $trashed = $request->input('trashed');
        
        if($trashed) {
            $events = Event::onlyTrashed()->get();
        } else{
            $events = Event::all();
        }
        
        $num_of_trashed = Event::onlyTrashed()->count();
        

        return view('eventi.index', compact('events', 'num_of_trashed'));
    }
    

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('eventi.create', compact('categories'));
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

            request()->session()->flash('message', "L'Evento è stato ripristinato" );
        }
        return back();
    }

    public function show(event $event)
    {
        $event->load('category');
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
       if($event->trashed()){
            $event->forceDelete();  //eliminizaione definitiva
       } else{
        $event->delete(); //eliminizione soft
       }

        return back();
    }
}

