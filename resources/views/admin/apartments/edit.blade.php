@extends('layouts.back')

@section('content')
<section id="edit-apartment" class="p-3">
    {{-- @dd($categories, $services) --}}
    <div class="container">
        <h1 class="text-center">Modifica il tuo appartamento</h1>
        <form id="form_edit" method="POST" action="{{route('admin.apartments.update', $apartment)}}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- text input : titolo --}}
            <div class="form-group">
                <label for="input-name">Titolo dell' annuncio:</label>
                <input type="text" name="name" value=" {{ old('name', $apartment->name)}}"
                    class=" wrapper-input form-control" id="input-name"
                    placeholder="Inserisci qui il titolo dell'annuncio..." class=" @error('name') is-invalid @enderror">
                <small id="input-name-help" class="form-text text-muted">Max 255 caratteri</small>
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            {{-- select: category_id --}}
            <div class="input-group mb-3 wrapper-input rounded">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="category_id">Categoria</label>
                </div>
                <select name="category_id" class=" border-0 custom-select @error('category_id') is-invalid @enderror"
                    id="category_id">
                    <option selected disabled> -- seleziona categoria -- </option>
                    @foreach ($categories as $category)
                    {{-- da fare old --}}
                    <option value="{{$category->id}}" {{ old("category_id", $apartment->category_id)==$category->id ?
                        "selected" :""
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
                        <input type="number" value="{{ old('rooms') ? old('rooms') : $apartment->rooms }}" min="1"
                            name="rooms" class=" wrapper-input form-control @error('rooms') is-invalid @enderror"
                            id="input-rooms" min="1" step="1" placeholder="Inserisci il numero delle stanze...">
                        @error('rooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Number: Numero Letti --}}
                    <div class="col">
                        <label for="input-beds">Letti</label>
                        <input type="number" value="{{ old('beds') ? old('beds') : $apartment->beds  }}" min="1"
                            name="beds" class=" wrapper-input form-control @error('beds') is-invalid @enderror"
                            id="input-beds" min="1" step="1" placeholder="Inserisci il numero dei letti...">
                        @error('beds')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row pt-2">
                    <div class="col">
                        <label for="input-bathrooms">Bagni</label>
                        <input type="number" value="{{  old('bathrooms') ? old('bathrooms') : $apartment->bathrooms }}"
                            min="1" name="bathrooms"
                            class=" wrapper-input form-control @error('bathrooms') is-invalid @enderror"
                            id="input-bathrooms" min="1" step="1" placeholder="Inserisci il numero dei bagni...">
                        @error('bathrooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Number: Dimensione --}}
                    <div class="col">
                        <label for="input-size">Dimensioni in metri quadrati</label>
                        <input type="number" value="{{  old('size') ? old('size') : $apartment->size }}" min="10"
                            name="size" class=" wrapper-input form-control @error('size') is-invalid @enderror"
                            id="input-size" min="1" step="1" placeholder="Immetti la dimensione...">
                        @error('size')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Textarea: Descrizione appartamento --}}
            <div class="form-group">
                <label for="description">Descrizione del locale:</label>
                <textarea name="description"
                    class=" wrapper-input form-control @error('description') is-invalid @enderror" id="description"
                    rows="5">{{ old('description') ? old('description') : $apartment->description}}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- checkbbox: group servizi --}}
            <div class="row mx-0 justify-content-between" id="servizi">
                @foreach ($services as $service)
                <div class="custom-control custom-checkbox col-6 col-md-4 col-lg-2">
                    <input type="checkbox" class="custom-control-input cb @error('services') is-invalid @enderror"
                        name="services[]" {{ in_array( $service->id , old('services', $apartmentServices)) ? "checked" :
                    ""}}
                    value="{{$service->id}}"
                    id="{{$service->id}}">
                    <label class="custom-control-label" for="{{$service->id}}">{{$service->name}}</label>
                    @error('services')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                @endforeach

                <div id="servizi_error_box" class="col-12 mt-2">Inserire almeno un servizio</div>

                <script>
                    const el = document.getElementsByClassName("cb");
                    const formEdit = document.getElementById('form_edit');
                    const servizi = document.getElementById('servizi');

                    servizi.addEventListener('input', (e)=> {

                        let atLeastOneChecked = false;

                        for (i = 0; i < el.length; i++) {
                            if (el[i].checked === true) {
                                document.getElementById('servizi_error_box').style.display = "none";
                                atLeastOneChecked = true;
                            }
                        }

                        if (atLeastOneChecked === false) {
                            document.getElementById('servizi_error_box').style.display = "block";
                        }
                    })

                    formEdit.addEventListener('submit', (e)=> {

                        let atLeastOneChecked = false;

                        for (i = 0; i < el.length; i++) {
                            if (el[i].checked === true) {
                                atLeastOneChecked = true;
                            }
                        }

                        if (atLeastOneChecked === false) {
                            e.preventDefault()
                            document.getElementById('servizi_error_box').style.display = "block";
                            document.getElementById('servizi').scrollIntoView();
                        }
                    })

                </script>
            </div>

            {{-- Input Text: full_address --}}
            <div class="form-group py-3">
                <label for="input-address">Indirizzo completo:</label>
                <input type="text" name="full_address" value="{{old('full_address', $apartment->full_address)}}"
                    class=" wrapper-input form-control @error('full_address') is-invalid @enderror" id="input-address"
                    placeholder="Inserisci qui l' indirizzo del locale...">
                {{-- Datalist autocomplete --}}
                <datalist id="address_list">

                </datalist>
                @error('full_address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- script autocomplete --}}
            <script>
                const address_input = document.querySelector('#input-address');
                            const huge_list = document.getElementById('address_list');
                            let count = 0;
                            
                            address_input.addEventListener('keyup', e => {   
                                    count > 2 ? count = 0 : count++;
                                    if(address_input.value && count >=2  ){
                                    window.axios.get(`http://localhost:8000/api/autocomplete?address=${address_input.value}`)
                                    .then((res) => {
                                        huge_list.innerHTML = "";
                                        res.data.forEach(e =>{
                                        console.log(e);
                                        let option = document.createElement('option');
                                        option.value = e;
                                        option.innerText = e;
                                        option.addEventListener('click', opt =>{
                                            console.log(opt.value)
                                            address_input.value = e;
                                            huge_list.innerHTML = "";
                                            })
                                        huge_list.appendChild(option);
                                        })
                                    }) 
                                }else if(address_input.value && count <5  ){
                                    
                                }else{
                                    huge_list.innerHTML='';
                                }
                           });
            </script>
            <img class="img-fluid d-block mb-3" src="{{ asset('storage/'.$apartment->image)}} " alt="apartment photo">
            {{-- input file immagine --}}
            <span class="d-block pb-1">Scegli l'immagine di copertina del tuo annuncio:</span>
            <div class="input-group mb-3 wrapper-input  rounded">
                <div class="input-group-prepend">
                    <span class="input-group-text d-block border-0">Immagine</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input  @error('image') is-invalid @enderror"
                        id="input-image">
                    <label class="custom-file-label" for="input-image">
                        {{basename($apartment->image)}}</label>
                </div>
            </div>
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            {{-- check-box: is_visible --}}
            <div class="form-check py-3">
                <input type="checkbox" name="is_visible"
                    class="form-check-input @error('is_visible') is-invalid @enderror" id="exampleCheck1"
                    {{old("is_visible", $apartment->is_visible) ? "checked" : ""}}>
                <label class="form-check-label" for="exampleCheck1">Pubblica</label>
            </div>
            @error('is_visible')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn"><b>Salva modifiche</b></button>
        </form>
        <a href="{{route('admin.apartments.index')}}">
            <button class="btn back_button"><b>Indietro</b></button>
        </a>
    </div>
</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
    if ($("#form_edit").length > 0) {
        $("#form_edit").validate({

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