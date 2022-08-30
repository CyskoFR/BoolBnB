@extends('layouts.app')

@section('content')
{{-- -- @dd($apartment->user) -- --}}
{{-- @dd($geo_json->results[0]->position->lat); --}}
<section id="show-apartment">
    <div class="container text-capitalize">
        <h2 class="text-center ">dettaglio appartamento in back-office</h2>
        <h1 class="text-center py-4">{{$apartment->name}}</h1>
        <img class="img-fluid" src="{{asset('storage/'.$apartment->image)}}" alt="">
        <h2>{{$apartment->full_address}}</h2>
        <h4>geodata:</h4>
        <ul>
            <li>
                latitudine {{$apartment->latitude}}
            </li>
            <li>
                longitudine {{$apartment->longitude}}
            </li>
        </ul>
        <h4>Categoria:</h4>
        <p>{{$apartment->category->name}}</p>
        <h4>Descrizione:</h4>
        <p>{{$apartment->description}}</p>
        <h4>Informazioni:</h4>
        <ul>
            <li>Letti: {{$apartment->beds}}</li>
            <li>Bagni: {{$apartment->bathrooms}}</li>
            <li>Camere: {{$apartment->rooms}}</li>
            <li>Dimensioni: {{$apartment->size}} m^2</li>
        </ul>
        <h4>Serzizi:</h4>
        <ul class="d-flex list-unstyled">
            @foreach ($apartment->services as $service)
            <li class="px-2">{{$service->name}}</li>
            @endforeach

        </ul>
        <div class="d-flex py-2" id="actions">
            <a class="btn btn-primary" href="{{route('admin.apartments.edit', $apartment)}}">Modifica</a>
            {{-- form per il destroy --}}
            <form action="{{route('admin.apartments.destroy', $apartment)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Elimina Appartamento</button>

            </form>

        </div>
    </div>
</section>

@endsection