@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1>Modifica {{$event->title}}</h1>
        </div>
    </div>
    <div class="container">
        <form action="{{route('events.update', $event)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" value="{{old('title',$event->title)}}" id="title" aria-describedby="titleHelp">
                      @error('title')
                          <div class="invalid-feedback">
                              {{$message}}
                          </div>
                      @enderror
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"> {{old('description',$event->description)}} </textarea> 
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>     
              <button type="submit" class="btn btn-primary">Salva</button>

        </form>
    </div>
@endsection