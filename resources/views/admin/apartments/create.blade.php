@extends('layouts.app')

@section('content')
{{-- @dd($categories, $services) --}}
<div class="container ">
    <h1 class="text-center">Creazione dell'appartamento</h1>
    <form method="POST" action="{{route('admin.apartments.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="input-name">Titolo dell' annuncio:</label>
            <input type="text" name="name" class="form-control" id="input-name"
                placeholder="Inserisci qui il titolo dell'annuncio...">
            <small id="input-name-help" class="form-text text-muted">Max n caratteri</small>
        </div>
        {{-- select: category_id --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="category_id">Categoria</label>
            </div>
            <select name="category_id" class="custom-select" id="category_id">
                <option selected disabled> -- seleziona categoria -- </option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group ">
            {{-- Number: Numero Stanze --}}
            <div class="row pb-2 ">
                <div class="col">
                    <label for="input-rooms">Stanze</label>
                    <input type="number" name="rooms" class="form-control" id="input-rooms" min="1" step="1"
                        placeholder="Inserisci il numero delle stanze...">
                </div>
                {{-- Number: Numero Letti --}}
                <div class="col">
                    <label for="input-beds">Letti</label>
                    <input type="number" name="beds" class="form-control" id="input-beds" min="1" step="1"
                        placeholder="Inserisci il numero dei letti...">
                </div>

            </div>
            <div class="row pt-2">
                <div class="col">
                    <label for="input-bathrooms">Bagni</label>
                    <input type="number" name="bathrooms" class="form-control" id="input-bathrooms" min="1" step="1"
                        placeholder="Inserisci il numero dei bagni...">
                </div>
                {{-- Number: Dimensione --}}
                <div class="col">
                    <label for="input-size">Dimensioni in m2</label>
                    <input type="number" name="size" class="form-control" id="input-size" min="1" step="1"
                        placeholder="Immetti la dimensione...">
                </div>

            </div>
            {{-- Number: Numero Bagni --}}

        </div>
        {{-- Textarea: Descrizione appartamento --}}
        <div class="form-group">
            <label for="description">Descrizione del locale:</label>
            <textarea name="description" class="form-control" id="description" rows="5">
                Inserisci descrizione dell' appartamento...
            </textarea>
        </div>
        {{-- checkbbox: group servizi --}}
        <div class="row mx-0 justify-content-between" id="servizi">
            @foreach ($services as $service)
            <div class="custom-control custom-checkbox col-6 col-md-4 col-lg-2 ">
                <input type="checkbox" class="custom-control-input" name="services[]" value="{{$service->id}}"
                    id="{{$service->id}}">
                <label class="custom-control-label" for="customCheck1">{{$service->name}}</label>
            </div>
            @endforeach
        </div>

        {{-- Input Text: full_address --}}
        <div class="form-group py-3">
            <label for="input-address">Indirizzo completo:</label>
            <input type="text" name="full_address" class="form-control" id="input-address"
                placeholder="Inserisci qui l' indirizzo del locale...">
        </div>
        {{-- input file immagine --}}
        <label for="input-image">Scegli l'immagine di copertina del tuo annuncio:</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">

                <span class="input-group-text">Immagine</span>
            </div>
            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="input-image">
                <label class="custom-file-label" for="input-image">Scegli un file...</label>
            </div>
        </div>
        {{-- check-box: is_visible --}}
        <div class="form-check py-3">
            <input type="checkbox" name="is_visible" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Pubblica</label>
        </div>



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



</div>
@endsection