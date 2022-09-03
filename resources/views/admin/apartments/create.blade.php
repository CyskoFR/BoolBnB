@extends('layouts.back')

@section('content')
{{-- @dd($categories, $services) --}}
<section id="create-apartment">
    <div class="container p-3">
        <h1 class="text-center">Creazione dell'appartamento</h1>
        <form method="POST" action="{{route('admin.apartments.store')}}" enctype="multipart/form-data">
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
                <textarea name="description"
                    class=" wrapper-input form-control @error('description') is-invalid @enderror" id="description"
                    rows="5">{{ old('description')  != null ? old('description') : "Inserisci descrizione dell' appartamento"}}</textarea>
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

{{-- <script>
    //HOOKS
    
    

    /* input text-name validation rule*/
    function validateNameField(){
        inputName = document.querySelector('input#input-name').value;
        inputNameLabel = document.querySelector('small#input-name-help');
        let errorString = "";
        if(inputName.length > 255 || inputName.length < 1){
            inputNameLabel.classList.remove( 'text-muted');
            inputNameLabel.classList.add( 'text-danger');
            inputNameLabel.innerText = "Immetti un numero di caratteri compreso da 1 a 255";
            return false;
        }else{
        inputNameLabel.classList.add( 'text-muted');
        inputNameLabel.classList.remove( 'text-danger');
        inputNameLabel.innerText = "Max 255 caratteri";
        return true;
        }
    }
    /* input number-rooms validation rule*/
    function validateRoomsField(){
        inputRooms = document.querySelector('input#input-rooms').value;
        inputRoomsLabel = document.querySelector('small#input-rooms-help');
        let errorString = "";
        if(inputRooms > 254 || inputRooms < 1){
            inputRoomsLabel.classList.remove( 'text-muted');
            inputRoomsLabel.classList.add( 'text-danger');
            inputRoomsLabel.innerText = 'Inserisci numero intero di stanze compreso da 1 a 255';
            return false;
        }else{  
            inputRoomsLabel.classList.add( 'text-muted');
            inputRoomsLabel.classList.remove( 'text-danger');
            inputRoomsLabel.innerText = 'Massimo 255 stanze';
            return true;
        }
    }
    /* input number-beds validation rule*/
    function validateBedsField(){
        inputBeds = document.querySelector('input#input-beds').value;
        inputBedsLabel = document.querySelector('small#input-beds-help');
        let errorString = "";
        if(inputBeds > 254 || inputBeds < 1){
            inputBedsLabel.classList.remove( 'text-muted');
            inputBedsLabel.classList.add( 'text-danger');
            inputBedsLabel.innerText = 'Inserisci numero intero di letti compreso da 1 a 255';
            return false;
        }else{  
            inputBedsLabel.classList.add( 'text-muted');
            inputBedsLabel.classList.remove( 'text-danger');
            inputBedsLabel.innerText = 'Massimo 255 letti';
            return true;
        }
    }
    /* input number-bathrooms validation rule*/
    function validateBathroomsField(){
        inputBathrooms = document.querySelector('input#input-bathrooms').value;
        inputBathroomsLabel = document.querySelector('small#input-bathrooms-help');
        let errorString = "";
        if(inputBathrooms > 254 || inputBathrooms < 1){
            inputBathroomsLabel.classList.remove( 'text-muted');
            inputBathroomsLabel.classList.add( 'text-danger');
            inputBathroomsLabel.innerText = 'Inserisci numero intero di bagni compreso da 1 a 255';
            return false;
        }else{  
            inputBathroomsLabel.classList.add( 'text-muted');
            inputBathroomsLabel.classList.remove( 'text-danger');
            inputBathroomsLabel.innerText = 'Massimo 255 bagni';
            return true;
        }
    }
    /* input number-size validation rule*/
    function validateSizeField(){
        inputSize = document.querySelector('input#input-size').value;
        inputSizeLabel = document.querySelector('small#input-size-help');
        let errorString = "";
        if(inputSize > 254 || inputSize < 10){
            inputSizeLabel.classList.remove( 'text-muted');
            inputSizeLabel.classList.add( 'text-danger');
            inputSizeLabel.innerText = 'Inserisci uan dimensione compresa tra 11 a 255';
            return false;
        }else{  
            inputSizeLabel.classList.add( 'text-muted');
            inputSizeLabel.classList.remove( 'text-danger');
            inputSizeLabel.innerText = 'Massimo 65535';
            return true;
        }
    }

    form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
    if(validateNameField() && validateNameField() && validateRoomsField() && validateBedsField() && validateBathroomsField() &&validateSizeField()){
        e.preventDefault();
        return;
    }
 });



</script> --}}
@endsection