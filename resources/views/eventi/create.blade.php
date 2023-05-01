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
                            <label for="category-id" class="form-label">Titolo</label>
                            <select class="form-select @error('category_id') is invalid @enderror" id="category-id" name="category_id" aria-label="Default select example">
                                <option selected>Seleziona una categoria</option>
                                @foreach ($categories as $category)
                                      <option @selected(old('category_id') == $category->id ) value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>  
                              {{-- <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" value="{{old('title')}}" id="title" aria-describedby="titleHelp"> --}}
                              @error('category_id')                   
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