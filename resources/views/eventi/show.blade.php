@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center">
             <div class="me-auto">
               <h1> {{$event->title}}</h1>
               <p>{{$event->slug}}</p>
             </div>
             <div>
                <a class="btn btn-s btn-secondary" href="{{route('events.edit', $event)}}">Modifica</a>
             </div>
        </div>
    </div>
    <div class="container">
        <p>{{$event->description}}</p>
    </div>
@endsection