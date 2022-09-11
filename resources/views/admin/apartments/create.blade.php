@extends('layouts.back')

@section('content')
{{-- @dd($categories, $services) --}}
<section id="create-apartment">
    <div class="container p-3">
        <h1 class="text-center">Crea il tuo appartamento</h1>
        <div class="my-2 text-right small">Campo obbligatorio <span class="red_text">*</span></div>
        <form id="form_create" method="POST" action="{{route('admin.apartments.store')}}" enctype="multipart/form-data">
            @csrf

            {{-- text input : titolo --}}
            <div class="form-group">
                <label for="input-name">Titolo dell'annuncio<span class="red_text">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="wrapper-input form-control"
                    id="input-name" placeholder="Inserisci qui il titolo dell'annuncio..."
                    class="@error('name') is-invalid @enderror">
                <small id="input-name-help" class="form-text text-muted">Max 255 caratteri</small>
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            {{-- select: category_id --}}
            <div class="input-group mb-3 wrapper-input rounded-lg d-flex">
                <div class="input-group-prepend rounded-0">
                    <label class="input-group-text border-0" for="category_id">Categoria <span class="red_text">*</span></label>
                </div>
                <select name="category_id" required
                    class="border-0 custom-select @error('category_id') is-invalid @enderror" id="category_id">
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
                        <label for="input-rooms">Stanze <span class="red_text">*</span></label>
                        <input type="number" value="{{ old('rooms') }}" min="1" name="rooms"
                            class=" wrapper-input form-control @error('rooms') is-invalid @enderror" id="input-rooms"
                            placeholder="Inserisci il numero delle stanze...">
                        @error('rooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="input-rooms-help" class="form-text text-muted">Massimo 255 stanze</small>
                    </div>

                    {{-- Number: Numero Letti --}}
                    <div class="col">
                        <label for="input-beds">Letti <span class="red_text">*</span></label>
                        <input type="number" value="{{ old('beds') }}" min="1" name="beds"
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
                        <label for="input-bathrooms">Bagni <span class="red_text">*</span></label>
                        <input type="number" value="{{ old('bathrooms') }}" min="1" name="bathrooms"
                            class="wrapper-input form-control @error('bathrooms') is-invalid @enderror"
                            id="input-bathrooms" placeholder="Inserisci il numero dei bagni...">
                        @error('bathrooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="input-bathrooms-help" class="form-text text-muted">Massimo 255 bagni</small>
                    </div>
                    {{-- Number: Dimensione --}}
                    <div class="col">
                        <label for="input-size">Dimensioni in metri quadrati <span class="red_text">*</span></label>
                        <input type="number" value="{{ old('size') }}" min="10" name="size"
                            class=" wrapper-input form-control @error('size') is-invalid @enderror" id="input-size"
                            placeholder="Inserisci la dimensione del locale...">
                        @error('size')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="input-size-help" class="form-text text-muted"></small>
                    </div>

                </div>

            </div>
            {{-- Textarea: Descrizione appartamento --}}
            <div class="form-group">
                <label for="description">Descrizione del locale <span class="red_text">*</span></label>
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
                <div class="custom-control custom-checkbox col-6 col-md-4 col-lg-2">
                    <input type="checkbox" class="custom-control-input cb @error('services') is-invalid @enderror"
                        name="services[]" {{ in_array( $service->id , old('services', [])) ? "checked" :"" }}
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
                    const formCreate = document.getElementById('form_create');
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

                    formCreate.addEventListener('submit', (e)=> {

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
                <label for="input-address">Indirizzo completo <span class="red_text">*</span></label>
                <input type="input" name="full_address" value="{{old('full_address')}}"
                    class=" wrapper-input form-control @error('full_address') is-invalid @enderror" id="input-address"
                    placeholder="Inserisci qui l' indirizzo del locale...">
                {{-- Datalist autocomplete --}}
                <datalist id="address_list">

                </datalist>
                {{-- <button id="check-address">Controlla Indirizzo</button> --}}
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
            {{-- input file immagine --}}
            <div class="input-group mb-3">
                <label for="image">Scegli l'immagine di copertina del tuo annuncio <span class="red_text">*</span></label>
                <input type="file"
                    class="form-control-file wrapper-input rounded-lg @error('image') is-invalid @enderror" id="image"
                    name="image" value="{{old('image')}}">
            </div>
            @error('image')
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
            <button type="submit" class="btn"><b>Crea</b></button>
        </form>
        <a href="{{route('admin.apartments.index')}}">
            <button class="btn back_button"><b>Indietro</b></button>
        </a>
    </div>
</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    if ($("#form_create").length > 0) {
        $("#form_create").validate({

            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                category_id: {
                    required: true,
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
                image: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Inserisci il nome dell'annuncio",
                    maxlength: "Lunghezza massima 255 caratteri"
                },
                category_id: {
                    required: "Inserisci una categoria",
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
                    min: 'Minimo 10 metri quadrati',
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
                image: {
                    required: "L'immagine é obbligatoria"
                }
            },
        })
    } 
</script>
@endsection