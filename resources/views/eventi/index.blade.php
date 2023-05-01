@extends('layouts.app')

@section('content')
    @if(request()->session()->exists('message'))
            <div class="alert fixed alert-primary" role="alert">
                {{request()->session()->pull('message')}}
            </div>
    @endif

    
    <div class=container>
        <div class="d-flex align-items-center">
            <h1 class="me-auto">Tutti i tuoi Eventi</h1>
             
     
            <div>
                @if(request('trashed'))
                <a class="btn btn-sm btn-light" href="{{ route('events.index') }}">Tutti gli eventi</a>
                @else 
                <a class="btn btn-sm btn-light" href="{{ route('events.index', ['trashed' => true]) }}">Eliminati {{ $num_of_trashed }}</a>
                @endif
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
                          <th>Categoria</th>
                          {{-- <th>Data evento</th> --}}
                          <th>Location</th>
                          <th>Pubblicato:</th>
                          <th>Aggiornato:</th>
                      </tr>
                  </thead>
                 <tbody>
                    @forelse ($events as $event)
                          
                           <tr>
                              <th>{{$event->id}}</th>
                              <th>
                                <a href="{{ route('events.show',$event) }}">{{$event->title}}</a>
                            </th>
                              <th> {{$event->category ? $event->category->name : 'Nessuna categoria'}}</th>
                              <th>{{$event->location}}</th>
                              <th>{{$event->created_at->format('d/m/y')}}</th>
                              <th>{{$event->updated_at->format('d/m/y')}}</th>
                              <th>{{$event->deleted_at ? $event->deleted_at->format('d/m/y') : '' }}</th>                
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


