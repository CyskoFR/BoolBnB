@extends('layouts.app')

@section('content')
{{-- @dd($categories, $services) --}}
<div class="container ">
    <h1 class="text-center">Creazione dell'appartamento</h1>
    <form method="POST" action="{{route('admin.apartments.store')}}" enctype="multipart/form-data">
        @csrf

        {{-- text input : titolo --}}
        <div class="form-group">
            <label for="input-name">Titolo dell' annuncio:</label>
            <input type="text" name="name" value=" {{ old('name') ? old('name') : $apartment->name }}"
                class=" form-control" id="input-name" placeholder="Inserisci qui il titolo dell'annuncio..."
                class="@error('name') is-invalid @enderror">
            <small id="input-name-help" class="form-text text-muted">Max 255 caratteri</small>
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- select: category_id --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="category_id">Categoria</label>
            </div>
            <select name="category_id" class=" custom-select @error('category_id') is-invalid @enderror"
                id="category_id">
                <option selected disabled> -- seleziona categoria -- </option>
                @foreach ($categories as $category)
                {{-- da fare old --}}
                <option value="{{$category->id}}" {{ old("category_id")==$category->id ? "selected" :""
                    }}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        @error('category_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group ">
            {{-- Number: Numero Stanze --}}
            <div class="row pb-2 ">
                <div class="col">
                    <label for="input-rooms">Stanze</label>
                    <input type="number" value="{{ old('rooms') ? old('rooms') : $apartment->rooms }}" name="rooms"
                        class="form-control @error('rooms') is-invalid @enderror" id="input-rooms" min="1" step="1"
                        placeholder="Inserisci il numero delle stanze...">
                    @error('rooms')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Number: Numero Letti --}}
                <div class="col">
                    <label for="input-beds">Letti</label>
                    <input type="number" value="{{ old('beds') ? old('beds') : $apartment->beds  }}" name="beds"
                        class="form-control @error('beds') is-invalid @enderror" id="input-beds" min="1" step="1"
                        placeholder="Inserisci il numero dei letti...">
                    @error('beds')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="row pt-2">
                <div class="col">
                    <label for="input-bathrooms">Bagni</label>
                    <input type="number" value="{{  old('bathrooms') ? old('bathrooms') : $apartment->bathrooms }}"
                        name="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror"
                        id="input-bathrooms" min="1" step="1" placeholder="Inserisci il numero dei bagni...">
                    @error('bathrooms')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Number: Dimensione --}}
                <div class="col">
                    <label for="input-size">Dimensioni in m2</label>
                    <input type="number" value="{{  old('size') ? old('size') : $apartment->size }}" name="size"
                        class="form-control @error('size') is-invalid @enderror" id="input-size" min="1" step="1"
                        placeholder="Immetti la dimensione...">
                    @error('size')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

        </div>
        {{-- Textarea: Descrizione appartamento --}}
        <div class="form-group">
            <label for="description">Descrizione del locale:</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                id="description"
                rows="5">{{ old('description') ? old('description') : $apartment->description}}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- <script>
            const message = "Inserisci descrizione dell' appartamento";
            const textarea = document.getElementById("description");
            textarea.addEventListener("click", () => {
                let customMessage = textarea.innerHTML;
                console.log(message , customMessage);
                if ((customMessage = message)) textarea.innerText = "";
                 textarea.innerHTML = customMessage;
            });
        </script> --}}

        {{-- checkbbox: group servizi --}}
        <div class="row mx-0 justify-content-between" id="servizi">
            @foreach ($services as $service)
            <div class="custom-control custom-checkbox col-6 col-md-4 col-lg-2 ">
                <input type="checkbox" class="custom-control-input @error('services') is-invalid @enderror"
                    name="services[]" {{ in_array( $service->id , old('services', [])) ? "checked" :"" }}
                value="{{$service->id}}"
                id="{{$service->id}}">
                <label class="custom-control-label" for="{{$service->id}}">{{$service->name}}</label>
                @error('services')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            @endforeach
        </div>

        {{-- Input Text: full_address --}}
        <div class="form-group py-3">
            <label for="input-address">Indirizzo completo:</label>
            <input type="text" name="full_address" value="{{old('full_address')}}"
                class="form-control @error('full_address') is-invalid @enderror" id="input-address"
                placeholder="Inserisci qui l' indirizzo del locale...">
            @error('full_address')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- input file immagine --}}
        <label for="input-image">Scegli l'immagine di copertina del tuo annuncio:</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">

                <span class="input-group-text">Immagine</span>
            </div>
            <div class="custom-file">
                <input type="file" value="{{old('image')}}" name="image"
                    class="custom-file-input  @error('image') is-invalid @enderror" id="input-image">
                <label class="custom-file-label" for="input-image">Inserisci l'immagine</label>
            </div>
        </div>
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- check-box: is_visible --}}
        <div class="form-check py-3">
            <input type="checkbox" name="is_visible" class="form-check-input @error('is_visible') is-invalid @enderror"
                id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Pubblica</label>
        </div>
        @error('is_visible')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



</div>
@endsection