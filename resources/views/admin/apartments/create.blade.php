@extends('layouts.back')

@section('content')
{{-- <style>
    .description-error {
        color: #FF0000;
    }
</style> --}}
{{-- @dd($categories, $services) --}}
<section id="create-apartment">
    <div class="container p-3">
        <h1 class="text-center">Creazione dell'appartamento</h1>
        <form method="POST" action="{{route('admin.apartments.store')}}" enctype="multipart/form-data" id="form-create">
            @csrf

            {{-- text input : titolo --}}
            <div class="form-group">
                <label for="input-name">Titolo dell' annuncio:</label>
                <input type="text" name="name" value="{{ old('name') }}" class="wrapper-input form-control"
                    id="input-name" placeholder="Inserisci qui il titolo dell'annuncio..."
                    class="@error('name') is-invalid @enderror">
                <small id="input-name-help" class="form-text text-muted">Max 255 caratteri</small>
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            {{-- select: category_id --}}
            <div class="input-group mb-3 wrapper-input rounded-lg">
                <div class="input-group-prepend rounded-0">
                    <label class="input-group-text border-0" for="category_id">Categoria</label>
                </div>
                <select name="category_id" required
                    class=" border-0 custom-select @error('category_id') is-invalid @enderror" id="category_id">
                    <option selected disabled> -- seleziona categoria -- </option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{ (old("category_id")==$category->id ? "selected":"")
                        }}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="form-group ">
                {{-- Number: Numero Stanze min="1" step="1" --}}
                <div class="row pb-2 ">
                    <div class="col">
                        <label for="input-rooms">Stanze</label>
                        <input type="number" value="{{ old('rooms') }}" name="rooms"
                            class=" wrapper-input form-control @error('rooms') is-invalid @enderror" id="input-rooms"
                            placeholder="Inserisci il numero delle stanze...">
                        @error('rooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="input-rooms-help" class="form-text text-muted">Massimo 255 stanze</small>
                    </div>

                    {{-- Number: Numero Letti --}}
                    <div class="col">
                        <label for="input-beds">Letti</label>
                        <input type="number" value="{{ old('beds') }}" name="beds"
                            class=" wrapper-input form-control @error('beds') is-invalid @enderror" id="input-beds"
                            placeholder="Inserisci il numero dei letti...">
                        @error('beds')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="input-beds-help" class="form-text text-muted">Massimo 255 stanze</small>
                    </div>

                </div>
                <div class="row pt-2">
                    <div class="col">
                        <label for="input-bathrooms">Bagni</label>
                        <input type="number" value="{{ old('bathrooms') }}" name="bathrooms"
                            class="wrapper-input form-control @error('bathrooms') is-invalid @enderror"
                            id="input-bathrooms" placeholder="Inserisci il numero dei bagni...">
                        @error('bathrooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="input-bathrooms-help" class="form-text text-muted">Massimo 255 bagni</small>
                    </div>
                    {{-- Number: Dimensione --}}
                    <div class="col">
                        <label for="input-size">Dimensioni in M<sup>2</sup> </label>
                        <input type="number" value="{{ old('size') }}" name="size"
                            class=" wrapper-input form-control @error('size') is-invalid @enderror" id="input-size"
                            placeholder="Immetti la dimensione...">
                        @error('size')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="input-size-help" class="form-text text-muted"></small>
                    </div>

                </div>

            </div>
            {{-- Textarea: Descrizione appartamento --}}
            <div class="form-group">
                <label for="description">Descrizione del locale:</label>
                <textarea name="description" placeholder="Inserire la descrizione dell'appartmento..."
                    class=" wrapper-input form-control @error('description') is-invalid @enderror" id="description"
                    rows="5">{{ old('description')  != null ? old('description') : ""}}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

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
                    class=" wrapper-input form-control @error('full_address') is-invalid @enderror" id="input-address"
                    placeholder="Inserisci qui l' indirizzo del locale...">
                {{-- <button id="check-address">Controlla Indirizzo</button> --}}
                @error('full_address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- <script>

            </script> --}}
            {{-- input file immagine --}}
            <span class="d-block pb-1">Scegli l'immagine di copertina del tuo annuncio:</span>
            <div class="input-group mb-3 wrapper-input rounded-lg overflow-hidden">
                <div class="input-group-prepend ">
                    <span class="input-group-text d-block border-0 ">Immagine</span>
                </div>
                <div class="custom-file">
                    <input type="file" value="{{old('image')}}" name="image"
                        class="custom-file-input  @error('image') is-invalid @enderror" id="input-image">
                    <label class="custom-file-label rounded-0" for="input-image">Inserisci l'immagine</label>
                </div>
            </div>
            @error('image')undefined
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            {{-- check-box: is_visible --}}
            <div class="form-check py-3">
                <input type="checkbox" name="is_visible"
                    class="form-check-input @error('is_visible') is-invalid @enderror" id="exampleCheck1"
                    {{old("is_visible") ? "checked" : "" }}>
                <label class="form-check-label" for="exampleCheck1">Pubblica</label>
            </div>
            @error('is_visible')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button class="btn" onclick="">Submit</button>
        </form>
    </div>
</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    if ($("#form-create").length > 0) {
        $("#form-create").validate({
  
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                rooms: {
                    required: true,
                    min: 1,
                    max: 255
                },
                beds: {
                    required: true,
                    min: 1,
                    max: 255
                },
                bathrooms: {
                    required: true,
                    min: 1,
                    max: 255
                },
                size: {
                    required: true,
                    min: 10,
                    max: 65535
                },
                description: {
                    required: true,
                    maxlength: 65535
                },
                full_address: {
                    required: true,
                    maxlength: 255
                },
            },
            messages: {
                name: {
                    required: "Inserisci il nome dell'annuncio",
                    maxlength: "Lunghezza massima 255 caratteri"
                },
                rooms: {
                    required: "Inserisci il numero di stanze",
                    min: 'Minimo una stanza',
                    max: "Massimo 255 stanze"
                },
                beds: {
                    required: "Inserisci il numero di letti",
                    min: 'Minimo un letto',
                    max: "Massimo 255 letti"
                },
                bathrooms: {
                    required: "Inserisci il numero di bagni",
                    min: 'Minimo un bagno',
                    max: "Massimo 255 bagni"
                },
                size: {
                    required: "Inserisci le dimensioni del locale",
                    min: 'Minimo 10 m2',
                    max: "Massimo 65535 m2 "
                },
                description: {
                    required: "La descrizione del locale e' obbligatoria",
                    maxlength: "Lunghezza massima 65535 caratteri"
                },
                full_address: {
                    required: "L'indirizzo e' obbligatorio",
                    maxlength: "Lunghezza massima 255 caratteri"
                },
            },
        })
    } 
</script>
@endsection