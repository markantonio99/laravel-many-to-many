@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1>Nuovo Evento</h1>
        </div>
    </div>
    <div class="container">
        <form action="{{route('events.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" value="{{old('title')}}" id="title" aria-describedby="titleHelp">
                      @error('title')
                          <div class="invalid-feedback">
                              {{$message}}
                          </div>
                      @enderror
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"> {{old('description')}} </textarea> 
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>     
              <button type="submit" class="btn btn-primary">Pubblica</button>

        </form>
    </div>
@endsection