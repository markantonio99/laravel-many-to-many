@extends('layouts.app')

@section('content')
    <div class=container>
        <div class="d-flex align-items-center">
            <h1 class="me-auto">Tutti i tuoi Eventi</h1>
            <div>
                <a class="btn btn-sm btn-primary" href="{{ route('events.create') }}">Aggiungi nuovo Evento</a>
            </div>
        </div>
    </div>

    <div class="container">
         <table class="table table-striped table-inverse table-responsive">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Title</th>
                          <th>Slug</th>
                          {{-- <th>Data evento</th> --}}
                          <th>Location</th>
                          <th>Data creazione evento</th>
                          <th>Data della modifica evento</th>
                          <th>Eliminato</th> 
                      </tr>
                  </thead>
                 <tbody>
                    @forelse ($events as $event)
                          
                           <tr>
                              <th>{{$event->id}}</th>
                              <th>
                                <a href="{{ route('events.show',$event) }}">{{$event->title}}</a>
                            </th>
                              <th>{{$event->slug}}</th>
                              <th>{{$event->location}}</th>
                              <th>{{$event->created_at}}</th>
                              <th>{{$event->updated_at}}</th>
                              <th>{{$event->deleted_at ? $event->deleted_at : '' }}</th>                
                                      <th>
                                        <div class="d-flex">
                                           <a class="btn btn-sm btn-secondary" href="{{ route('events.edit', $event) }}">Modifica</a>
                                           <form action="{{route('events.destroy', $event) }}" method="POST">
                                               @csrf
                                               @method('DELETE')
                                               <input class="btn btn-sm btn-danger" type="submit" value="Elimina">
                                           </form>
                                           @if($event->trashed())
                                           <form action="{{route('events.restore', $event->slug) }}" method="POST">
                                            @csrf
                                                    <input class="btn btn-sm btn-success" type="submit" value="Ripristina">
                                               </form>
                                           @endif
                                        </div>
                              </th>  
                           </tr>
                        
                    @empty
                        <tr>
                            <th colspan="7">Nesun Evento Trovato</th>
                        </tr>
                    @endforelse
                 </tbody>
         </table>
    </div>
@endsection


